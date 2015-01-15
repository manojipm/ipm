<?php

/**
 * Reviews controller.
 *
 * This file will render views from views/Reviews/
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
 * Reviews Controller
 *
 * @property Review $Review
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

    var $name = 'Reviews';
    public $uses = array('Review', 'Role');

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
        $this->set('controller', 'reviews');
        $this->set('model', 'Review');
        $this->Auth->allow('');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All Reviews', true));
        $this->Review->recursive = 0;
        $conditions = array();
        $this->paginate = array("conditions" => $conditions, "order" => "Review.id DESC");
        $this->set('sliders', $this->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Review']['user_id'] = 1;
            if ($this->Review->save($this->request->data)) {
                $this->Session->setFlash(__('Reviews has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Reviews could not be saved. Please, try again.'), 'error');
                //$errors = $this->Review->validationErrors;
                //pr($errors);
                //die;
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
        $this->Review->id = $id;
        //check category exist
        if (!$this->Review->exists()) {
            $this->Session->setFlash(__('Invalid Reviews.'), 'flash_custom_error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Review']['user_id'] = 1;
            if ($this->Review->save($this->request->data)) {
                $this->Session->setFlash(__('Reviews has been updated'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Reviews could not be updated. Please, try again.'), 'error');
            }
        }
        $this->request->data = $this->Review->read(null, $id);
        $roles = $this->Role->find('list', array('conditions' => array('NOT' => array('id' => array(1, 2))), 'fields' => array('id', 'role')));
        $this->set('roles', $roles);
    }

    public function admin_update_status() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
           echo  $this->request->data['Review']['id'] = $this->params['data']['id'];
           echo  $this->request->data['Review']['status'] = $this->params['data']['status'];
            if ($this->Review->save($this->request->data)) {
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
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid Silder'));
        }

        $this->set('slider', $this->Review->read(null, $id));
        $this->set('title_for_layout', 'View Review');
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
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid sliders'), 'flash_custom_error');
        }
        if ($this->Review->delete()) {
            $this->Session->setFlash(__('Reviews deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Reviews was not deleted'), 'flash_custom_error');
        $this->redirect(array('action' => 'index'));
    }

}
