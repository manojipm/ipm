<?php

App::uses('AppModel', 'Model');

/**
 * Company Model
 *
 */
class Company extends AppModel {
    
    
   /* public $belongsTo = array(
        'User' => array(
         'className' => 'User',
         'foreignKey' => 'user_id',
         'conditions' => '',
         'fields' => '',
         'order' => ''
        )
    );*/

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
        'CompanyStructure' => array(
            'className' => 'CompanyStructure',
            'dependent' => true
        ),
        'IndustryClassification' => array(
            'className' => 'IndustryClassification',
            'dependent' => true
        )
    );
        
        
    public $validate = array(
        'company_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
<<<<<<< HEAD
                'message' => 'Company name is required'
            )
        ),
        'sic_code' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'required' => false,
                'message' => 'SIC code is required',
            ),
            'unique' => array(
                'rule' => array('isUnique', 'sic_code'),
                'message' => 'This sic code has already exist',
            //'on' => 'create'
            )
        ),
        'org_chart' => array(
=======
                'message' => 'This field is required'
            )
        ),
        'sic_code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            ),
            'unique' => array(
                'rule' => array('isUnique', 'sic_code'),
                'message' => 'This email has already been taken',
            //'on' => 'create'
            )
        ),
        'org_chart' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'street' => array(
>>>>>>> manoj
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
<<<<<<< HEAD
        'street' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
=======
>>>>>>> manoj
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
<<<<<<< HEAD
        'ownership' => array(
=======
        'phone' => array(
>>>>>>> manoj
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'structure_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
        'industry_classification_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field is required'
            )
        ),
    );

	
	
	function password_exists(){
		if(isset($this->data[$this->alias]['current_password']) && !empty($this->data[$this->alias]['current_password'])){
			$user_id = CakeSession::read("Auth.User.id");
			if($this->find('count',array('conditions'=>array('User.password'=>AuthComponent::password($this->data[$this->alias]['current_password']),'User.id'=>$user_id)))){
				return true;
			}
			return false;
		}
	}
    function beforeValidate($options = array()) {
        
    }

    function checkEmailInForgotPasswordValidate() {
        $validate1 = array(
            'email_for_forget_password' => array(
                'email' => array(
                    'rule' => array('email'),
                    'message' => 'Please enter valid email address',
                ),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function beforeSave($options = array()) {
        
        
        if (isset($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['password'])) {
			
			$this->data[$this->alias]['showpassword'] = $this->data[$this->alias]['password'];
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            //return true;
        } else {
            unset($this->data[$this->alias]['password']);
        }

        if (!isset($this->data[$this->alias]['id']) &&!isset($this->data[$this->alias]["status"])) {
            $this->data[$this->alias]["status"] = 0;
        }

        foreach (array_keys($this->hasAndBelongsToMany) as $model) {
            if (isset($this->data[$this->name][$model])) {
                $this->data[$model][$model] = $this->data[$this->name][$model];
                unset($this->data[$this->name][$model]);
            }
        }
        return true;
    }

    function matchPasswds() {
        $data = $this->data;
        return $data[$this->alias]['password'] == $data[$this->alias]['cpassword'];
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
