<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class MessageAttachment extends AppModel {

    var $belongsTo = array (
        'Message' => array (
            'className'     =>  'Message',
            'foreignKey' => 'message_id'
        ),
    );
  
   

}
