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

class ProjectsController extends AppController {

	public $name = 'Projects';	
	public $uses = array('ProjectsCategory','ProjectsSource','SubjectExpenseType');
	
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
                $this->set('controller', 'projects');
               // $this->set('model', 'Testimonial');
				
	}
	
	/*======================= PROJECT CATEGORY FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_category(){
	
            $this->set('title_for_layout', __('All Category',true));
            $conditions = array();

            $this->ProjectsCategory->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "ProjectsCategory.category ASC");
            $this->set('categories', $this->paginate('ProjectsCategory'));
            
	}
        
	/**
	 * admin_category_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_category_view($id = null) {
                $this->set('title_for_layout', __('View Category',true));
		$this->ProjectsCategory->id = $id;
		if (!$this->ProjectsCategory->exists()) {
			throw new NotFoundException(__('Invalid Category'));
		}
		
		$this->set('categories', $this->ProjectsCategory->read(null, $id));
		$this->set('title_for_layout','View Category');
	}
        
         /**
	 * admin_category_add method
	 *
	 * @return void
	 */	
	public function admin_category_add(){
		$this->set('title_for_layout', __('Add new Category',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->ProjectsCategory->save($this->request->data)) { 
				$this->Session->setFlash(__('The category has been saved successfully.'),'success');
				$this->redirect(array('action' => 'category'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_category_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_category_edit($id = null) {
                $this->set('title_for_layout', __('Edit Category',true));
		$this->ProjectsCategory->id = $id;
		//check country exist
		if (!$this->ProjectsCategory->exists()) {
			$this->Session->setFlash(__('Invalid Category.'),'error');
			$this->redirect(array('action' => 'category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProjectsCategory->save($this->request->data)) {
                                $this->Session->setFlash(__('The category has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'category'));
			} else {
                               
                                
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->ProjectsCategory->read(null, $id);
	}
			
	/**
	 * admin_category_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_category_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ProjectsCategory->id = $id;
		if (!$this->ProjectsCategory->exists()) {
			throw new NotFoundException(__('Invalid category'),'error');
		}     
                
		if ($this->ProjectsCategory->delete()) {
			$this->Session->setFlash(__('Category deleted'),'success');
			$this->redirect(array('action' => 'category'));
		}
		$this->Session->setFlash(__('Category not deleted'),'error');
		$this->redirect(array('action' => 'category'));
	}
	
        /*======================= PROJECT SOURCES FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_source(){
	
            $this->set('title_for_layout', __('All Source',true));
            $conditions = array();

            $this->ProjectsSource->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "ProjectsSource.source ASC");
            $this->set('sources', $this->paginate('ProjectsSource'));
            
	}
        
	/**
	 * admin_source_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_source_view($id = null) {
                $this->set('title_for_layout', __('View Source',true));
		$this->ProjectsSource->id = $id;
		if (!$this->ProjectsSource->exists()) {
			throw new NotFoundException(__('Invalid Source'));
		}
		
		$this->set('sources', $this->ProjectsSource->read(null, $id));
		$this->set('title_for_layout','View Source');
	}
        
         /**
	 * admin_source_add method
	 *
	 * @return void
	 */	
	public function admin_source_add(){
		$this->set('title_for_layout', __('Add new Source',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->ProjectsSource->save($this->request->data)) { 
				$this->Session->setFlash(__('The source has been saved successfully.'),'success');
				$this->redirect(array('action' => 'source'));
			} else {
				$this->Session->setFlash(__('The source could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_source_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_source_edit($id = null) {
                $this->set('title_for_layout', __('Edit Source',true));
		$this->ProjectsSource->id = $id;
		//check country exist
		if (!$this->ProjectsSource->exists()) {
			$this->Session->setFlash(__('Invalid Source.'),'error');
			$this->redirect(array('action' => 'source'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProjectsSource->save($this->request->data)) {
                                $this->Session->setFlash(__('The source has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'source'));
			} else {
                               
                                
				$this->Session->setFlash(__('The source could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->ProjectsSource->read(null, $id);
	}
			
	/**
	 * admin_source_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_source_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ProjectsSource->id = $id;
		if (!$this->ProjectsSource->exists()) {
			throw new NotFoundException(__('Invalid Source'),'error');
		}     
                
		if ($this->ProjectsSource->delete()) {
			$this->Session->setFlash(__('Source deleted'),'success');
			$this->redirect(array('action' => 'source'));
		}
		$this->Session->setFlash(__('Source not deleted'),'error');
		$this->redirect(array('action' => 'source'));
	}
	
        /*======================= PROJECT EXPENSE FUNCTIONS =========================*/
        
        /**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function admin_expense(){
	
            $this->set('title_for_layout', __('All Expense',true));
            $conditions = array();

            $this->SubjectExpenseType->recursive = 0;
            $this->paginate = array("limit" => 15, "order" => "SubjectExpenseType.expense ASC");
            $this->set('expenses', $this->paginate('SubjectExpenseType'));
            
	}
        
	/**
	 * admin_status_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_expense_view($id = null) {
                $this->set('title_for_layout', __('View Expense',true));
		$this->SubjectExpenseType->id = $id;
		if (!$this->SubjectExpenseType->exists()) {
			throw new NotFoundException(__('Invalid Expense'));
		}
		
		$this->set('expenses', $this->SubjectExpenseType->read(null, $id));
		$this->set('title_for_layout','View expense');
	}
        
         /**
	 * admin_status_add method
	 *
	 * @return void
	 */	
	public function admin_expense_add(){
		$this->set('title_for_layout', __('Add new Expense',true));
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->SubjectExpenseType->save($this->request->data)) { 
				$this->Session->setFlash(__('The expense has been saved successfully.'),'success');
				$this->redirect(array('action' => 'expense'));
			} else {
				$this->Session->setFlash(__('The expense could not be saved. Please, try again.'),'error');
		
			}
		}
	}
        
        /**
	 * admin_status_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_expense_edit($id = null) {
                $this->set('title_for_layout', __('Edit Expense',true));
		$this->SubjectExpenseType->id = $id;
		//check country exist
		if (!$this->SubjectExpenseType->exists()) {
			$this->Session->setFlash(__('Invalid expense.'),'error');
			$this->redirect(array('action' => 'expense'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SubjectExpenseType->save($this->request->data)) {
                                $this->Session->setFlash(__('The expense has been saved successfully.'),'success');
                                $this->redirect(array('action' => 'expense'));
			} else {
                               
                                
				$this->Session->setFlash(__('The expense could not be saved. Please, try again.'),'error');
			}
                        
		} 

		$this->request->data = $this->SubjectExpenseType->read(null, $id);
	}
			
	/**
	 * admin_status_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_expense_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SubjectExpenseType->id = $id;
		if (!$this->SubjectExpenseType->exists()) {
			throw new NotFoundException(__('Invalid expense'),'error');
		}     
                
		if ($this->SubjectExpenseType->delete()) {
			$this->Session->setFlash(__('Expense deleted'),'success');
			$this->redirect(array('action' => 'expense'));
		}
		$this->Session->setFlash(__('Expense not deleted'),'error');
		$this->redirect(array('action' => 'expense'));
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