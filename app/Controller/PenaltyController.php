<?php

/**
 * Penalty controller.
 *
 * This file will render views from views/Penalty/
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
 * Penalty Controller
 *
 * @property Penalty $Penalty
 * @property PaginatorComponent $Paginator
 */
class PenaltyController extends AppController {

    var $name = 'Penalty';
    public $uses = array('Penalty');

    /**
     * check login for admin and frontend new
     * allow and deny new
     */
    //public $components = array('Email', 'Image',);

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('controller', 'penalty');
        $this->set('model', 'Penalty');
        $this->Auth->allow('');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All Penalty', true));
        $this->Penalty->recursive = 0;
        $conditions = array();
        $this->paginate = array("conditions" => $conditions, "order" => "Penalty.id DESC");
        $this->set('penalty', $this->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        $this->set('title_for_layout', __('Add Penalty', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if ($this->Penalty->save($this->request->data)) {
                $this->Session->setFlash(__('Penalty has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Penalty could not be saved. Please, try again.'), 'error');
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->Penalty->id = $id;
        //check category exist
        if (!$this->Penalty->exists()) {
            $this->Session->setFlash(__('Invalid Penalty.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!isset($this->request->data['Penalty']['status'])) {
                $this->request->data['Penalty']['status'] = 0;
            }
            if ($this->Penalty->save($this->request->data)) {
                $this->Session->setFlash(__('Penalty has been updated'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Penalty could not be updated. Please, try again.'), 'error');
            }
        }
        $this->request->data = $this->Penalty->read(null, $id);
    }

    public function admin_update_status() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->request->data['Penalty']['id'] = $this->params['data']['id'];
            $this->request->data['Penalty']['status'] = $this->params['data']['status'];
            if ($this->Penalty->save($this->request->data)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        $this->Penalty->id = $id;
        if (!$this->Penalty->exists()) {
            throw new NotFoundException(__('Invalid Silder'));
        }

        $this->set('penalty', $this->Penalty->read(null, $id));
        $this->set('title_for_layout', 'View Penalty');
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Penalty->id = $id;
        if (!$this->Penalty->exists()) {
            throw new NotFoundException(__('Invalid sliders'), 'error');
        }
        $penalty = $this->Penalty->find('first', array('conditions' => array('Penalty.id' => $id), 'fields' => array('Penalty.attachment' )));
        //pr($users);die;  
        if (!empty($id)) {
            if (file_exists(WWW_ROOT . PENALTY_ATTACHMENT_FILE_PATH . DS . $penalty['Penalty']['attachment'])){
                @unlink(WWW_ROOT . PENALTY_ATTACHMENT_FILE_PATH . DS . $penalty['Penalty']['attachment']);
            }
        }
        if ($this->Penalty->delete()) {
            $this->Session->setFlash(__('Penalty deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Penalty was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }
    public function admin_downloadfile($name= null,$folder = null) {        
        $this->response->file(APP . DS .'webroot'.DS.'uploads'.DS.$folder.DS.$name,array('download'=> true, 'name'=>$name));
        return $this->response;     
    }
    public function admin_get_agency_woman() {
        $this->autoRender = false;
        $loadType = $_POST['loadType'];
        $loadId = $_POST['loadId'];
        if ($loadType == "woman") {
            $users = ClassRegistry::init('User')->find('all',array('conditions'=>array('User.role_id'=>WOMAN_ID,'UserProfile.agency_id'=>$loadId,'NOT'=>array('User.role_id'=>array(1)),'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name','UserProfile.nickname')) );
            $users = Hash::combine($users, '{n}.User.id', '{n}.UserProfile.nickname');
            if (count($users) > 0) {
                $HTML = "";
                foreach ($users as $key => $val) {
                    $HTML.="<option value='" . $key . "'>" . $val . "</option>";
                }
                return $HTML;
            }
        } 
    }
    
}
