<?php

/**
 * Users controller.
 *
 * This file will render views from views/Users/
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
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    var $name = 'Users';
    //public $uses = array('User', 'Language', 'Country', 'State', 'City','UserImage');
    
    public $uses = array('User');

    /**
     * check login for admin and frontend user
     * allow and deny user
     */
    public $components = array('Email', 'common', 'Image','CommonEmail');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('activation','admin_login', 'admin_forgotpassword', 'admin_logout', 'admin_forgot_password', 'admin_check_old_password', 'admin_get_state_city', 'registration', 'registration_agency');
    }

    /*     * ********************* Admin Panel Functions Start ************************* */

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All users', true));
        $this->User->recursive = 0;
        if ($this->request->is('post') || $this->request->is('put')) {
            $role_ids = array();

            if (isset($this->request->data['User'][0]['role_id']))
                $role_ids[] = $this->request->data['User'][0]['role_id'];
            if (isset($this->request->data['User'][1]['role_id']))
                $role_ids[] = $this->request->data['User'][1]['role_id'];
            if (isset($this->request->data['User'][2]['role_id']))
                $role_ids[] = $this->request->data['User'][2]['role_id'];

            if (isset($role_ids) && !empty($role_ids)) {
                $conditions = array('User.role_id' => $role_ids, 'NOT' => array('User.role_id' => array(1)));
            } else {
                $conditions = array('User.status' => 1, 'NOT' => array('User.role_id' => array(1)));
            }
            $this->paginate = array("conditions" => $conditions, "order" => "User.id DESC");
            $this->set('users', $this->paginate());
            $this->set('role_ids', $this->request->data);
        } else {
            $conditions = array('NOT' => array('User.role_id' => array(1)));

            $this->paginate = array("conditions" => $conditions, "order" => "User.id DESC"); //pr($this->paginate());
            $this->set('users', $this->paginate());
        }
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        //$this->User->recursive = 3;
        
        $this->loadModel('Role');
        $userType = $this->Role->findById($this->params['named']['type']);
        $this->set('userType', $userType);
        $this->set('title_for_layout', __('Add new ' . $userType['Role']['role'], true));
        if ($this->request->is('post') || $this->request->is('put')) {
            App::uses('Sanitize', 'Utility');
            Sanitize::clean($this->request->data);

            $this->request->data['UserProfile']['unique_id'] = substr(time(), -5);
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
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
       $this->loadModel('Role');
        $userType = $this->Role->findById($this->params['named']['type']);
        $this->set('userType', $userType);
        $this->set('title_for_layout', __('Edit  ' . $userType['Role']['role'], true));
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            App::uses('Sanitize', 'Utility');
            Sanitize::clean($this->request->data);
            $this->User->validator()->remove('Language');
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->User->validationErrors;
                //pr($errors);
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }
        $this->request->data = $this->User->read(null, $id);
        if (isset($this->request->data['UserProfile']['height']) && !empty($this->request->data['UserProfile']['height'])) {
            $height = $this->request->data['UserProfile']['height'];
            $height_inches = ($height % 12);
            $height_feet = (int) ($height / 12);
            $this->request->data['UserProfile']['height_feet'] = $height_feet;
            $this->request->data['UserProfile']['height_inches'] = $height_inches;
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
        $this->User->id = $id;
        $this->loadModel('Role');
        $userType = $this->Role->findById($this->params['named']['type']);
        $this->set('userType', $userType);
        $this->set('title_for_layout', __('View  ' . $userType['Role']['role'], true) . ' details');
        if (!$this->User->exists() && !$this->params['named']['type']) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('Penalty');

        if ($this->request->is('post') || $this->request->is('put')) {
            //pr($this->request->data);die;
            if ($this->Penalty->save($this->request->data)) {

                $this->Session->setFlash(__('The penalty has been saved successfully.'), 'success');
                $this->redirect(array('controller' => 'penalty', 'action' => 'index'));
            } else {
                $errors = $this->Penalty->validationErrors;
                //pr($errors);
                $this->Session->setFlash(__('The penalty could not be saved. Please, try again.'), 'error');
            }
        }




        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('users', $this->User->read(null, $id));
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'), 'error');
        }
        $users = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('UserImage.image_name', 'UserVideo.profile_vedio', 'UserProfile.passport_scan_copy', 'UserProfile.agency_license')));
        //pr($users);die;  
        if (!empty($id)) {
            if (file_exists(WWW_ROOT . USER_PIC_PATH . DS . $users['UserImage']['image_name'])) {
                @unlink(WWW_ROOT . USER_PIC_PATH . DS . $users['UserImage']['image_name']);
            }
            if (file_exists(WWW_ROOT . USER_VIDEO_PATH . DS . $users['UserVideo']['profile_vedio'])) {
                @unlink(WWW_ROOT . USER_VIDEO_PATH . DS . $users['UserVideo']['profile_vedio']);
            }
            if (file_exists(WWW_ROOT . USER_PASSPORT_PATH . DS . $users['UserProfile']['passport_scan_copy'])) {
                @unlink(WWW_ROOT . USER_PASSPORT_PATH . DS . $users['UserProfile']['passport_scan_copy']);
            }
            if (file_exists(WWW_ROOT . AGENCY_FILE_PATH . DS . $users['UserProfile']['agency_license'])) {
                @unlink(WWW_ROOT . AGENCY_FILE_PATH . DS . $users['UserProfile']['agency_license']);
            }
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * login function for  admin panel
     * 
     */
    public function admin_login() {
        $this->layout = 'admin_login';

        if ($this->Auth->loggedIn()) {
            return $this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'admin' => true));
        }
        if ($this->request->is('post')) {
            // Remeber Me functionality
            if (isset($this->data['User']['remember']) && !empty($this->data['User']['remember'])) {
                setcookie("username", $this->request->data['User']['email'], time() + 3600 * 24 * 7);
                setcookie("password", $this->request->data['User']['password'], time() + 3600 * 24 * 7);
            } else {
                setcookie("username", '');
                setcookie("password", '');
            }
            if ($this->Auth->login()) {
                $this->Session->setFlash('You have logged in successfully ', 'success');
                return $this->redirect($this->Auth->redirectUrl());
                // Prior to 2.3 use
                // `return $this->redirect($this->Auth->redirect());`
            } else {
                $this->Session->setFlash('Username or password is incorrect', 'error');
            }
        }
        $this->set('title_for_layout', 'Admin Login');
    }

    /**
     * logout function for  admin panel
     * 
     */
    public function admin_logout() {
        if ($this->Session->check('Auth.Admin')) {
            $this->Session->setFlash('', null, null, 'auth');
            $this->Session->delete('Auth.Admin');
        }
        $this->Session->setFlash(__('Logout Successfully.'), 'success');
        $this->redirect($this->Auth->logout());
    }

    /**
     * admin_forgot_password method
     * 
     */
    public function admin_forgotpassword() {
        $this->layout = 'admin_login';
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->set($this->request->data);
            if ($this->User->checkEmailInForgotPasswordValidate()) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $this->data['User']['email'],
                        'User.role_id' => '1'
                    )
                        )
                );
                if (!empty($user)) {
                    $password = rand(100000, 999999);
                    $yourPassword = AuthComponent::password($password);
                    $this->User->updateAll(array('User.password' => "'$yourPassword'"), array('User.email' => $this->data['User']['email']));

                    $this->CommonEmail->forgotPassEmail($user['User']['email'], 'Admin Forgot Password', $user);

                    $this->Session->setFlash(__('Reset password mail has been sent'), 'success');
                    $this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
                } else {
                    $this->Session->setFlash(__('You are not authorized to access,Please try again.'), 'error');
                }
            } else {
                $this->Session->setFlash(__('Please try again.'), 'error');
            }
        }
    }

    /**
     * update_status method
     *
     * @return void
     */
    public function admin_update_status() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->request->data['User']['id'] = $this->params['data']['id'];
            $this->request->data['User']['status'] = $this->params['data']['status'];
            if ($this->User->save($this->request->data)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Check old password method
     *
     * @return void
     */
    public function admin_check_old_password() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $userId = $this->data['id'];
            $password = $this->data['password'];
            $newPass = AuthComponent::password($password);
            $data = $this->User->find('count', array('conditions' => array('User.id' => $userId, 'User.password' => $newPass)));
            return $data;
            exit();
        }
    }

    /**
     * Password reset method in admin panel
     *
     * @return void
     */
    public function admin_reset_password($id = null) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id'] = $id;
            $password = $this->request->data['User']['cpassword'];
            unset($this->request->data['User']['old_password']);
            unset($this->request->data['User']['url']);
            unset($this->request->data['User']['cpassword']);
            $this->User->set($this->data['User']);
            $user = $this->User->findByid($id);
            $this->request->data = $user;
            $this->request->data['User']['password'] = $password;

            if ($this->User->save($this->request->data)) {
                $this->CommonEmail->resetPassEmail($this->request->data['User']['email'], 'Reset password', $this->request->data);
                $this->Session->setFlash(__('Your password has been reset successfully.'), 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
            } else {
                $this->Session->setFlash(__('The password could not be reset. Please, try again.'), 'error');
            }
        }
        $this->set('title_for_layout', 'Reset Password - Trip A Room');
    }

    /**
     * Admin Profile edit in admin panel
     *
     * @return void
     */
    public function admin_profile($id = null) {
        $this->loadModel('Role');
        $userType = $this->Role->findById(1);
        $this->set('userType', $userType);
        $this->set('title_for_layout', __('Update  ' . $userType['Role']['role'] . ' Profile', true));

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['id'] = $id;
            $this->request->data['User']['status'] = 1;
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->write('Auth.Admin', $this->User->read(null, $id));
                $this->Session->setFlash(__('The user has been saved successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }
        $this->request->data = $this->User->read(null, $id);
    }

    /**
     * Download files method in admin panel
     *
     * @return void
     */
    public function admin_downloadfile($name = null, $folder = null) {
        $this->response->file(APP . 'webroot' . DS . 'uploads' . DS . $folder . DS . $name, array('download' => true, 'name' => $name));
        return $this->response;
    }

    /**
     * Get State city method in admin panel as well agency registration in front end
     *
     * @return void
     */
    public function admin_get_state_city() {
        $this->autoRender = false;
        $loadType = $_POST['loadType'];
        $loadId = $_POST['loadId'];
        if ($loadType == "state") {
            $sql = $this->State->find('all', array('conditions' => array('country_iso_code' => $loadId), 'fields' => array('id', 'name'), 'order' => 'name ASC'));
            if (count($sql) > 0) {
                $HTML = "";
                foreach ($sql as $key => $val) {
                    $HTML.="<option value='" . $val['State']['id'] . "'>" . $val['State']['name'] . "</option>";
                }
                echo $HTML;
            }
        } else {
            $sql = $this->City->find('all', array('conditions' => array('state_code' => $loadId), 'fields' => array('id', 'name'), 'order' => 'name ASC'));
            if (count($sql) > 0) {
                $HTML = "";
                foreach ($sql as $key => $val) {
                    $HTML.="<option value='" . $val['City']['id'] . "'>" . $val['City']['name'] . "</option>";
                }
                echo $HTML;
            }
        }
    }

    /*     * ********************* Admin Panel Functions End ************************* */




    /*     * ********************* Front End Panel Common Functions Start ************************* */

    /**
     *  login for frontend all type of users
     */
    public function login() {
        if ($this->Auth->loggedIn()) {
            $role_id = $this->Auth->user('role_id');
            // Check login user's role and redirected to their dashboard page
            if ($role_id == MAN_ID) {
                return $this->redirect(SITEURL . 'man');
            } else if ($role_id == WOMAN_ID) {
                return $this->redirect(SITEURL . 'woman');
            } else if ($role_id == AGENCY_ID) {
                return $this->redirect(SITEURL . 'agency');
            }
            return false;
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // Remeber Me functionality
                if (isset($this->data['User']['remember']) && !empty($this->data['User']['remember'])) {
                    setcookie("username", $this->request->data['User']['email'], time() + 3600 * 24 * 7);
                    setcookie("password", $this->request->data['User']['password'], time() + 3600 * 24 * 7);
                } else {
                    setcookie("username", '');
                    setcookie("password", '');
                }
                $role_id = $this->Auth->user('role_id');

                // Check login user's role and redirected to their dashboard page
                if ($role_id == MAN_ID) {
                    return $this->redirect(SITEURL . 'man');
                } else if ($role_id == WOMAN_ID) {
                    return $this->redirect(SITEURL . 'woman');
                } else if ($role_id == AGENCY_ID) {
                    return $this->redirect(SITEURL . 'agency');
                }
                return false;
            } else {
                $this->Session->setFlash('Username or password is incorrect', 'error');
            }
        }
        $this->set('title_for_layout', 'User Login');
    }

    /**
     *  logout for frontend all type of users
     */
    public function logout() {
        if ($this->Session->check('Auth.User')) {
            $this->Session->setFlash('', null, null, 'auth');
            $this->Session->delete('Auth.User');
        }
        $this->Session->setFlash(__('Logout Successfully.'), 'success');
        $this->redirect($this->Auth->logout());
    }

    /**
     *  Man Registration
     */
    public function registration() {
        // Login user not able to register
        if ($this->Auth->loggedIn()) {
            $role_id = $this->Auth->user('role_id');
            // Check login user's role and redirected to their dashboard page
            if ($role_id == MAN_ID) {
                return $this->redirect(array('controller' => 'men', 'action' => 'index', 'man' => true));
            } else if ($role_id == WOMAN_ID) {
                return $this->redirect(array('controller' => 'women', 'action' => 'index', 'woman' => true));
            } else if ($role_id == AGENCY_ID) {
                return $this->redirect(array('controller' => 'agencies', 'action' => 'index', 'agency' => true));
            }
            return false;
        }

        if (isset($this->data) && !empty($this->data)) {
            // Calculate Height in inches
            if (isset($this->data['UserProfile']['height_feet']) && !empty($this->data['UserProfile']['height_feet'])) {
                $height_feet = $this->data['UserProfile']['height_feet'];
                if (isset($this->data['UserProfile']['height_inches']) && !empty($this->data['UserProfile']['height_inches'])) {
                    $height_inches = $this->data['UserProfile']['height_inches'];
                }
                $height = $this->common->calculateHeight($height_inches, $height_feet);
                $this->request->data['UserProfile']['height'] = $height;
            }
            $this->request->data['User']['activation_key'] = Security::generateAuthKey();
            if ($this->User->saveAssociated($this->request->data)) {
                $this->CommonEmail->activationLinkEmail($this->request->data['User']['email'], 'Activate your account', $this->request->data);
                $this->Session->setFlash(__('The user has been registered successfully.'), 'success');
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be registered. Please, try again.'), 'error');
            }
        }
    }
   
    
    public function activation($key = null){
        $user = $this->User->findByActivationKey($key);
        if (!$key && empty($user)) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        $this->User->updateAll(array('User.activation_key' => 'NULL','User.status' => ACTIVE), array('User.id' =>$user['User']['id']));
        $this->Session->setFlash(__('Your account has been successfully activate.'), 'success');
        $this->redirect(array('action' => 'login'));
        
        
    }
    /**
     *  Agency Registration
     */
    public function registration_agency() {

        if (isset($this->data) && !empty($this->data)) {
			 if ($this->User->saveAssociated($this->request->data)) {
				// Send Email
				$this->CommonEmail->AgencyRegistration($this->request->data);
                $this->Session->setFlash(__('Congratulations ! Your details have been sent to Admin for reviewal and approval!. Please give us 2 working days and we will get back to you. Thankyou!'), 'success');
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }
    }
    
    /*======================= USERS ADD BY ADMIN FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_user(){
	
            $this->set('title_for_layout', __('All Users',true));
            $conditions = array();

            $this->User->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "User.id ASC");
            $this->set('Users', $this->paginate('User'));
            
	}
        
	/**
	 * admin_user_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_user_view($id = null) {
                $this->set('title_for_layout', __('View User',true));
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		
		$this->set('users', $this->User->read(null, $id));
		$this->set('title_for_layout','View User');
	}
        
         /**
	 * admin_user_add method
	 *
	 * @return void
	 */	
	public function admin_user_add(){
		$this->set('title_for_layout', __('Add new User',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->User->save($this->request->data)) { 
				$this->Session->setFlash(__('The user has been saved successfully.'),'success');
				$this->redirect(array('action' => 'user'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_user_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_user_edit($id = null) {
                $this->set('title_for_layout', __('Edit Category',true));
		$this->Projects_category->id = $id;
		//check country exist
		if (!$this->Projects_category->exists()) {
			$this->Session->setFlash(__('Invalid Category.'),'error');
			$this->redirect(array('action' => 'user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projects_category->save($this->request->data)) {
                                $this->Session->setFlash(__('The category has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'user'));
			} else {
                               
                                
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Projects_category->read(null, $id);
	}
			
	/**
	 * admin_user_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_user_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projects_category->id = $id;
		if (!$this->Projects_category->exists()) {
			throw new NotFoundException(__('Invalid user'),'error');
		}     
                
		if ($this->Projects_category->delete()) {
			$this->Session->setFlash(__('User deleted'),'success');
			$this->redirect(array('action' => 'user'));
		}
		$this->Session->setFlash(__('User not deleted'),'error');
		$this->redirect(array('action' => 'user'));
	}

    /*     * ********************* Front End Panel Common Functions End ************************* */
}