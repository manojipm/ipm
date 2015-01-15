<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Payment extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    var $name = 'Payment';
    public $useTable = false; // This model does not use a database table
    
    public  $validate = array(
        'street' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Street is required'
            ),
        ),
        'country' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Country is required'
            ),
        ),
        'state' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'State is required'
            ),
        ),
        'city' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'City is required'
            ),
        ),
        'zip' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Zip is required'
            ),
            'zip' => array(
                'rule' => array('postal', null, 'us'),
                'message' => 'Your zip code is not in the corect format.'
            ),
            
        ),
        'card_type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Card type is required'
            ),
        ),
        'first_name' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'First name is required'
            ),
           
        ),
        'last_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Last name is required'
            ),
            
        ),
        'card_number' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Last name is required'
            ),
            'card_number' => array(
                'rule' => array('cc', 'all', false, null),
                'message' => 'Your credit card number is not in the correct format.'
            ),
           
        ),
        'CVV2' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Cvv numbers is required'
            ),
            'CVV2' => array(
                'rule' => 'numeric',
                'message' => 'Numbers only please.'
            ),
        ),
//        'exp_date' => array(
//            'required' => array(
//                'rule' => array('notEmpty'),
//                'message' => 'Expiration date is required'
//            ),
//            'exp_date' => array(
//                'rule' => array('date', 'my'),
//                'message' => 'The correct answer will be in the following format MM/YYYY'
//            ),
//            
//        ),
        'phone' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Phone code is required'
            ),
//            'phone' => array(
//                'rule' => array('phone', null, 'us'),
//                'message' => 'Your phone number is not in the corect format.'
//            ),
           
        ),
        'terms' =>  array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Terms and condition is required'
            ),
        ),
    );
    function beforeValidate($options = array()) {
        
    }

    
    public function beforeSave($options = array()) {
        
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

}
