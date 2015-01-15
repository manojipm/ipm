<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
        'Session',
        'Common',
        'Auth' => array(            
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email','password'=>'password'),
                    'scope' => array('User.status' => 1, 'User.role_id' => '1')
                )
            )
        ),
        'RequestHandler'
    );
	var $helpers=array('Html','Session','Form','Text','Time');
	
	public function beforeFilter(){
		
		if ($this->request->prefix == 'admin') {
		 
			$this->layout = 'admin';
			// Specify which controller/action handles logging in:
			AuthComponent::$sessionKey = 'Auth.Admin'; 
			
			$this->Auth->loginAction	=	array('controller'=>'users','action'=>'login', 'admin' => true);
			$this->Auth->loginRedirect	= array('controller'=>'dashboards','action'=>'index', 'admin' => true);
			$this->Auth->logoutRedirect	= array('controller'=>'users','action'=>'login', 'admin' => true);
					
			$scope = array('User.status' => 1, 'User.role_id' => '1');
			
			$this->Auth->authenticate = array ('Form' => array (
				'userModel' => 'User',
				'fields' => array('username' => 'email','password'=>'password'),
				'scope'  => $scope,
															));
			$this->Auth->allow('admin_login');
		
		}else if ($this->request->prefix == 'agency') {
			$this->checkpermission(AGENCY_ID);				
		}else if ($this->request->prefix == 'man') {
			$this->checkpermission(MAN_ID);				
		}else if ($this->request->prefix == 'woman') {
			$this->checkpermission(WOMAN_ID);				
		}else {
				
			// Specify which controller/action handles logging in:
			AuthComponent::$sessionKey = 'Auth.User'; 
			$this->Auth->loginAction	=	array('controller'=>'users','action'=>'login');
			$this->Auth->loginRedirect	= array('controller'=>'users','action'=>'myaccount');
			$this->Auth->logoutRedirect	= array('controller'=>'users','action'=>'login');
					
			$scope = array('User.status' => 1, 'User.role_id !=' => '1');
			
			$this->Auth->authenticate = array ('Form' => array (
				'userModel' => 'User',
				'fields' => array('username' => 'email','password'=>'password'),
				'scope'  => $scope,
			));
			$this->Auth->allow('login');
		}
		
		//set all setting value in setting array...................
		/* if($this->Session->read('Setting')==''){	
			$this->loadModel('Setting');
			$setting=$this->Setting->find('first');
			if(!empty($setting)){
				$this->Session->write('Setting',$setting['Setting']);
			}
		} */
			
	}
	
	function checkpermission($prefix = ''){
		$role_id = $this->Auth->user('role_id');
		if($prefix != $role_id){
			$this->Session->setFlash('You are not authorised to access this location.', 'error');
			switch($role_id){
				case AGENCY_ID:
						$this->redirect(SITEURL.'agency');
						break;
				case MAN_ID:
						$this->redirect(SITEURL.'man');
						break;
				case WOMAN_ID:
						$this->redirect(SITEURL.'woman');
						break;
				default:
					$this->redirect(SITEURL);
						break;
			}
		}
		return true;
	}
}
