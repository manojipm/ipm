<?php

/**
 * Agencies controller.
 *
 * This file will render views from views/Agencies/
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
 * Agencies Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class AgenciesController extends AppController {

    var $name = 'Agencies';
    public $uses = array('User','UserProfile', 'Language', 'Country', 'State', 'City');

    /**
     * check login for admin and frontend user
     * allow and deny user
     */
    public $components = array('Email', 'Common', 'CommonEmail');

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


/*********************** Front End Panel Agency Functions Start **************************/
	
/**
 *  Agency Dashboard
 */
	public function agency_index() {
		$agency_id = $this->Auth->User('id');
		// Get list of logged in user women
		$womens = $this->Common->womenList($agency_id);
		$this->set('womens',$womens);		
	}
	
	
	public function agency_introletters(){
		$agency_id = $this->Auth->User('id');
		// Get list of logged in user women
		$this->User->bindModel(array('hasOne'=>array('Introletter')));
		$womens = $this->Common->womenList($agency_id);
		$this->set('womens',$womens);
	}
	
	public function agency_introdetails($id = ''){
		$agency_id = $this->Auth->User('id');
		$this->loadModel('Introletter');
		// Get list of logged in user women
		$this->Introletter->recursive = 2;
		$this->Introletter->bindModel(array('belongsTo'=>array('User')));
		$introletter = $this->Introletter->find('first',array('conditions'=>array('Introletter.id'=>$id)));
		$this->set('introletter',$introletter);
	}
	
	public function agency_connecttoprofile($id = ''){
		$this->loadModel('Introletter');
		$introletter['Introletter']['id'] = $id;
		$introletter['Introletter']['status'] = 1;
		if($this->Introletter->save($introletter))
		{
			$this->Session->setFlash(__('The Introletter has been connect to profile successfully.'), 'success');
			$this->redirect(array('action' => 'introletters'));
		}else{
			$this->Session->setFlash(__('The Introletter could not connect to profile.'), 'error');
		}
	}
	
	public function agency_disconnecttoprofile($id = ''){
		$this->loadModel('Introletter');
		$introletter['Introletter']['id'] = $id;
		$introletter['Introletter']['status'] = 0;;
		if($this->Introletter->save($introletter))
		{
			$this->Session->setFlash(__('The Introletter has been disconnect from profile successfully.'), 'success');
			$this->redirect(array('action' => 'introletters'));
		}else{
			$this->Session->setFlash(__('The Introletter could not disconnect from profile.'), 'error');
		}
	}
	
	
/**
 *  Agency Girl Profile Add
 */	
	public function agency_profileadd() {
		if (isset($this->data) && !empty($this->data)) {
            // Calculate Height in inches
            if (isset($this->data['UserProfile']['height_feet']) && !empty($this->data['UserProfile']['height_feet'])) {
                $height_feet = $this->data['UserProfile']['height_feet'];
                if (isset($this->data['UserProfile']['height_inches']) && !empty($this->data['UserProfile']['height_inches'])) {
                    $height_inches = $this->data['UserProfile']['height_inches'];
                }
                $height = $this->Common->calculateHeight($height_inches, $height_feet);
                $this->request->data['UserProfile']['height'] = $height;
            }
			
			$this->request->data['UserProfile']['unique_id'] = substr(time(), -5);
            if ($this->User->saveAssociated($this->request->data)) {
				// Sent Mail to Admin
				$arrData = $this->request->data;
				$this->CommonEmail->AdminAgencyGirlProfileAdded(ADMIN_EMAIL, 'New Girl Profile Added', $arrData);
				
				// Sent Mail to girl
				if(isset($this->request->data['User']['email']) && !empty($this->request->data['User']['email'])){
					$email = $this->request->data['User']['email'];
					$this->CommonEmail->GirlProfileMail($email, 'Welcome to inlovebride', $arrData);
				}
				
                $this->Session->setFlash(__('The girl profile has been saved successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The girl profile could not be saved. Please, try again.'), 'error');
            }
        }
	}
	
/**
 *  Agency Girl Profile Edit
 */	
	public function agency_profileedit($id = '') {
		$this->User->id = $id;
		$agency_id = $this->Auth->User('id');// Login agency id
		
		if (!$this->User->hasAny(array(	'User.role_id' => WOMAN_ID,	'User.id' => $id)) || !$this->UserProfile->hasAny(array('UserProfile.agency_id' => $agency_id))) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
		if (isset($this->data) && !empty($this->data)) {
            // Calculate Height in inches
            if (isset($this->data['UserProfile']['height_feet']) && !empty($this->data['UserProfile']['height_feet'])) {
                $height_feet = $this->data['UserProfile']['height_feet'];
                if (isset($this->data['UserProfile']['height_inches']) && !empty($this->data['UserProfile']['height_inches'])) {
                    $height_inches = $this->data['UserProfile']['height_inches'];
                }
                $height = $this->Common->calculateHeight($height_inches, $height_feet);
                $this->request->data['UserProfile']['height'] = $height;
            }
			
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The girl profile has been updated successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The girl profile could not be updated. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->User->read(null, $id);
				if (isset($this->request->data['UserProfile']['height']) && !empty($this->request->data['UserProfile']['height'])) {
				$height = $this->request->data['UserProfile']['height'];
				$height_inches = ($height % 12);
				$height_feet = (int) ($height / 12);
				$this->request->data['UserProfile']['height_feet'] = $height_feet;
				$this->request->data['UserProfile']['height_inches'] = $height_inches;
			}
		}
	}
	
