<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller/Component','Auth','Session', 'RequestHandler');
App::uses('CakeEmail', 'Network/Email');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
 
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Call all components
 *
 * @var array
 */
	public $components = array('Common','Image');
	/**
	* Helpers
	*
	* @var array
	*/
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');		
/**
* check login for admin and frontend user
* allow and deny user
*/
	public function beforeFilter() {
		parent::beforeFilter();
                $this->set('controller', 'pagess');
                $this->set('model', 'Page');
		$this->Auth->allow('display', 'careers','search','autocomplete_format','getTripidea','deletePageType');
	}	

	public function display() {
		
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
	
		if (!empty($path[0])) {
			$page = $path[0];
		}
		
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		
		$page_slug=implode('/', $path);
		$page_name = '';
		$this->loadModel('Page');
		$this->loadModel('Banner');

		$pages=$this->Page->find('first',array('conditions'=>array('Page.slug'=>$page_slug)));
		if(!empty($pages)){
			$this->set('title_for_layout',$pages['Page']['meta_title']);
			$this->set('description_for_layout',$pages['Page']['meta_keywords']);
			$this->set('keywords_for_layout',$pages['Page']['meta_description']); 
		}
		
		if($page_slug=='home'){
			$this->loadModel('Page');
			//$this->layout='home';
			$page_name = 'home';
			$role_id = $this->Auth->user('role_id');
			if(empty($role_id) || $role_id == AGENCY_ID){
				$role_id = OTHER_ID;
			}
			// Testimonials
			$testimonials = $this->Common->getTestimonials($role_id); 
			//pr($testimonials);die;
			// Slider
			$sliders = $this->Common->getSlider($role_id); 
			
			// Page Content
			$pages = $this->Page->find('all',array('conditions' => array("Page.slug" =>array('real-gifts-and-delivery', 'love-melody', 'romantic-cards-&-virtual-gifts', 'order-date'))));
			
			// News
			$news = $this->Common->getNews($role_id, 2);
			
			$this->set(compact('pages','news','page_name','sliders','testimonials'));
			$this->render($page_slug);
		} else if($page_slug=='contact-us'){
			$this->layout='page';
			$pages=$this->Page->find('first',array('conditions'=>array('Page.slug'=>$page_slug)));
			$page_name = 'Contact Us';
			$this->set(compact('slidesrs','citises','page_name','pages'));
			$this->render('contact');
	 	} else if($page_slug=='videos'){
			$this->layout='page';
			$pages=$this->Page->find('first',array('conditions'=>array('Page.slug'=>$page_slug)));
			$page_name = 'Videos';
			$this->set(compact('slidesrs','cities','page_name','pages'));
			$this->render('pages');
		}else{
			$this->loadModel('Page');
			$pages=$this->Page->find('first',array('conditions'=>array('Page.slug'=>$page_slug)));
			if(!empty($pages)){
				$this->set('page_name',$pages['Page']['name']);				
				$this->set(compact('cities','sliders','pages'));
			}else{
				$this->Session->setFlash(__('Page content is not available.'),'error');
				$this->redirect($this->referer());
			}
			$this->render('pages');
		}
	}
	
	public function admin_index() {
                $this->set('title_for_layout', __('All pages', true));
                $this->set('title_for_layout', __('All pages', true));
                $this->paginate = array("limit" => 15, "order" => "Page.id DESC");
                $this->set('pages', $this->paginate());
		
	}
	

	public function admin_add() {
            $this->set('title_for_layout', __('Add new page', true));
		if ($this->request->is('post') || $this->request->is('put')) {
			//pr($this->data);die;
			$this->request->data['Page']['slug']=str_replace(' ','-',strtolower($this->request->data['Page']['name']));
			
			$this->Page->set( $this->data['Page']);
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
					
					$this->Session->setFlash(__('Page content has been saved'),'success');
				
					$this->redirect(array('action' => 'index'));
					
			}else{
			
			$this->Session->setFlash(__('Page content could not be saved. Please, try again.'),'error');
			
			}
		
		}
		
		
	}	
	

	public function admin_edit($id = null) {
                $this->set('title_for_layout', __('Edit Page', true));
		$this->layout = 'admin';
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//Set page as inactive if it is unchecked
			if(!array_key_exists('is_active',$this->request->data['Page'])){
				$this->request->data['Page']['is_active']=1;
			}
			$this->request->data['Page']['slug']=str_replace(' ','-',strtolower($this->request->data['Page']['name']));	
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('Page content has been saved'),'success');
				$this->redirect(array('action' => 'index'));
			}else{ pr($this->Page->validationErrors);
				$this->Session->setFlash(__('Page content could not be saved. Please, try again.'),'error');
			}
		}
		$this->request->data = $this->Page->read(null, $id);
	}
	

	public function admin_view($id = null) {
                $this->set('title_for_layout', __('View page', true));
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}	
	

	public function admin_update_status() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->request->data['Page']['id'] = $this->params['data']['id'];
			$this->request->data['Page']['is_active'] = $this->params['data']['status'];
			if($this->Page->save($this->request->data)){
				return true;					
			}else{
				return false;
			}
		}
	}
	
}
