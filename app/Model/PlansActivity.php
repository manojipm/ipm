<?php

App::uses('AppModel', 'Model');

/**
 * PlansActivity Model
 *
 */
class PlansActivity extends AppModel {
    public $actsAs = array('Containable');
    var $belongsTo = array (
        'Activity' => array (
            'foreignKey' => 'activity_id',
            'fields'=>array('id','title','status'),
            'conditions'=>array('status'=> ACTIVE ),
        ),
         
    );

}
