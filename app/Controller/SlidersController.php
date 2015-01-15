<?php

/**
 * Sliders controller.
 *
 * This file will render views from views/Sliders/
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
 * Sliders Controller
 *
 * @property Slider $Slider
 * @property PaginatorComponent $Paginator
 */
class SlidersController extends AppController {

    var $name = 'Sliders';
    public $uses = array('Slider', 'Role');

    /**
     * check login for admin and frontend new
     * allow and deny new
     */
    public $components = array( 'Image',);

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('controller', 'sliders');
        $this->set('model', 'Slider');
        $this->Auth->allow('');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function admin_index() {
        $this->set('title_for_layout', __('All Sliders', true));
        $this->Slider->recursive = 0;
        $conditions = array();
        $this->paginate = array("conditions" => $conditions, "order" => "Slider.id DESC");
        $this->set('sliders', $this->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Slider->save($this->request->data)) {
                $this->Session->setFlash(__('Sliders has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Sliders could not be saved. Please, try again.'), 'error');
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
        $this->Slider->id = $id;
        //check category exist
        if (!$this->Slider->exists()) {
            $this->Session->setFlash(__('Invalid Sliders.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Slider->save($this->request->data)) {
                $this->Session->setFlash(__('Sliders has been updated'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                //pr($this->Slider->validationErrors);
                $this->Session->setFlash(__('Sliders could not be updated. Please, try again.'), 'error');
            }
        }
        $this->request->data = $this->Slider->read(null, $id);
        $roles = $this->Role->find('list', array('conditions' => array('NOT' => array('id' => array(1, 2))), 'fields' => array('id', 'role')));
        $this->set('roles', $roles);
    }

    public function admin_update_status() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->request->data['Slider']['id'] = $this->params['data']['id'];
            $this->request->data['Slider']['status'] = $this->params['data']['status'];
            if ($this->Slider->save($this->request->data)) {
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
        $this->Slider->id = $id;
        if (!$this->Slider->exists()) {
            throw new NotFoundException(__('Invalid Silder'));
        }

        $this->set('slider', $this->Slider->read(null, $id));
        $this->set('title_for_layout', 'View Slider');
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
        $this->Slider->id = $id;
        if (!$this->Slider->exists()) {
            throw new NotFoundException(__('Invalid sliders'), 'error');
        }
        $sliders = $this->Slider->find('first', array('conditions' => array('Slider.id' => $id), 'fields' => array('Slider.slider_image' )));
        if (!empty($id)) {
            if (file_exists(WWW_ROOT . SLIDER_FILE_PATH . DS . $sliders['Slider']['slider_image'])){
                @unlink(WWW_ROOT . SLIDER_FILE_PATH . DS . $sliders['Slider']['slider_image']);
            }
        }
        
        
        
        
        if ($this->Slider->delete()) {
            $this->Session->setFlash(__('Sliders deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Sliders was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }

}
