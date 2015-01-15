<?php

/**
 * Messages controller.
 *
 * This file will render views from views/Messages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller/Component', 'Auth', 'Session', 'RequestHandler');
App::uses('CakeEmail', 'Network/Email');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

    var $name = 'Messages';
    public $uses = array('Message', 'User', 'MessageUser','MessageAttachment');

    /**
     * check login for admin and frontend message
     * allow and deny message
     */
    public $components = array('RequestHandler',);

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text', 'Js');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All messages', true));
        $this->paginate = array(
            'conditions' => array('MessageUser.receiver_id' => $this->Session->read('Auth.Admin.id'),'MessageUser.message_folder_id'=> INBOX),
            'recursive' => 2,
            'contain' => array('Message' => array('MessageAttachment')),
            'limit' => ADMIN_PAGING
        );
        $inboxes = $this->paginate('MessageUser');
        $this->set(compact('inboxes'));

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
            $this->autoRender = false;
            $this->render('inbox');
        }
    }

    public function admin_sentbox() {
        $this->Message->recursive = 2;
        $conditions = array('Message.sender_id' => $this->Session->read('Auth.Admin.id'),'Message.message_folder_id'=> SENT_ITEM);
        $this->paginate = array("conditions" => $conditions, "order" => "Message.id DESC", 'limit' => ADMIN_PAGING);
        $sents = $this->paginate();
        $this->set('sents', $sents);

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
            $this->autoRender = false;
            $this->render('sent');
        }
    }

    public function admin_trashbox() {
        $this->Message->recursive = 1;
        $this->Message->unBindModel(array('hasMany' => array('MessageUser')));
        
        $this->Message->bindModel(array( 'hasOne' => array('MessageUser'=>array( 'className'=>'MessageUser','conditions' => array() ))));
        
        $this->paginate = array(
            'conditions' => array(
                'OR'=>array(
                    array('Message.sender_id'=>$this->Session->read('Auth.Admin.id'),'Message.message_folder_id'=>TRASH),
                    array('MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'),'MessageUser.message_folder_id'=>TRASH)
                    )
                
            ),
            'limit' => ADMIN_PAGING,
        );
        $trashes = $this->paginate();
        //pr($trashes);
        $this->set('trashes', $trashes);

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
            $this->autoRender = false;
            $this->render('trash');
        }
    }
    public function admin_star_flag(){
        if ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            //Configure::write('debug', 0);
            if(isset($this->request->data['Message']['star_flag']) && $this->request->data['Message']['star_flag'] == 1)
                $this->Message->updateAll(array('Message.star_flag' => 0 ), array('Message.id' => $this->request->data['Message']['id']));
            else 
                $this->Message->updateAll(array('Message.star_flag' => 1 ), array('Message.id' => $this->request->data['Message']['id']));
            return true;
        }
    }
    public function admin_count_unread() {
        $this->autoRender = false;
        $count =$this->MessageUser->find('count',array('conditions'=>array('MessageUser.read_flag'=> UNREAD,'MessageUser.message_folder_id'=> INBOX,'MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'))) );
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 0);
            return $count;
        }
     }
    
    public function admin_read_unread() {
        $this->autoRender = false;
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 0);
        }
        if (!empty($this->request->data) && ($this->request->data['MessageUser']['read_flag'] == 'Read' || $this->request->data['MessageUser']['read_flag'] == 'Unread')) {
            $read_flag = isset($this->request->data['MessageUser']['read_flag']) && ($this->request->data['MessageUser']['read_flag'] == 'Read') ? true : false;
            $updateReadUnread = $this->MessageUser->updateAll(array('MessageUser.read_flag' => $read_flag), array('MessageUser.id' => $this->request->data["MessageUser"]['id']));
            if ($updateReadUnread) {
                $count =$this->MessageUser->find('count',array('conditions'=>array('MessageUser.read_flag'=> UNREAD,'MessageUser.message_folder_id'=> INBOX,'MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'))) );
                return json_encode(array('status' => 'true','message'=> 'There are some mail(s) '.$this->request->data['MessageUser']['read_flag'],'count'=>$count));
            } else {
                return json_encode(array('status' => 'false','message'=> 'There are some mail(s) '.$this->request->data['MessageUser']['read_flag'],'count'=>$count));
            }
        }
    }
    
    public function admin_delete_from_trash() {
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 0);
            $this->autoRender = false; 
            $this->layout = 'ajax';
             if (!empty($this->request->data) && $this->request->data['Message']['type'] == 'trash') {
                 
                foreach($this->request->data['Message']['id'] as $val){
                    if(!empty($val) && $val['type'] == TRASH)
                        $this->MessageUser->updateAll(array('MessageUser.status' => DEACTIVE,'MessageUser.message_folder_id' => 4   ), array('MessageUser.id' => $val['id']));
                    else
                        $this->Message->updateAll(array('Message.status' => DEACTIVE,'Message.message_folder_id' => 4   ), array('Message.id' => $val['id']));
                    
                    $message = $this->Message->findById($val['id']);
                    $message_user = $this->MessageUser->findById($val['id']);
                    $msg_folderid = isset($message_user['Message']['message_folder_id']) ? $message_user['Message']['message_folder_id'] : '';
                    $msg_user_folderid = isset($message_user['MessageUser']['message_folder_id']) ? $message_user['MessageUser']['message_folder_id'] : '';
                    
                    if($msg_folderid == TRASH  &&  $msg_user_folderid == TRASH){
                        $condition = array('MessageAttachment.message_id' => $val['id'] );
                        $this->MessageAttachment->delete($condition ,false);
                        $files = glob(WWW_ROOT . MESSAGE_FILE_PATH . DS .$val['id']. DS .'attachment'.'/*');
                        if(isset($files) && !empty($files)) {
                            foreach($files as $file){ 
                              if(is_file($file))
                                @unlink($file);
                            }
                        }
                        if(is_dir(WWW_ROOT . MESSAGE_FILE_PATH . DS .$val['id'].DS .'attachment')){
                           @rmdir(WWW_ROOT . MESSAGE_FILE_PATH . DS .$val['id'].DS .'attachment'); 
                        }
                        if(is_dir(WWW_ROOT . MESSAGE_FILE_PATH . DS .$val['id'])){
                           @rmdir(WWW_ROOT . MESSAGE_FILE_PATH . DS .$val['id']); 
                        }
                    }
                }
                
                $this->Message->recursive = 1;
                $this->Message->unBindModel(array('hasMany' => array('MessageUser')));
                $this->Message->bindModel(array( 'hasOne' => array('MessageUser'=>array( 'className'=>'MessageUser','conditions' => array() ))));
                $this->paginate = array(
                    'conditions' => array(
                        'OR'=>array(
                            array('Message.sender_id'=>$this->Session->read('Auth.Admin.id'),'Message.message_folder_id'=>TRASH),
                            array('MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'),'MessageUser.message_folder_id'=>TRASH)
                            )

                    ),
                    'limit' => ADMIN_PAGING,
                );
                $trashes = $this->paginate();
                $this->set('trashes', $trashes);
                $this->render('trash');
             }
          
        }
    }
    
    public function admin_delete_in_trash() {
        if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);
            if (!empty($this->request->data) && $this->request->data['MessageUser']['type'] == 'inbox') {
                $message_folder_id = TRASH ;
                $updateReadUnread = $this->MessageUser->updateAll(array('MessageUser.message_folder_id' => $message_folder_id), array('MessageUser.id' => $this->request->data["MessageUser"]['id']));
                $count =$this->MessageUser->find('count',array('conditions'=>array('MessageUser.read_flag'=> UNREAD,'MessageUser.message_folder_id'=> INBOX,'MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'))) );
                $this->paginate = array(
                    'conditions' => array('MessageUser.receiver_id' => $this->Session->read('Auth.Admin.id'),'MessageUser.message_folder_id'=> INBOX),
                    'limit' => ADMIN_PAGING
                );
                $inboxes = $this->paginate('MessageUser');
                $this->set(compact('inboxes'));
                $this->layout = 'ajax';
                $this->autoRender = false;
                $this->render('inbox');
            }
            if (!empty($this->request->data) && $this->request->data['MessageUser']['type'] == 'sent') {
                $message_folder_id = TRASH ;
                $updateReadUnread = $this->Message->updateAll(array('Message.message_folder_id' => $message_folder_id), array('Message.id' => $this->request->data["MessageUser"]['id']));
                $this->Message->recursive = 2;
                $conditions = array('Message.sender_id' => $this->Session->read('Auth.Admin.id'),'Message.message_folder_id'=> SENT_ITEM);
                $this->paginate = array("conditions" => $conditions, "order" => "Message.id DESC", 'limit' => ADMIN_PAGING);
                $sents = $this->paginate();
                $this->set('sents', $sents);
                $this->layout = 'ajax';
                $this->autoRender = false;
                $this->render('sent');
            }
        }
    }
    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_send() {
        if ($this->request->is('post') || $this->request->is('put')) {
            if(isset($this->request->data['MessageUser'][0]['receiver_id']) &&  !empty($this->request->data['MessageUser'][0]['receiver_id'])){
                if ($this->Message->saveAssociated($this->request->data)) {
                    $id = $this->Message->getLastInsertID();
                    if (!file_exists(MESSAGE_FILE_PATH . DS . $id)) {
                        mkdir(MESSAGE_FILE_PATH . DS . $id, 0777); 
                        mkdir(MESSAGE_FILE_PATH . DS . $id . DS . 'attachment', 0777);
                    }
                    $this->copy_all_files($id);
                    $this->Session->setFlash(__('Message has been sent.'), 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $errors = $this->Message->validationErrors;
                    $this->Session->setFlash(__('Message could not be send. Please, try again.'), 'error');
                }
            }else{
               $this->Session->setFlash(__('Message could not be send. Please, select user.'), 'error'); 
            }
        }
    }

    public function admin_read($id) {
        $this->Message->id = $id;
        if(isset($this->params['pass'][1]) && !empty($this->params['pass'][1])){
            $this->set('read',$this->params['pass'][1]);
        }
        if (!$this->Message->exists()) {
            $this->Session->setFlash(__('Invalid id'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        $this->MessageUser->updateAll(array('MessageUser.read_flag' => 1), array('MessageUser.message_id' => $id));
        $this->set('message', $this->Message->read(null, $id));
        $this->set('title_for_layout', 'Read Message');
    }

    public function copy_all_files($id) {
        $files = scandir(MESSAGE_FILE_PATH . "/temp");
        $source = MESSAGE_FILE_PATH . "/temp/";
        $destination = MESSAGE_FILE_PATH . "/" . $id . '/attachment/';
        if (isset($files) && !empty($files) && is_array($files)) {
            foreach ($files as $file) {
                if (in_array($file, array(".", "..")))
                    continue;
                $this->request->data['MessageAttachment']['message_id'] = $id;
                $this->request->data['MessageAttachment']['name'] = $file;
                $this->MessageAttachment->create();
                if ($this->MessageAttachment->save($this->request->data)) {
                    if (copy($source . $file, $destination . $file)) {
                        $delete[] = $source . $file;
                    }
                }
            }
        }
        // Delete all successfully-copied files
        if (isset($delete) && !empty($delete) && is_array($delete)) {
            foreach ($delete as $file) {
                unlink($file);
            }
        }
    }

    public function admin_downloadfile() {
        $this->response->file(APP.'webroot'.DS.'uploads' . DS . $this->params['named']['folder'] . DS . $this->params['named']['id'] . DS . 'attachment' . DS . $this->params['named']['name'], array('download' => true, 'name' => $this->params['named']['name']));
        return $this->response;
      
    }

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException(__('Invalid messages'), 'flash_custom_error');
        }
        if ($this->Message->delete()) {
            $this->Session->setFlash(__('Messages deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Messages was not deleted'), 'flash_custom_error');
        $this->redirect(array('action' => 'index'));
    }

    public function admin_upload_file_delete() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
            $this->autoRender = false;
            $output_dir = MESSAGE_FILE_PATH . "/temp/";
            if (isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name'])) {
                $fileName = $_POST['name'];
                $filePath = $output_dir . $fileName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                echo "Deleted File " . $fileName . "<br>";
            }
        }
    }

    public function admin_upload() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
            $this->autoRender = false;
            //pr($_FILES['attachment']);
            $output_dir = MESSAGE_FILE_PATH . "/temp/";
            if (isset($_FILES["attachment"])) {
                $ret = array();

                $error = $_FILES["attachment"]["error"];
                //You need to handle  both cases
                //If Any browser does not support serializing of multiple files using FormData() 
                
//                $oldFiles = glob($output_dir.'*'); // get all file names
//                foreach($oldFiles as $file){ // iterate files
//                  if(is_file($file))
//                    unlink($file); // delete file
//                }
                
                if (!is_array($_FILES["attachment"]["name"])) { //single file
                    $fileName = $_FILES["attachment"]["name"];
                    move_uploaded_file($_FILES["attachment"]["tmp_name"], $output_dir . $fileName);
                    $ret[] = $fileName;
                } else {  //Multiple files, file[]
                    $fileCount = count($_FILES["attachment"]["name"]);
                    for ($i = 0; $i < $fileCount; $i++) {
                        $fileName = $_FILES["attachment"]["name"][$i];
                        move_uploaded_file($_FILES["attachment"]["tmp_name"][$i], $output_dir . $fileName);
                        $ret[] = $fileName;
                    }
                }
                echo json_encode($ret);
            }
        }
    }

}
