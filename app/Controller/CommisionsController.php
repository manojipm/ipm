<?php

/**
 * Commisions controller.
 *
 * This file will render views from views/Commisions/
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
 * Commisions Controller
 *
 * @property Commision $Commision
 * @property PaginatorComponent $Paginator
 */
class CommisionsController extends AppController {

    var $name = 'Commisions';
    public $uses = array('Commision', 'Role');

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
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit() {
        if ($this->request->is('post') || $this->request->is('put')) {
			if(isset($this->request->data['Commision']) && !empty($this->request->data['Commision'])){
				foreach($this->request->data['Commision'] as $activity_id  => $commisionDetails){
					$AgenciesCommision['Commision']['id'] = $commisionDetails['commision_id'];
					$AgenciesCommision['Commision']['activity_id'] = $activity_id;
					$AgenciesCommision['Commision']['commision'] = $commisionDetails['commision'];
					$this->Commision->save($AgenciesCommision);
				}
				$this->Session->setFlash(__('Commisions has been updated'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash(__('Commisions could not be updated. Please, try again.'), 'error');
            }
        }
		$this->loadModel('Activity');
		$this->Activity->recursive = 2;
		$this->Activity->bindModel(array('hasOne'=>array('Commision'=>array(
			'className'=>'Commision'
			)
		)));
		$activities = $this->Activity->find('all', array('conditions' => array('Activity.status' => 1), 'fields' => array('id', 'title'), 'order'=>'Activity.sortOrder ASC'));
		
		$this->set('activities', $activities);
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
     public function admin_index() {
      	$this->loadModel('Activity');
		$this->Activity->recursive = 2;
		$this->Activity->bindModel(array('hasOne'=>array('Commision'=>array(
			'className'=>'Commision'
			)
		)));
		$activities = $this->Activity->find('all', array('conditions' => array('Activity.status' => 1), 'fields' => array('id', 'title'), 'order'=>'Activity.sortOrder ASC'));		
		$this->set('activities', $activities);
    }

}
