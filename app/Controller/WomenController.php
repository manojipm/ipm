<?php

/**
 * Women controller.
 *
 * This file will render views from views/Women/
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
 * Women Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class WomenController extends AppController {

    var $name = 'Women';
    public $uses = array('User', 'Language', 'Country', 'State', 'City');

    /**
     * check login for admin and frontend user
     * allow and deny user
     */
    public $components = array('Email', 'Acl');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }



/*********************** Front End Panel Woman Functions Start **************************/

/**
 *  Woman Dashboard
*/
	public function woman_index() {
		$sliders = $this->Common->getSlider(WOMAN_ID);
		$this->set('sliders', $sliders);
	}

	
/**
 *  Woman Intro Letter
*/
	public function woman_introletter() {
		$this->loadModel('Introletter');
		if(isset($this->data) && !empty($this->data)){
			if($this->Introletter->save($this->data)){
				$this->Session->setFlash(__('The Introletter has been saved successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
			}
		}else{
			$user_id = $this->Auth->User('id');
			$this->request->data = $this->Introletter->find('first',array('conditions' => array('Introletter.user_id' => $user_id)) );
		}
	}


	
	 /**
     * Download files method in Woman panel
     *
     * @return void
     */
    public function woman_downloadfile($name = null, $folder = null) {
        $this->response->file(APP . 'webroot' . DS . 'uploads' . DS . $folder . DS . $name, array('download' => true, 'name' => $name));
        return $this->response;
    }
		
/**
 *  Agency Profile 
 */		
	public function woman_myprofile(){

		
		if(isset($this->data) && !empty($this->data)){
			if($this->User->saveAssociated($this->data)){	
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
				$this->Session->setFlash(__('The agency profile has been updated successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('The agency profile could not updated successfully.'), 'error');
			}
		}else{
			$agency_id = $this->Auth->User('id');
			$this->request->data = $this->User->read(null, $agency_id);
		}
	}
	

/**
 *  update nickname by woman
*/
	public function woman_savenicname(){
		$this->layout = false;
		if(isset($this->data) && !empty($this->data)){
			$this->loadModel('UserProfile');
			$id = $this->data['id'];
			$val = $this->data['val'];
			if($this->UserProfile->updateAll(array('UserProfile.nickname'=>"'".$val."'"), array('UserProfile.id' => $id))){
				$this->Session->write('Auth.User.UserProfile.nickname', $val);
				die('1');
			}
		}
		die('0');
	}
	
	
/**
 *  view mans profile by woman
*/
	public function woman_manprofile(){
	
	
	}
	
	
	
/*********************** Front End Panel Woman Functions End **************************/
	
}
