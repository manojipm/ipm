<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class UsersDetail extends AppModel {

    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Name is required'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Last name is required'
            )
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
