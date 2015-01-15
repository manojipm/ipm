<?php

/**
 * Men controller.
 *
 * This file will render views from views/Men/
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
 * Men Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class MenController extends AppController {

    var $name = 'Men';
    public $uses = array(
                        'Payment','User', 
                        'Language', 
                        'Country', 
                        'State', 
                        'City',
                        "Plan",
                        'PlansActivity',
                        'UserPlan',
                        'UserPlanActivity',
                        'UserPlanTransaction',
                        'State',
                    );

    /**
     * check login for admin and frontend user
     * allow and deny user
     */
    public $components = array('Email','Session', 'Acl','PaypalWPP.PaypalWPP','Common');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text','Common');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('admin_login','admin_forgotpassword', 'admin_logout', 'admin_forgot_password', 'admin_check_old_password',  'admin_get_state_city','registration');
        
    }


/*********************** Front End Panel Man Functions Start **************************/

/**
 *  Man Dashboard
*/
	public function man_index() {
		// Pages
		$this->loadModel('Page');
		$pages = $this->Page->find('all',array('conditions' => array("Page.slug" =>array('real-gifts-and-delivery', 'love-melody', 'romantic-cards-&-virtual-gifts', 'order-date'))));
		$sliders = $this->Common->getSlider(MAN_ID);
		
		// News
		$this->loadModel('Page');
		$news = $this->Common->getNews(MAN_ID, 1);
		//pr($news);
		$this->set('sliders', $sliders);
		$this->set('pages', $pages);
		$this->set('news', $news);
	}
        
        public function man_buy_credit() {
		$this->loadModel('Activity');
                $this->loadModel('Plan');
                $this->loadModel('PlansActivity');
		$this->Plan->recursive = 3;
		$this->Plan->bindModel(array('hasMany'=>array('PlansActivity'=>array(
			'className'=>'PlansActivity',
			)
		)));
		$plans = $this->Plan->find('all',array('order'=>'Plan.order'));
                $plansArr = array();
                $plansActivityArr = array();
                 if(isset($plans) && !empty($plans)){
                     foreach($plans as $plan){
                         if($plan['Plan']['title'] != 'Free Membership')
                             $plansArr[] = $plan['Plan']['title'];
                         foreach($plan['PlansActivity'] as $key => $dtl){
                             if($plan['Plan']['title'] != 'Free Membership')
                                 $plansActivityArr[$dtl['Activity']['title']][] =  $dtl['credit_fee'];
                         }
                     }
                 }
                
                $this->set(compact('plans','plansArr','plansActivityArr'));

	}
        public function man_payment() {
            $plan_id = '';
            if(isset($this->request->data['Plan']['id'])){
                $plan_id  = $this->request->data['Plan']['id'];
                unset($this->request->data);
            }
            if(isset($this->request->data['Payment']['plan_id'])){
                $plan_id  = $this->request->data['Payment']['plan_id'];
            }
            
            
            if (isset($plan_id) && empty($plan_id)) {
                    $this->Session->setFlash(__('Invalid Plan\'s id,Please select paid plan.'),'error');
                    $this->redirect(array('action' => 'buy_credit'));
            }
            $plan_amount = $this->Plan->findById($plan_id);
            $plan_activities = $this->PlansActivity->find('all',array('conditions'=>array('PlansActivity.plan_id'=>$plan_id),'recursive' => -1,));
            $old_plan_details = $this->UserPlan->find('first', array('conditions' => array('UserPlan.user_id' => $this->Auth->User('id'),'UserPlan.status' => ACTIVE)));
            $old_plan_credits = empty($old_plan_details) ? $plan_amount['Plan']['credits'] : $plan_amount['Plan']['credits']+$old_plan_details['UserPlan']['total_credits'];
            
            $user_plan = array();
            
            $user_plan['UserPlan'] =   array(
                                            'user_id'=> $this->Auth->User('id'),
                                            'title' => $plan_amount['Plan']['title'],
                                            'amount' => $plan_amount['Plan']['amount'],
                                            'credits' => $plan_amount['Plan']['credits'],
                                            'total_credits' => $old_plan_credits ,
                                            'status' => ACTIVE ,
                
                                        );
            
            if(isset($plan_activities)){
                foreach($plan_activities as $plan_activity_value){
                    $user_plan['UserPlanActivity'][] =  array(
                                                            'plan_id'=> $plan_amount['Plan']['id'],
                                                            'activity_id' => $plan_activity_value['PlansActivity']['activity_id'],
                                                            'credit_fee' => $plan_activity_value['PlansActivity']['credit_fee'],
                                                        );
                }
            }
            $user_plan['UserPlanTransaction'] = array(
                                                    'user_id'=> $this->Auth->User('id'),
                                                    'woman_id' => 0,
                                                    'plan_id'=> $plan_amount['Plan']['id'],
                                                    'activity_id' => 0,
                                                    'amount_credit' => $plan_amount['Plan']['amount'],
                                                    'plan_name' => $plan_amount['Plan']['title'],
                                                    'quantity'=> $this->Auth->User('id'),
                                                    'duration' => $plan_amount['Plan']['title'],
                                                    'status' => 'c',
                                                );
            
            $this->UserPlan->bindModel(array('hasMany' => array('UserPlanActivity'),'hasOne' =>  array('UserPlanTransaction')) );
            
            $model = ClassRegistry::init('Payment');
            
            
            if($this->request->is('post') && !empty($this->request->data['Payment'])) {
                $model->set($this->request->data);
                if($model->validates()) {
                    CakeLog::write('paypal', 'Payment history log : ');
                    $this->log($this->request->data, 'paypal');
                    $response = $this->paypal($this->request->data,$plan_amount['Plan']['amount']);
                    //pr($response);
                    if ($response['ACK'] == 'Success') {
                            $user_plan['UserPlan']['transaction_id'] = $response['TRANSACTIONID'];
                            $this->UserPlan->saveAssociated($user_plan);
                            $this->Session->setFlash('Payment successful paid for '.$plan_amount['Plan']['title'],'success');
                            $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash('Payment failed for '.$plan_amount['Plan']['title'],'error');
                    }
                } else {
                    $this->Session->setFlash('Errors occurred.','error');
                }
            }
            
            
            $this->set('plan_id',$plan_id);
            

	}
        public function paypal($array = null,$amount = null){
                $plan_amount = $this->Plan->findById($array['Payment']['plan_id']);
                $state = $this->Common->getState($array['Payment']['state']);
                $expDateYear = $array['Payment']['exp_date']['month'].$array['Payment']['exp_date']['year'];
                $description = isset($array['Payment']['description']) ? $array['Payment']['description'] : '';
                $request_params = array(
                                'PAYMENTACTION' => 'Sale', 					
                                'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                                'CREDITCARDTYPE' => $array['Payment']['card_type'], 
                                'ACCT' => $array['Payment']['card_number'], 						
                                'EXPDATE' => $expDateYear, 			
                                'CVV2' => $array['Payment']['CVV2'], 
                                'FIRSTNAME' => $array['Payment']['first_name'], 
                                'LASTNAME' => $array['Payment']['last_name'], 
                                'STREET' => $array['Payment']['street'], 
                                'CITY' => $array['Payment']['city'], 
                                'STATE' => $state, 					
                                'COUNTRYCODE' => $array['Payment']['country'], 
                                'ZIP' => $array['Payment']['zip'], 
                                'AMT' => $amount,
                                'CUSTOM' => 0,
                                'CURRENCYCODE' => 'USD', 
                                'DESC' => $description 
                    );
//                    $request_params = array
//                                (
//                                    'PAYMENTACTION' => 'Sale', 					
//                                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
//                                    'CREDITCARDTYPE' => 'MasterCard', 
//                                    'ACCT' => '4003667880289173', 						
//                                    'EXPDATE' => '062017', 			
//                                    'CVV2' => '962', 
//                                    'FIRSTNAME' => 'Tester', 
//                                    'LASTNAME' => 'Testerson', 
//                                    'STREET' => '707 W. Bay Drive', 
//                                    'CITY' => 'Largo', 
//                                    'STATE' => 'FL', 					
//                                    'COUNTRYCODE' => 'US', 
//                                    'ZIP' => '33770', 
//                                    'AMT' => $amount,
//                                    'CUSTOM' => 0,
//                                    'CURRENCYCODE' => 'USD', 
//                                    'DESC' => 'Testing Payments Pro' 
//                                );
                    $nvp_string = '';
                    if(isset($request_params)){
                        foreach($request_params as $var=>$val)
                        {
                                $nvp_string .= '&'.$var.'='.urlencode($val);	
                        }
                    }
                    $response = $this->PaypalWPP->wpp_hash('DoDirectPayment', $nvp_string);
                    return $response;

                    
        }
        
        public function man_get_state_city() {
        $this->autoRender = false;
        $loadType = $_POST['loadType'];
        $loadId = $_POST['loadId'];
        if ($loadType == "state") {
            $sql = $this->State->find('all', array('conditions' => array('country_iso_code' => $loadId), 'fields' => array('country_iso_code', 'name'), 'order' => 'name ASC'));
            if (count($sql) > 0) {
                $HTML = "";
                foreach ($sql as $key => $val) {
                    $HTML.="<option value='" . $val['State']['country_iso_code'] . "'>" . $val['State']['name'] . "</option>";
                }
                return $HTML;
            }
        } else {
            $sql = $this->City->find('all', array('conditions' => array('state_code' => $loadId), 'fields' => array('state_code', 'name'), 'order' => 'name ASC'));
            if (count($sql) > 0) {
                $HTML = "";
                foreach ($sql as $key => $val) {
                    $HTML.="<option value='" . $val['City']['state_code'] . "'>" . $val['City']['name'] . "</option>";
                }
                return $HTML;
            }
        }
    }

	 /**
     * Download files method in man panel
     *
     * @return void
     */
    public function man_downloadfile($name = null, $folder = null) {
        $this->response->file(APP . 'webroot' . DS . 'uploads' . DS . $folder . DS . $name, array('download' => true, 'name' => $name));
        return $this->response;
    }
		
