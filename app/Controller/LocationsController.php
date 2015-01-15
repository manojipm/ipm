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

App::uses('Controller/Component','Auth','Session', 'RequestHandler');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */

class LocationsController extends AppController {

	public $name = 'Locations';	
	public $uses = array('Country','State','City','Zone');
	
	/**
	* check login for admin and frontend user
	* allow and deny user
	*/
	//public $components = array('Email');
	
	/**
	* Helpers
	*
	* @var array
	*/
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text','Common');	
	
	public function beforeFilter() {
		parent::beforeFilter();	
                $this->set('controller', 'locations');
               // $this->set('model', 'Testimonial');
				
	}
	
	/**
	 * admin_add method
	 *
	 * @return void
	 */	
	public function admin_add(){
		$this->set('title_for_layout', __('Add new testimonial',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Testimonial->save($this->request->data)) { 
				$this->Session->setFlash(__('The testimonial has been saved successfully.'),'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonial could not be saved. Please, try again.'),'error');
		
			}
		}
	}
	
        /*==================== COUNTYR FUNCTIONS ========================*/
        
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_country(){
		
            $this->set('title_for_layout', __('All Countires',true));
            $conditions = array();
            
            $this->recursive = 0;
            $this->paginate = array("conditions" => $conditions, "limit" => 15, "order" => "Country.country ASC");
            $this->set('countries', $this->paginate('Country'));
            
	}
	
	/**
	 * admin_country_add method
	 *
	 * @return void
	 */	
	public function admin_country_add(){
		$this->set('title_for_layout', __('Add new Country',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			
			if ($this->Country->save($this->request->data)) { 
				$this->Session->setFlash(__('The country has been saved successfully.'),'success');
				$this->redirect(array('action' => 'country'));
			} else {
				$this->Session->setFlash(__('The country could not be saved. Please, try again.'),'error');
		
			}
		}
	}
	
	/**
	 * admin_country_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_country_edit($id = null) {
                $this->set('title_for_layout', __('Edit Country',true));
		$this->Country->id = $id;
		//check country exist
		if (!$this->Country->exists()) {
			$this->Session->setFlash(__('Invalid Country.'),'error');
			$this->redirect(array('action' => 'country'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Country->save($this->request->data)) {
                                $this->Session->setFlash(__('The country has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'country'));
			} else {
                               
                                
				$this->Session->setFlash(__('The country could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Country->read(null, $id);
	}
	
	
	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_country_view($id = null) {
                $this->set('title_for_layout', __('View Country',true));
		$this->Country->id = $id;
		if (!$this->Country->exists()) {
			throw new NotFoundException(__('Invalid country'));
		}
		
		$this->set('countries', $this->Country->read(null, $id));
		$this->set('title_for_layout','View Country');
	}
			
	/**
	 * admin_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_country_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Country->id = $id;
		if (!$this->Country->exists()) {
			throw new NotFoundException(__('Invalid country'),'error');
		}     
                
		if ($this->Country->delete()) {
			$this->Session->setFlash(__('Country deleted'),'success');
			$this->redirect(array('action' => 'country'));
		}
		$this->Session->setFlash(__('Country not deleted'),'error');
		$this->redirect(array('action' => 'country'));
	}	
	
        /*======================= STATE FUNCTIONS =========================*/
        
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_state(){
	
            $this->set('title_for_layout', __('All States',true));
            $conditions = array();

            $this->State->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "State.state ASC");
            $this->set('states', $this->paginate('State'));
            
	}
        
        
	/**
	 * admin_state_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_state_view($id = null) {
                $this->set('title_for_layout', __('View State',true));
		$this->State->id = $id;
		if (!$this->State->exists()) {
			throw new NotFoundException(__('Invalid state'));
		}
		
		$this->set('states', $this->State->read(null, $id));
		$this->set('title_for_layout','View State');
	}
        
        /**
	 * admin_state_add method
	 *
	 * @return void
	 */	
	public function admin_state_add(){
		$this->set('title_for_layout', __('Add new State',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->State->save($this->request->data)) { 
				$this->Session->setFlash(__('The state has been saved successfully.'),'success');
				$this->redirect(array('action' => 'state'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_state_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_state_edit($id = null) {
                $this->set('title_for_layout', __('Edit State',true));
		$this->State->id = $id;
		//check country exist
		if (!$this->State->exists()) {
			$this->Session->setFlash(__('Invalid State.'),'error');
			$this->redirect(array('action' => 'state'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->State->save($this->request->data)) {
                                $this->Session->setFlash(__('The state has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'state'));
			} else {
                               
                                
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->State->read(null, $id);
	}
		
	/**
	 * admin_state_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_state_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->State->id = $id;
		if (!$this->State->exists()) {
			throw new NotFoundException(__('Invalid state'),'error');
		}     
                
		if ($this->State->delete()) {
			$this->Session->setFlash(__('State deleted'),'success');
			$this->redirect(array('action' => 'state'));
		}
		$this->Session->setFlash(__('State not deleted'),'error');
		$this->redirect(array('action' => 'state'));
	}
        
        /*======================= CITY FUNCTIONS =========================*/
        
        
         /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_city(){
	
            $this->set('title_for_layout', __('All City',true));
            $conditions = array();

            $this->State->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "City.city ASC");
            $this->set('cities', $this->paginate('City'));
            
	}
        
        /**
	 * admin_city_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_city_view($id = null) {
                $this->set('title_for_layout', __('View City',true));
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid City'));
		}
		
		$this->set('cities', $this->City->read(null, $id));
		$this->set('title_for_layout','View City');
	}
        
         /**
	 * admin_city_add method
	 *
	 * @return void
	 */	
	public function admin_city_add(){
		$this->set('title_for_layout', __('Add new City',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->City->save($this->request->data)) { 
				$this->Session->setFlash(__('The city has been saved successfully.'),'success');
				$this->redirect(array('action' => 'city'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_city_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_city_edit($id = null) {
                $this->set('title_for_layout', __('Edit City',true));
		$this->City->id = $id;
		//check country exist
		if (!$this->City->exists()) {
			$this->Session->setFlash(__('Invalid City.'),'error');
			$this->redirect(array('action' => 'city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
                                $this->Session->setFlash(__('The city has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'city'));
			} else {
                               
                                
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->City->read(null, $id);
	}
        	
	/**
	 * admin_city_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_city_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'),'error');
		}     
                
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'),'success');
			$this->redirect(array('action' => 'city'));
		}
		$this->Session->setFlash(__('City not deleted'),'error');
		$this->redirect(array('action' => 'city'));
	}
        
        /*======================= ZONE FUNCTIONS =========================*/
        
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_zone(){
	
            $this->set('title_for_layout', __('All Zone',true));
            $conditions = array();

            $this->Zone->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "Zone.zone ASC");
            $this->set('zones', $this->paginate('Zone'));
            
	}
        
	/**
	 * admin_zone_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_zone_view($id = null) {
                $this->set('title_for_layout', __('View Zone',true));
		$this->Zone->id = $id;
		if (!$this->Zone->exists()) {
			throw new NotFoundException(__('Invalid Zone'));
		}
		
		$this->set('zones', $this->Zone->read(null, $id));
		$this->set('title_for_layout','View Zone');
	}
        
         /**
	 * admin_city_add method
	 *
	 * @return void
	 */	
	public function admin_zone_add(){
		$this->set('title_for_layout', __('Add new Zone',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Zone->save($this->request->data)) { 
				$this->Session->setFlash(__('The zone has been saved successfully.'),'success');
				$this->redirect(array('action' => 'zone'));
			} else {
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_city_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_zone_edit($id = null) {
                $this->set('title_for_layout', __('Edit Zone',true));
		$this->Zone->id = $id;
		//check country exist
		if (!$this->Zone->exists()) {
			$this->Session->setFlash(__('Invalid Zone.'),'error');
			$this->redirect(array('action' => 'zone'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Zone->save($this->request->data)) {
                                $this->Session->setFlash(__('The zone has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'zone'));
			} else {
                               
                                
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Zone->read(null, $id);
	}
			
	/**
	 * admin_city_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_zone_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Zone->id = $id;
		if (!$this->Zone->exists()) {
			throw new NotFoundException(__('Invalid zone'),'error');
		}     
                
		if ($this->Zone->delete()) {
			$this->Session->setFlash(__('Zone deleted'),'success');
			$this->redirect(array('action' => 'zone'));
		}
		$this->Session->setFlash(__('Zone not deleted'),'error');
		$this->redirect(array('action' => 'zone'));
	}
	
	
	/**
	* admin_update_status method
	* 
	* @common for all location attributes like country . city , states etc.
	* @return
	*/
	public function admin_update_status() {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
               
              	$ForModel = $this->params['data']['ForModel'];
               
                $this->request->data[$ForModel]['id'] = $this->params['data']['id'];
                $this->request->data[$ForModel]['status'] = $this->params['data']['status'];
                
                $setModel = $this->{$ForModel};
               
                if($setModel->save($this->request->data)) {
                    pr($this->request->data[$ForModel]);
                    return true;
                } else {
                    pr($this->request->data[$ForModel]['status']);
                    return false;
                }
            }
        }
}