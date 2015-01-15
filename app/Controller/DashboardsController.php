<?php
/**
 * Dashboard controller.
 *
 * This file will render views from views/Dashboards/
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
 * Dashboards controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/dashboards-controller.html
 */
class DashboardsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Dashboards';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html', 'Session');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function admin_index() {
		$this->layout = 'dashboard';
		
		//$this->loadModel('User');
		//$men = $this->User->find('count', array('conditions'=>array('User.role_id'=>array('3'))));
		//$women = $this->User->find('count', array('conditions'=>array('User.role_id'=>array('4'))));
		//$agencies = $this->User->find('count', array('conditions'=>array('User.role_id'=>array('2'))));
		
		//$this->loadModel('Testimonial');
		//$testimonials = $this->Testimonial->find('count', array());
		
	//	$this->loadModel('New');
	//	$news = $this->New->find('count', array());
	
	//	$this->loadModel('Page');
	//	$pages = $this->Page->find('count', array());
		
	//	$this->loadModel('Plan');
	//	$plans = $this->Plan->find('count', array());
		
		$title_for_layout = 'Admin Dashboard';
		$this->set(compact('title_for_layout','men','women', 'locations','news','pages','agencies','plans'));
	}


}
