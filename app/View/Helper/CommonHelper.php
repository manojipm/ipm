<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CommonHelper extends Helper {

    var $helpers = array('Html', 'Session', 'Thumbnail');

    public function getProfileImage($image = null) {

        echo $this->Thumbnail->show(
                array(
            'save_path' => ROOT . '/app/webroot/files/thumbs',
            'display_path' => Router::url('/', true) . 'files/thumbs', // or 'display_path' => 'http://images.domain.com',
            'error_image_path' => Router::url('/', true) . 'files/no_image.jpg',
            'src' => ROOT . '/app/webroot/files/profile_images/' . $image,
            'w' => 200,
            'h' => 150,
            'q' => 100,
            'zc' => 1
                ),
                // This is the tag options array for adding any other properties to the image tag
                array('style' => 'border: 5px solid #EEEEEE;')
        );
    }
    public function getCountry($id = null) {
         $country = ClassRegistry::init('Country')->find('first',array('conditions'=>array('iso_code'=>$id)) );
         return isset($country['Country']['name']) ? $country['Country']['name'] : '-';
    }
    public function getState($id = null) {
         $state = ClassRegistry::init('State')->find('first',array('conditions'=>array('id'=>$id)) );
         return isset($state['State']['name']) ? $state['State']['name'] : '-';
    }
    public function getCity($id = null) {
         $city = ClassRegistry::init('City')->find('first',array('conditions'=>array('id'=>$id)) );
         return isset($city['City']['name']) ? $city['City']['name'] : '-';
    }
    public function getRoles($id = null) {
         $roles = ClassRegistry::init('Role')->find('first',array('conditions'=>array('Role.id'=> $id)) );
         return isset($roles['Role']['role']) ? $roles['Role']['role'] : '-';
    }
    public function getRoleLists() {
         $roles = ClassRegistry::init('Role')->find('list',array('conditions'=>array('NOT'=> array('id'=>array(1))),'fields'=>array('id','role')) );
         return isset($roles) ? $roles : '-';
    }
    public function getUserList() {
         $users = ClassRegistry::init('User')->find('all',array('conditions'=>array('NOT'=>array('User.role_id'=>array(1)),'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name')) );
         $users = Hash::combine($users, '{n}.User.id', '{n}.UserProfile.first_name');
         return isset($users) ? $users : array();
         
    }
    public function getUserWomanMan() {
         $users = ClassRegistry::init('User')->find('all',array('conditions'=>array('NOT'=>array('User.role_id'=>array(1)),'User.role_id'=>array(WOMAN_ID,MAN_ID),'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name')) );
         $users = Hash::combine($users, '{n}.User.id', '{n}.UserProfile.first_name');
         return isset($users) ? $users : array();
         
    }
    public function getWomanList() {
         $users = ClassRegistry::init('User')->find('all',array('conditions'=>array('User.role_id'=>WOMAN_ID,'NOT'=>array('User.role_id'=>array(1)),'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name','UserProfile.nickname')) );
         $users = Hash::combine($users, '{n}.User.id', '{n}.UserProfile.nickname');
         return isset($users) ? $users : array();
         
    }
    public function getWomanUnderAgencyList($agency_id) {
         $users = ClassRegistry::init('User')->find('all',array('conditions'=>array('UserProfile.agency_id'=>$agency_id,'User.role_id'=>WOMAN_ID,'NOT'=>array('User.role_id'=>array(1)),'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name','UserProfile.nickname')) );
         $users = Hash::combine($users, '{n}.User.id', '{n}.UserProfile.nickname');
         return isset($users) ? $users : array();
         
    }
    public function getAgencyList() {
         $agency = ClassRegistry::init('User')->find('all',array('conditions'=>array('User.role_id'=>AGENCY_ID,'User.status'=>1),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name')) );
         $agency = Hash::combine($agency, '{n}.User.id', '{n}.UserProfile.first_name');
         return isset($agency) ? $agency : array();
         
    }
    public function getUserName($id = null){
        $users = ClassRegistry::init('User')->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name','UserProfile.nickname')) );
        return isset($users['UserProfile']) ? $users['UserProfile']["first_name"].' '.$users['UserProfile']["last_name"] : '-';
    }
    public function getGirlNickname($id = null){
        $users = ClassRegistry::init('User')->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.id','UserProfile.first_name','UserProfile.last_name','UserProfile.nickname')) );
        return isset($users['UserProfile']) ? $users['UserProfile']["nickname"] : '-';
    }
    
    
    public function getCountryList(){
        $countries = ClassRegistry::init('Country')->find('list', array('fields' => array('id', 'country')));
        return isset($countries) ? $countries : array();
    }
    
    public function getStateList(){
        $countries = ClassRegistry::init('State')->find('list', array('fields' => array('id', 'state')));
        return isset($countries) ? $countries : array();
    }
    
    public function getCityList(){
        $countries = ClassRegistry::init('City')->find('list', array('fields' => array('id', 'city')));
        return isset($countries) ? $countries : array();
    }
    
    public function getCompanyStructure(){
        $structures = ClassRegistry::init('CompanyStructure')->find('list', array('fields' => array('id', 'structure')));
        return isset($structures) ? $structures : array();
    }    
    
    public function getIndustryClassification(){
        $classifications = ClassRegistry::init('IndustryClassification')->find('list', array('fields' => array('id', 'classification')));
        return isset($classifications) ? $classifications : array();
    }
    
    public function getCompanyList(){
        $companies = ClassRegistry::init('Company')->find('list', array('fields' => array('id', 'company_name')));
        return isset($companies) ? $companies : array();
    }
    
    public function getLocationsByDivisionList(){
        $locationsbydivisions = ClassRegistry::init('LocationsByDivision')->find('list', array('fields' => array('id', 'division_type')));
        return isset($locationsbydivisions) ? $locationsbydivisions : array();
    }

    
    /*public function getCountryList(){
        $countries = ClassRegistry::init('Country')->find('list', array('fields' => array('iso_code', 'name')));
        return isset($countries) ? $countries : array();
    }
    
    
    public function getStateList($country_id = ''){
		if(empty($country_id)){ $country_id =  COUNTRY_CODE; }
		
        $ststes = ClassRegistry::init('State')->find('list',array('conditions'=>array('State.country_iso_code'=> $country_id), 'fields' => array('id', 'name'),'order'=>array('name ASC')) );
        return isset($ststes) ? $ststes : array();
    
    }
    public function getCityList(){
        $cities = ClassRegistry::init('City')->find('list',array('conditions'=>array('City.country_iso_code'=> COUNTRY_CODE), array('fields' => array('id', 'name'))) );
        return isset($cities) ? $cities : array();
    }*/
    
    public function getUnread($id){
        $count = ClassRegistry::init('MessageUser')->find('count',array('conditions'=>array('MessageUser.read_flag'=> UNREAD,'MessageUser.message_folder_id'=> INBOX,'MessageUser.receiver_id'=>$this->Session->read('Auth.Admin.id'))) );
        return isset($count) ? $count : '';
    }
	
}