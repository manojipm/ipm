<?php

/**
 * Products controller.
 *
 * This file will render views from views/Products/
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
 * Products Controller
 *
 * @property New $New
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

    var $name = 'Products';
    public $uses = array('Product', 'Role');

    /**
     * check login for admin and frontend new
     * allow and deny new
     */
    public $components = array('Email','Session','Image');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');
    
    
    public function isAuthorized() {
        return true;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('controller', 'products');
        $this->set('model', 'Product');
        $this->Auth->allow('*');
    }
    
    
    
    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All Products', true));
        $this->Product->recursive = 0;
        $conditions = array();
        $conditions = array('Product.type' => 'virtual');		
        $this->paginate = array("conditions" => $conditions, "order" => "Product.id DESC");
        $this->set('virtualGifts', $this->paginate());
		
		$conditions = array('Product.type' => 'love');		
        $this->paginate = array("conditions" => $conditions, "order" => "Product.id DESC");
        $this->set('melodys', $this->paginate());
		
		$conditions = array('Product.type' => 'romance');		
        $this->paginate = array("conditions" => $conditions, "order" => "Product.id DESC");
        $this->set('romances', $this->paginate());
		
		$conditions = array('Product.type' => 'real');
        $this->paginate = array("conditions" => $conditions, "order" => "Product.id DESC");
        $this->set('realGifts', $this->paginate());
		
		$this->loadModel('Category');
		$categories =  $this->Category->find('list',array('conditions'=>array('Category.status' => 1), 'fields'=>array('Category.id', 'Category.category')));
		$this->set('categories', $categories);
    }

	/***************** Virtual Gift Section *****************/
	
	public function admin_add_virtual_gifts(){
		 if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Virtual gift has been saved.'), 'success');
                $this->redirect(array('action' => 'index#virtual'));
            } else {
                $this->Session->setFlash(__('Virtual gift could not be saved. Please, try again.'), 'error');
            }
        }
	}
	
	public function admin_edit_virtual_gifts($id = ''){
		 if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Virtual gift has been saved.'), 'success');
                $this->redirect(array('action' => 'index#virtual'));
            } else {
                $this->Session->setFlash(__('Virtual gift could not be saved. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->Product->read(null, $id);
		}
		$errors = $this->Product->validationErrors;
		$this->set('errors',$errors);
		
		
	}
	
	public function admin_delete_virtual_gifts($id = ''){
		$this->loadModel('Product');
		$this->Product->id = $id;
		if(!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid Product.'));
		}
		$products = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'fields' => array('Product.image_file' )));
		
		// Delete image
		 if (file_exists(WWW_ROOT . VIRPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . VIRPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file']);
		}
		if (file_exists(WWW_ROOT . VIRPRODUCT_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . VIRPRODUCT_FILE_PATH . DS . $products['Product']['image_file']);
		}
		
		if ($this->Product->delete($id)) {
			
			$this->Session->setFlash('The Product has been deleted.','success');
			$this->redirect(array('action' => 'index#virtual'));
		}
	}
	
	/***************** Melody Section *****************/
	public function admin_add_melody(){
		 if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Melody has been saved.'), 'success');
                $this->redirect(array('action' => 'index#love'));
            } else {
                $this->Session->setFlash(__('Melody could not be saved. Please, try again.'), 'error');
            }
        }
	}
	
	public function admin_edit_melody($id = ''){
		 if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Melody has been saved.'), 'success');
                $this->redirect(array('action' => 'index#love'));
            } else {
                $this->Session->setFlash(__('Melody could not be saved. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->Product->read(null, $id);
		}
		$errors = $this->Product->validationErrors;
		$this->set('errors',$errors);
	}
	
	public function admin_view_melody($id = ''){
		 $this->request->data = $this->Product->read(null, $id);
	}
	
	public function admin_delete_melody($id = ''){
		$this->loadModel('Product');
		$this->Product->id = $id;
		if(!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid Product.'));
		}
		$products = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'fields' => array('Product.image_file' )));
		
		// Delete image
		 if (file_exists(WWW_ROOT . LOVEPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . LOVEPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file']);
		}
		if (file_exists(WWW_ROOT . LOVEPRODUCT_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . LOVEPRODUCT_FILE_PATH . DS . $products['Product']['image_file']);
		}
		
		if ($this->Product->delete($id)) {
			
			$this->Session->setFlash('The Product has been deleted.','success');
			$this->redirect(array('action' => 'index#love'));
		}
	}

	/***************** Romance Card Section *****************/
	
	public function admin_add_romance(){
		 if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Romance card has been saved.'), 'success');
                $this->redirect(array('action' => 'index#romance'));
            } else {
                $this->Session->setFlash(__('Romance card could not be saved. Please, try again.'), 'error');
            }
        }
	}
	
	public function admin_edit_romance($id = ''){
		 if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Romance card has been saved.'), 'success');
                $this->redirect(array('action' => 'index#romance'));
            } else {
                $this->Session->setFlash(__('Romance card could not be saved. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->Product->read(null, $id);
		}
		$errors = $this->Product->validationErrors;
		$this->set('errors',$errors);
	}
	
	public function admin_delete_romance($id = ''){
		$this->loadModel('Product');
		$this->Product->id = $id;
		if(!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid Product.'));
		}
		$products = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'fields' => array('Product.image_file' )));
		
		// Delete image
		 if (file_exists(WWW_ROOT . ROMANCEPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . ROMANCEPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file']);
		}
		if (file_exists(WWW_ROOT . ROMANCEPRODUCT_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . ROMANCEPRODUCT_FILE_PATH . DS . $products['Product']['image_file']);
		}
		
		if ($this->Product->delete($id)) {
			
			$this->Session->setFlash('The Product has been deleted.','success');
			$this->redirect(array('action' => 'index#romance'));
		}
	}
	
	/***************** Real Gifts Section *****************/
	
	
	public function admin_add_realgifts(){
		 if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Real gift has been saved.'), 'success');
                $this->redirect(array('action' => 'index#real'));
            } else {
                $this->Session->setFlash(__('Real gift could not be saved. Please, try again.'), 'error');
            }
        }
		$this->loadModel('Category');
		$categories =  $this->Category->find('list',array('conditions'=>array('Category.status' => 1), 'fields'=>array('Category.id', 'Category.category')));
		$this->set('categories', $categories);
	}
	
	public function admin_edit_realgifts($id = ''){
		 if ($this->request->is('post') || $this->request->is('put')) {
			//pr($this->request->data);die;
			if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Real gift has been saved.'), 'success');
                $this->redirect(array('action' => 'index#real'));
            } else {
                $this->Session->setFlash(__('Real gift could not be saved. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->Product->read(null, $id);
		}
		$errors = $this->Product->validationErrors;
		$this->set('errors',$errors);
		$this->loadModel('Category');
		$categories =  $this->Category->find('list',array('conditions'=>array('Category.status' => 1), 'fields'=>array('Category.id', 'Category.category')));
		$this->set('categories', $categories);
	}
	
	public function admin_delete_realgifts($id = ''){
		$this->loadModel('Product');
		$this->Product->id = $id;
		if(!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid Product.'));
		}
		$products = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'fields' => array('Product.image_file' )));
		
		// Delete image
		 if (file_exists(WWW_ROOT . REALPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . REALPRODUCT_THUMB_FILE_PATH . DS . $products['Product']['image_file']);
		}
		if (file_exists(WWW_ROOT . REALPRODUCT_FILE_PATH . DS . $products['Product']['image_file'])){
			@unlink(WWW_ROOT . REALPRODUCT_FILE_PATH . DS . $products['Product']['image_file']);
		}
		
		if ($this->Product->delete($id)) {
			
			$this->Session->setFlash('The Product has been deleted.','success');
			$this->redirect(array('action' => 'index#real'));
		}
	}
	
}
