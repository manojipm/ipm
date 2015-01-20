<?php

App::uses('AppModel', 'Model');

/**
 * Company Model
 *
 */
class LocationDivision extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */    
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'dependent' => true
        ),
        'State' => array(
            'className' => 'State',
            'dependent' => true
        ),
        'Country' => array(
            'className' => 'Country',
            'dependent' => true
        ),
        'LocationsByDivision' => array(
            'className' => 'LocationsByDivision',
            'dependent' => true
        ),
        'Company' => array(
            'className' => 'Company',
            'dependent' => true
        )
    );
        
    public $validate = array(
        'company_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'division' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'location' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'street' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'country_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'state_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'city_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'zip' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'division_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        )
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
