<?php

App::uses('AppModel', 'Model');

/**
 * Activity Model
 *
 */
class Activity extends AppModel {

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
