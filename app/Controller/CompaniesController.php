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

class CompaniesController extends AppController {

	public $name = 'Companies';	
	public $uses = array('Industry_classifications','Locations_by_division','Company_structures');
	
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
                $this->set('controller', 'companies');
               // $this->set('model', 'Testimonial');
				
	}
	
	/*======================= COMPANY STRUCTURE FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_structure(){
	
            $this->set('title_for_layout', __('All Structure',true));
            $conditions = array();

            $this->Company_structures->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "Company_structures.structure ASC");
            $this->set('structures', $this->paginate('Company_structures'));
            
	}
        
	/**
	 * admin_structure_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_structure_view($id = null) {
                $this->set('title_for_layout', __('View Structure',true));
		$this->Company_structures->id = $id;
		if (!$this->Company_structures->exists()) {
			throw new NotFoundException(__('Invalid Structure'));
		}
		
		$this->set('structures', $this->Company_structures->read(null, $id));
		$this->set('title_for_layout','View Structure');
	}
        
         /**
	 * admin_structure_add method
	 *
	 * @return void
	 */	
	public function admin_structure_add(){
		$this->set('title_for_layout', __('Add new Structure',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Company_structures->save($this->request->data)) { 
				$this->Session->setFlash(__('The structure has been saved successfully.'),'success');
				$this->redirect(array('action' => 'structure'));
			} else {
				$this->Session->setFlash(__('The structure could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_structure_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_structure_edit($id = null) {
                $this->set('title_for_layout', __('Edit Structure',true));
		$this->Company_structures->id = $id;
		//check country exist
		if (!$this->Company_structures->exists()) {
			$this->Session->setFlash(__('Invalid Structure.'),'error');
			$this->redirect(array('action' => 'structure'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Company_structures->save($this->request->data)) {
                                $this->Session->setFlash(__('The structure has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'structure'));
			} else {
                               
                                
				$this->Session->setFlash(__('The structure could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Company_structures->read(null, $id);
	}
			
	/**
	 * admin_structure_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_structure_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Company_structures->id = $id;
		if (!$this->Company_structures->exists()) {
			throw new NotFoundException(__('Invalid structure'),'error');
		}     
                
		if ($this->Company_structures->delete()) {
			$this->Session->setFlash(__('Structure deleted'),'success');
			$this->redirect(array('action' => 'structure'));
		}
		$this->Session->setFlash(__('Structure not deleted'),'error');
		$this->redirect(array('action' => 'structure'));
	}
	
	/*======================= COMPANY INDUSTRY CLASSIFICATION FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_classification(){
	
            $this->set('title_for_layout', __('All Classification',true));
            $conditions = array();

            $this->Industry_classifications->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "Industry_classifications.classification ASC");
            $this->set('classifications', $this->paginate('Industry_classifications'));
            
	}
        
	/**
	 * admin_classification_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_classification_view($id = null) {
                $this->set('title_for_layout', __('View Classifications',true));
		$this->Industry_classifications->id = $id;
		if (!$this->Industry_classifications->exists()) {
			throw new NotFoundException(__('Invalid Classifications'));
		}
		
		$this->set('classifications', $this->Industry_classifications->read(null, $id));
		$this->set('title_for_layout','View Classifications');
	}
        
         /**
	 * admin_classification_add method
	 *
	 * @return void
	 */	
	public function admin_classification_add(){
		$this->set('title_for_layout', __('Add new Classification',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Industry_classifications->save($this->request->data)) { 
				$this->Session->setFlash(__('The classification has been saved successfully.'),'success');
				$this->redirect(array('action' => 'classification'));
			} else {
				$this->Session->setFlash(__('The classification could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_classification_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_classification_edit($id = null) {
                $this->set('title_for_layout', __('Edit Classification',true));
		$this->Industry_classifications->id = $id;
		//check country exist
		if (!$this->Industry_classifications->exists()) {
			$this->Session->setFlash(__('Invalid classification.'),'error');
			$this->redirect(array('action' => 'classification'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Industry_classifications->save($this->request->data)) {
                                $this->Session->setFlash(__('The classification has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'classification'));
			} else {
                               
                                
				$this->Session->setFlash(__('The classification could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Industry_classifications->read(null, $id);
	}
			
	/**
	 * admin_classification_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_classification_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Industry_classifications->id = $id;
		if (!$this->Industry_classifications->exists()) {
			throw new NotFoundException(__('Invalid classification'),'error');
		}     
                
		if ($this->Industry_classifications->delete()) {
			$this->Session->setFlash(__('Classification deleted'),'success');
			$this->redirect(array('action' => 'classification'));
		}
		$this->Session->setFlash(__('Classification not deleted'),'error');
		$this->redirect(array('action' => 'classification'));
	}
        
        /*======================= COMPANY LOCATION BY DIVISION FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_division(){
	
            $this->set('title_for_layout', __('All Division',true));
            $conditions = array();

            $this->Locations_by_division->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "Locations_by_division.division_type ASC");
            $this->set('divisions', $this->paginate('Locations_by_division'));
            
	}
        
	/**
	 * admin_division_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_division_view($id = null) {
                $this->set('title_for_layout', __('View Division',true));
		$this->Locations_by_division->id = $id;
		if (!$this->Locations_by_division->exists()) {
			throw new NotFoundException(__('Invalid Division'));
		}
		
		$this->set('divisions', $this->Locations_by_division->read(null, $id));
		$this->set('title_for_layout','View divisions');
	}
        
         /**
	 * admin_division_add method
	 *
	 * @return void
	 */	
	public function admin_division_add(){
		$this->set('title_for_layout', __('Add new Division',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Locations_by_division->save($this->request->data)) { 
				$this->Session->setFlash(__('The division has been saved successfully.'),'success');
				$this->redirect(array('action' => 'division'));
			} else {
				$this->Session->setFlash(__('The division could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_division_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_division_edit($id = null) {
                $this->set('title_for_layout', __('Edit Division',true));
		$this->Locations_by_division->id = $id;
		//check country exist
		if (!$this->Locations_by_division->exists()) {
			$this->Session->setFlash(__('Invalid division.'),'error');
			$this->redirect(array('action' => 'division'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Locations_by_division->save($this->request->data)) {
                                $this->Session->setFlash(__('The division has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'division'));
			} else {
                               
                                
				$this->Session->setFlash(__('The division could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->Locations_by_division->read(null, $id);
	}
			
	/**
	 * admin_division_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_division_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Locations_by_division->id = $id;
		if (!$this->Locations_by_division->exists()) {
			throw new NotFoundException(__('Invalid division'),'error');
		}     
                
		if ($this->Locations_by_division->delete()) {
			$this->Session->setFlash(__('Division deleted'),'success');
			$this->redirect(array('action' => 'division'));
		}
		$this->Session->setFlash(__('Division not deleted'),'error');
		$this->redirect(array('action' => 'division'));
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