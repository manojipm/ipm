<?php
App::uses('AppModel', 'Model');
/**
 * Country Model
 *
 */
class City extends AppModel {
    
    public $validate = array(
        'city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'City is required'
            ),
        ),
    );	

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