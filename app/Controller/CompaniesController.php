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
	public $uses = array('IndustryClassification','LocationsByDivision','CompanyStructure');
	
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

            $this->CompanyStructure->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "CompanyStructure.structure ASC");
            $this->set('structures', $this->paginate('CompanyStructure'));
            
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
		$this->CompanyStructure->id = $id;
		if (!$this->CompanyStructure->exists()) {
			throw new NotFoundException(__('Invalid Structure'));
		}
		
		$this->set('structures', $this->CompanyStructure->read(null, $id));
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
			
			if ($this->CompanyStructure->save($this->request->data)) { 
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
		$this->CompanyStructure->id = $id;
		//check country exist
		if (!$this->CompanyStructure->exists()) {
			$this->Session->setFlash(__('Invalid Structure.'),'error');
			$this->redirect(array('action' => 'structure'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CompanyStructure->save($this->request->data)) {
                                $this->Session->setFlash(__('The structure has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'structure'));
			} else {
                               
                                
				$this->Session->setFlash(__('The structure could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->CompanyStructure->read(null, $id);
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
		$this->CompanyStructure->id = $id;
		if (!$this->CompanyStructure->exists()) {
			throw new NotFoundException(__('Invalid structure'),'error');
		}     
                
		if ($this->CompanyStructure->delete()) {
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

            $this->IndustryClassification->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "IndustryClassification.classification ASC");
            $this->set('classifications', $this->paginate('IndustryClassification'));
            
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
		$this->IndustryClassification->id = $id;
		if (!$this->IndustryClassification->exists()) {
			throw new NotFoundException(__('Invalid Classifications'));
		}
		
		$this->set('classifications', $this->IndustryClassification->read(null, $id));
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
			
			if ($this->IndustryClassification->save($this->request->data)) { 
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
		$this->IndustryClassification->id = $id;
		//check country exist
		if (!$this->IndustryClassification->exists()) {
			$this->Session->setFlash(__('Invalid classification.'),'error');
			$this->redirect(array('action' => 'classification'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->IndustryClassification->save($this->request->data)) {
                                $this->Session->setFlash(__('The classification has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'classification'));
			} else {
                               
                                
				$this->Session->setFlash(__('The classification could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->IndustryClassification->read(null, $id);
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
		$this->IndustryClassification->id = $id;
		if (!$this->IndustryClassification->exists()) {
			throw new NotFoundException(__('Invalid classification'),'error');
		}     
                
		if ($this->IndustryClassification->delete()) {
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

            $this->LocationsByDivision->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "LocationsByDivision.division_type ASC");
            $this->set('divisions', $this->paginate('LocationsByDivision'));
            
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
		$this->LocationsByDivision->id = $id;
		if (!$this->LocationsByDivision->exists()) {
			throw new NotFoundException(__('Invalid Division'));
		}
		
		$this->set('divisions', $this->LocationsByDivision->read(null, $id));
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
			
			if ($this->LocationsByDivision->save($this->request->data)) { 
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
		$this->LocationsByDivision->id = $id;
		//check country exist
		if (!$this->LocationsByDivision->exists()) {
			$this->Session->setFlash(__('Invalid division.'),'error');
			$this->redirect(array('action' => 'division'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->LocationsByDivision->save($this->request->data)) {
                                $this->Session->setFlash(__('The division has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'division'));
			} else {
                               
                                
				$this->Session->setFlash(__('The division could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->LocationsByDivision->read(null, $id);
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
		$this->LocationsByDivision->id = $id;
		if (!$this->LocationsByDivision->exists()) {
			throw new NotFoundException(__('Invalid division'),'error');
		}     
                
		if ($this->LocationsByDivision->delete()) {
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