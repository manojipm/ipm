<?php

App::uses('AppModel', 'Model');

/**
 * Company Model
 *
 */
class Company extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */    
       
    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Email is required'
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Valid email is required',
            ),
            'unique' => array(
                'rule' => array('isUnique', 'email'),
                'message' => 'This email has already been taken',
            //'on' => 'create'
            )
        ),
        'current_password' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'required' => false,
                'message' => 'Please enter current password',
            ),
            'password_exists' => array(
                'rule' => array('password_exists'),
                'message' => 'Invalid Current Password'
            )
        ),'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password is required',
                'on' => 'create'
            )
        ),
        'cpassword' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'required' => false,
                'message' => 'Please re enter password',
            ),
            'match_passwds' => array(
                'rule' => 'matchPasswds',
                'required' => false,
                'message' => 'Password and confirm password does not match',
            ),
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
