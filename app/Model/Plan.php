<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Plan extends AppModel {
    public $actsAs = array('Containable');
    /**
     * Validation rules
     *
     * @var array
     */
    //public $useTable = '';
 
    
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
                $results[$key][$this->alias]['created'] = CakeTime::format(ADMIN_DATE_FORMAT, $val[$this->alias]['created'], null, TIME_ZONE);
            }
        }
        return $results;
    }

}