/**
 *  Agency Girl Profile View
 */		
	public function agency_profileview($id = '') {
		$this->User->id = $id;
		$agency_id = $this->Auth->User('id');// Login agency id
		
		if (!$this->User->hasAny(array(	'User.role_id' => WOMAN_ID,	'User.id' => $id)) || !$this->UserProfile->hasAny(array('UserProfile.agency_id' => $agency_id))) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
		if (isset($this->data) && !empty($this->data)) {
            // Calculate Height in inches
            if (isset($this->data['UserProfile']['height_feet']) && !empty($this->data['UserProfile']['height_feet'])) {
                $height_feet = $this->data['UserProfile']['height_feet'];
                if (isset($this->data['UserProfile']['height_inches']) && !empty($this->data['UserProfile']['height_inches'])) {
                    $height_inches = $this->data['UserProfile']['height_inches'];
                }
                $height = $this->Common->calculateHeight($height_inches, $height_feet);
                $this->request->data['UserProfile']['height'] = $height;
            }
			
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The girl profile has been updated successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The girl profile could not be updated. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->User->read(null, $id);
				if (isset($this->request->data['UserProfile']['height']) && !empty($this->request->data['UserProfile']['height'])) {
				$height = $this->request->data['UserProfile']['height'];
				$height_inches = ($height % 12);
				$height_feet = (int) ($height / 12);
				$this->request->data['UserProfile']['height_feet'] = $height_feet;
				$this->request->data['UserProfile']['height_inches'] = $height_inches;
			}
		}
	}

/**
 *  Agency Girl Profile Single delete
 */		
	public function agency_profiledelete($id = '') {
		$this->User->id = $id;
		 $agency_id = $this->Auth->User('id');// Login agency id
		
		if (!$this->User->hasAny(array(	'User.role_id' => WOMAN_ID,	'User.id' => $id)) || !$this->UserProfile->hasAny(array('UserProfile.agency_id' => $agency_id))) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        } 
		if ($this->User->updateAll(array('User.is_deleted' => '1'), array('User.id' => $id, 'User.role_id' => WOMAN_ID, 'UserProfile.agency_id' => $this->Auth->User('id')))) {
            $this->Session->setFlash(__('The girl profile has been deleted successfully.'), 'success');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('The girl profile could not be deleted. Please, try again.'), 'error');
        }
	}

/**
 *  Agency Girl Profile multiple delete
 */		
	public function agency_delete_girls(){
		if(isset($this->data['checkedVal']) && !empty($this->data['checkedVal'])){
			$checkedVal = $this->data['checkedVal'];
			$checkedVal = "'" . str_replace(",", "','", $checkedVal) . "'";
			$this->User->unbindModel(array('hasOne'=>array('UserProfile','UserVideo', 'UserImage')));
			$this->User->unbindModel(array('hasAndBelongsToMany'=>array('Language')));
			if($this->User->updateAll(array('User.is_deleted'=> '1'), array("User.id IN ($checkedVal)"))){
				die('success');
			}else{
				die('error');
			}
		}
		
	}

/**
 *  Agency Girl Profile blocked girls
 */		
	public function agency_block_girls(){
		if(isset($this->data['checkedVal']) && !empty($this->data['checkedVal'])){
			$checkedVal = $this->data['checkedVal'];
			$checkedVal = "'" . str_replace(",", "','", $checkedVal) . "'";
			$this->User->unbindModel(array('hasOne'=>array('UserProfile','UserVideo', 'UserImage')));
			$this->User->unbindModel(array('hasAndBelongsToMany'=>array('Language')));
			if($this->User->updateAll(array('User.status'=> '0'), array("User.id IN ($checkedVal)"))){
				die('success');
			}else{
				die('error');
			}
		}		
	}
	
	 /**
     * Download files method in Agency panel
     *
     * @return void
     */
    public function agency_downloadfile($name = null, $folder = null) {
        $this->response->file(APP . 'webroot' . DS . 'uploads' . DS . $folder . DS . $name, array('download' => true, 'name' => $name));
        return $this->response;
    }
	
/**
 *  Agency Profile 
 */		
	public function agency_myprofile(){

		
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
 *  Agency Account
 */		
	public function agency_myaccount(){
		if(isset($this->data) && !empty($this->data)){
			
			if($this->User->saveAssociated($this->data)){
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
				$this->Session->setFlash(__('The agency details has been updated successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('The agency details could not updated successfully.'), 'error');
			}
		}else{
			$agency_id = $this->Auth->User('id');
			$this->request->data = $this->User->read(null, $agency_id);
		}
	}
	
/*********************** Front End Panel Agency Functions End **************************/

}
