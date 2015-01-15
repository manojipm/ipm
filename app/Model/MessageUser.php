<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class MessageUser extends AppModel {
    
    public $actsAs = array('Containable');
    var $belongsTo = array (
        'Message' => array (
            'className'     =>  'Message',
            'foreignKey' => 'message_id'
        ),
    );
    
    function beforeValidate($options = array()) {
        if (!isset($this->data[$this->alias]["status"])) {
            //$this->data[$this->alias]["status"] = 0;
        }
        return true; //this is required, otherwise validation will always fail
    }
}