/**
 *  Agency Profile 
 */		
	public function man_myprofile(){
		$agency_id = $this->Auth->User('id');
		$this->request->data = $this->User->read(null, $agency_id);
	}

	
/**
 *  man Profile Edit
 */	
	public function man_profileedit($id = '') {
		$user_id = $this->Auth->User('id');// Login man id
		$this->User->id = $user_id;
		
		if (!$this->User->exists()) {
            $this->Session->setFlash(__('Invalid User.'), 'error');
            $this->redirect(array('action' => 'index'));
        }
		if (isset($this->data) && !empty($this->data)) {
            // Calculate Height in inches
            if (isset($this->data['UserProfile']['height_feet']) && !empty($this->data['UserProfile']['height_feet'])) {
                $height_feet = $this->data['UserProfile']['height_feet'];
                if (isset($this->data['UserProfile']['height_inches']) && !empty($this->data['UserProfile']['height_inches'])) {
                    $height_inches = $this->data['UserProfile']['height_inches'];
                }
                $height = $this->Common->calculateHeight($height_inches, $height_feet);
                $this->request->data['UserProfile']['height'] = $height;
            }
			
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('Profile has been updated successfully.'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Profile could not be updated. Please, try again.'), 'error');
            }
        }else{
			$this->request->data = $this->User->read(null, $id);
				if (isset($this->request->data['UserProfile']['height']) && !empty($this->request->data['UserProfile']['height'])) {
				$height = $this->request->data['UserProfile']['height'];
				$height_inches = ($height % 12);
				$height_feet = (int) ($height / 12);
				$this->request->data['UserProfile']['height_feet'] = $height_feet;
				$this->request->data['UserProfile']['height_inches'] = $height_inches;
			}
		}
	}

	
	/*********************** Front End Panel Man Functions End **************************/

	
}
