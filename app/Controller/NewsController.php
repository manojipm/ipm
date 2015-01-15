<?php

/**
 * News controller.
 *
 * This file will render views from views/News/
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
 * News Controller
 *
 * @property New $New
 * @property PaginatorComponent $Paginator
 */
class NewsController extends AppController {

    var $name = 'News';
    public $uses = array('News', 'Role');

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
        $this->Auth->allow('');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All news', true));
        $this->News->recursive = 0;
        $conditions = array();
        $this->paginate = array("conditions" => $conditions, "order" => "News.id DESC");
        $this->set('news', $this->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        $this->set('title_for_layout', __('Add new news',true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!isset($this->request->data['News']['published'])) {
                $this->request->data['News']['published'] = $this->request->data['News']['cretaed'];
            }else{
				$this->request->data['News']['published'] = strtotime($this->request->data['News']['published']);
			}
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__('News has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('News could not be saved. Please, try again.'), 'error');
            }
        }
        $roles = $this->Role->find('list', array('conditions' => array('NOT' => array('id' => array(1, 2))), 'fields' => array('id', 'role')));
        $this->set('roles', $roles);
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->set('title_for_layout', __('Edit news',true));
        $this->News->id = $id;
        //check category exist
        if (!$this->News->exists()) {
            $this->Session->setFlash(__('Invalid News.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!isset($this->request->data['News']['published'])) {
                $this->request->data['News']['published'] = $this->request->data['News']['cretaed'];
            }else{
				$this->request->data['News']['published'] = strtotime($this->request->data['News']['published']);
			}
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__('News has been updated'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $errors = $this->News->validationErrors;
                $this->Session->setFlash(__('News could not be updated. Please, try again.'), 'error');
            }
        }
        $roles = $this->Role->find('list', array('conditions' => array('NOT' => array('id' => array(1, 2))), 'fields' => array('id', 'role')));
        $this->set('roles', $roles);
        $this->request->data = $this->News->read(null, $id);
		if(isset($this->request->data['News']['published']) && !empty($this->request->data['News']['published'])){
			$this->request->data['News']['published'] = date('m/d/Y');
		}
    }

    public function admin_update_status() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->request->data['News']['id'] = $this->params['data']['id'];
            $this->request->data['News']['status'] = $this->params['data']['status'];
            if ($this->News->save($this->request->data)) {
                return true;
            } else {
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
        $this->set('title_for_layout', __('View news',true));
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Invalid new'));
        }

        $this->set('news', $this->News->read(null, $id));
        $this->set('title_for_layout', 'View New - Roca');
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
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Invalid news'), 'error');
        }
        if ($this->News->delete()) {
            $this->Session->setFlash(__('News deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('News was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }

}
