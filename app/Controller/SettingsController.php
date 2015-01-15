<?php
/**
 * Setting controller.
 *
 * This file will render views from views/Settings/
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

App::uses('AppController', 'Controller');

/**
 * Setting controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 */
class SettingsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Settings';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html','Form','Session');



/**
 * admin_edit method
 * 
 * @return void
 */
	public function admin_edit() {
	
		$id=1;
				
		$this->Setting->id = $id;
		
		if ($this->request->is('post') || $this->request->is('put')) {
			foreach($this->request->data as $key=>$value){
				$data = array();
				$data['Setting']['id'] 	= $value[1];
				$data['Setting']['value']  = $value[0];
			
				$this->Setting->save($data);
				
			}
			return $this->redirect(array('action' => 'edit'));
		
		
		} else {
				$datas = $this->Setting->find('all');
				
				$title_for_layout = 'Admin Setting';
				
				$this->set(compact('title_for_layout','datas'));
				
		}
		$this->set('title_for_layout','Edit Settings - Trip A Room');
	
	}
	
	
}
