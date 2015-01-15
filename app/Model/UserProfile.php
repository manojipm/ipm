<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class UserProfile extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $belongsTo = array(
            'User'=>array(
                'className'     => 'User',  
                'dependent'=> true 
            )
    );
    public $primaryKey = 'user_id';
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
        'nickname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nick name is required'
            )
        ),
        'marital_status' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Marital status is required'
            )
        ),
        'contact_person' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Contact person is required',
            )
        ),
        'phone' => array(
            
            'validatePhone' => array(
                'rule' => array('validatePhone'),
                'message' => 'phone number is required'
            ),
//            'numeric' => array(
//                'rule' => array('numeric'),
//                'message' => 'Valid phone number is required',
//            )
        ),
        'passport_number' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Passport no is required'
            ),
            'unique' => array(
                'rule' => 'checkUnique',
                'message' => 'This passport no has already been taken',
                'on' => 'create'
            )
        ),
        'address' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Address is required',
            )
        ),
        'country_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Counrty is required',
            )
        ),
        'state_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'State is required',
            )
        ),
        'city_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'City is required',
            )
        ),
        'agency_license' => array(
            'extension' => array(
                'rule' => array('extension', array('jpeg', 'jpg','png','gif')),
                'required' => false,
                'allowEmpty' => true,
                'message' => 'jpg, jpeg , png, gif   files',
               
            ),
            'uploadAgencyLicense' => array(
                'rule' => array('uploadAgencyLicense'),
                'required' => false,
                'allowEmpty' => true,
                'message' => 'Error uploading file'
            )
        ),
        'passport_scan_copy' => array(
            'extension' => array(
                'rule' => array('extension', array('jpeg', 'jpg','png','gif')),
                //'required' => true,
                'allowEmpty' => false,
                'on'=>'create',
                'message' => 'jpg, jpeg , png, gif   files',
            ),
            'uploadPassportScanCopy' => array(
                'rule' => array('uploadPassportScanCopy'),
                //'required' => true,
                'allowEmpty' => false,
                'on'=>'create',
                'message' => 'Error uploading file'
            )
        ),
    );
    public function validatePhone() {
        $type = $this->data[$this->alias]["role_id"];
        if (isset($type) && $type = WOMAN_ID) {
          //  if($this->data[$this->alias]["phone"] == '')
                return true;
        }
        else if(isset($type) && $type = MAN_ID){
                return true;
        }
        else if(isset($type) && $type = AGENCY_ID){
            if($this->data[$this->alias]["phone"] != '')
                return true;
        }
        
    }
    
    public function checkUnique() {
        $condition = array("$this->alias.passport_number" => $this->data[$this->alias]["passport_number"], );
        if (isset($this->data[$this->alias]["id"])) {
            $condition["$this->alias.id <>"] = $this->data[$this->alias]["id"];
        }
        $result = $this->find("count", array("conditions" => $condition));
        return ($result == 0);
    }
    
    function beforeValidate($options = array()) {
        
        if (isset($this->data[$this->alias]["passport_scan_copy"]["name"]) && $this->data[$this->alias]["passport_scan_copy"]["name"] == '') {
            unset($this->data[$this->alias]["passport_scan_copy"]);
            return true;
        }
        if (isset($this->data[$this->alias]["height_feet"]) && $this->data[$this->alias]["height_feet"] != '') {
            $feet = $this->data[$this->alias]["height_feet"];
            $inche = 0;
            if (isset($this->data[$this->alias]["height_inches"]) && $this->data[$this->alias]["height_inches"] != '') {
                $inche = $this->data[$this->alias]["height_inches"];
            }
            $this->data[$this->alias]["height"] = ($feet * 12) + $inche;
            return true;
        }
        if (isset($this->data[$this->alias]["agency_license"]["name"]) && $this->data[$this->alias]["agency_license"]["name"] == '') {
            unset($this->data[$this->alias]["agency_license"]);
            return true;
        }
        
        //pr($this->data);die;
    }
    public function afterFind($results, $primary = false) {
        
        return $results;
    }

    
    
}
