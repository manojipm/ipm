<?php

App::uses('AppModel', 'Model');

/**
 * PlanDetail Model
 *
 */
class PlanDetail extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    

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