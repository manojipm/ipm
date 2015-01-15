<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Testimonial extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Title is required'
            ),
            'unique' => array(
                'rule' => array('isUnique', 'email'),
                'message' => 'This title has already been taken',
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Description is required'
            ),
        ),
       
        
    );
	 public $belongsTo = array(
                    
			'User'=>array(
				'className'     => 'User'  
			),
);
 
    function beforeValidate($options = array()) {
        if (!isset($this->data[$this->alias]["status"])) {
            $this->data[$this->alias]["status"] = 0;
        }
        return true; //this is required, otherwise validation will always fail
    }
    public function afterFind($results, $primary = false) {
        App::uses('CakeTime', 'Utility');
        foreach ($results as $key => $val) {
            if (isset($val[$this->alias]['created'])) {
                $results[$key][$this->alias]['created'] = CakeTime::format(ADMIN_DATE_FORMAT,$val[$this->alias]['created'],null,TIME_ZONE);
            }
        }
        return $results;
    }
}
