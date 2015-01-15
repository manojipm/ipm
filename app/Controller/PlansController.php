<?php
/**
 * Plans controller.
 *
 * This file will render views from views/Plans/
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

App::uses('Controller/Component','Auth','Session', 'RequestHandler');
App::uses('CakeEmail', 'Network/Email');
/**
 * Plans Controller
 *
 * @property Plan $Plan
 * @property PaginatorComponent $Paginator
 */

class PlansController extends AppController {

	var $name = 'Plans';	
	public $uses = array('Plan','PlansActivity');
	
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
                $this->set('controller', 'plans');
                $this->set('model', 'Plan');
		$this->Auth->allow('');	
	}
	
	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	
	public function admin_index(){
		$this->set('title_for_layout', __('All Plans',true));
                $this->Plan->recursive = 0;
                $conditions = array();
                $this->paginate = array("conditions" => $conditions, "order" => "Plan.id DESC");
                $this->set('sliders', $this->paginate());
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */	
	
	public function admin_add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Plan->save($this->request->data)) {
					if(isset($this->request->data['Activity']['activity_id']) && !empty($this->request->data['Activity']['activity_id'])){
						$plan_id = $this->Plan->getLastInsertId();
						$PlansActivitys['PlansActivity']['plan_id'] = $plan_id;						
						foreach($this->request->data['Activity']['activity_id'] as $activity_id  => $credit_fee){
							$PlansActivitys['PlansActivity']['id'] = '';
							$PlansActivitys['PlansActivity']['activity_id'] = $activity_id;
							$PlansActivitys['PlansActivity']['credit_fee'] = $credit_fee;
							$this->PlansActivity->save($PlansActivitys);
						}
					}
					$this->Session->setFlash(__('Plans has been saved'),'success');
					$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Plans could not be saved. Please, try again.'),'error');
			}
		}
		
		$this->loadModel('Activity');
		$activities = $this->Activity->find('all', array('conditions' => array('Activity.status' => 1), 'fields' => array('id', 'title'), 'order'=>'Activity.sortOrder ASC'));
		$this->set('activities', $activities);
	}
	
	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Plan->id = $id;
		//check category exist
		if (!$this->Plan->exists()) {
			$this->Session->setFlash(__('Invalid Plans.'),'flash_custom_error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!isset($this->request->data['Plan']['status'])){
				$this->request->data['Plan']['status'] = 0;
			}
			if ($this->Plan->save($this->request->data)) {
					if(isset($this->request->data['Activity']['activity_id']) && !empty($this->request->data['Activity']['activity_id'])){
						$plan_id = $this->request->data['Plan']['id'];
						// Delte All existing entries for current plan_id
						$this->PlansActivity->deleteAll(array('PlansActivity.plan_id' => $plan_id));
						// Save all entries 
						$PlansActivitys['PlansActivity']['plan_id'] = $plan_id;						
						foreach($this->request->data['Activity']['activity_id'] as $activity_id  => $credit_fee){
							$PlansActivitys['PlansActivity']['id'] = '';
							$PlansActivitys['PlansActivity']['activity_id'] = $activity_id;
							$PlansActivitys['PlansActivity']['credit_fee'] = $credit_fee;
							$this->PlansActivity->save($PlansActivitys);
						}
					}					
					$this->Session->setFlash(__('Plans has been updated'),'success');
					$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('Plans could not be updated. Please, try again.'),'error');
			}
		}
		$this->loadModel('Activity');
		$this->Activity->recursive = 2;
		$this->Activity->bindModel(array('hasOne'=>array('PlansActivity'=>array(
			'className'=>'PlansActivity',
			'conditions'=>array('PlansActivity.plan_id'=>$id)
			)
		)));
		$activities = $this->Activity->find('all', array('conditions' => array('Activity.status' => 1), 'fields' => array('id', 'title'), 'order'=>'Activity.sortOrder ASC'));
		$this->set('activities', $activities);
        
		
		$this->request->data = $this->Plan->read(null, $id);
       // pr($activities);
		
	}
	
	public function admin_update_status() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->request->data['Plan']['id'] = $this->params['data']['id'];
			$this->request->data['Plan']['status'] = $this->params['data']['status'];
			if($this->Plan->save($this->request->data)){
				return true;					
			}else{
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
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Invalid Plan'));
		}
		$this->loadModel('Activity');
		$this->Activity->recursive = 2;
		$this->Activity->bindModel(array('hasOne'=>array('PlansActivity'=>array(
			'className'=>'PlansActivity',
			'conditions'=>array('PlansActivity.plan_id'=>$id)
			)
		)));
		$activities = $this->Activity->find('all', array('conditions' => array('Activity.status' => 1), 'fields' => array('id', 'title'), 'order'=>'Activity.sortOrder ASC'));
		$this->set('activities', $activities);
        
		$this->set('plans', $this->Plan->read(null, $id));
		$this->set('title_for_layout','View Plan');
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
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Invalid plans'),'flash_custom_error');
		}
		if ($this->Plan->delete()) {
			$this->Session->setFlash(__('Plans deleted'),'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Plans was not deleted'),'flash_custom_error');
		$this->redirect(array('action' => 'index'));
	}	
	
	
}