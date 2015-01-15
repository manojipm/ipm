<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Message extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $actsAs = array('Containable');
    public $hasMany = array (
        'MessageAttachment'   =>  array(
            'className'     =>  'MessageAttachment',
            'foreignKey' => 'message_id',
            //'dependent'=> true
        ), 
        'MessageUser'   =>  array(
            'className'     =>  'MessageUser',
            'foreignKey' => 'message_id',
            //'dependent'=> true
        ),
    );

    public $validate = array(
        'id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'To is required',
            )
        ),
    );
    public function checkto() {
       if($this->data[$this->alias]['sender_id'] == ''){
           return false;
       }else{
           return true;
       }
    }
    
    function beforeValidate($options = array()) {
        if (!isset($this->data[$this->alias]["status"])) {
            //$this->data[$this->alias]["status"] = 0;
        }
        return true; //this is required, otherwise validation will always fail
    }
    
    public function afterFind($results, $primary = false) {
        App::uses('CakeTime', 'Utility');
        foreach ($results as $key => $val) {
            if (isset($val[$this->alias]['created'])) {
                $results[$key][$this->alias]['created'] = CakeTime::format(ADMIN_DATE_FORMAT, $val[$this->alias]['created'], null, TIME_ZONE);
            }
        }
        return $results;
    }
    public function beforeSave($options = array()) {
        //pr($this->data);die;
        return true;
    }
}
