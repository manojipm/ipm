<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Review extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        
//        'review_image' => array(
//            'extension' => array(
//                'rule' => array('extension', array('jpg', 'png')),
//                'required' => true,
//                'allowEmpty' => false,
//                // or: 'update'
//                'on' => 'create',
//                'message' => 'png, jpg  files',
//            ),
//            'upload-slider' => array(
//                'rule' => array('uploadFileReview'),
//                'required' => true,
//                'allowEmpty' => false,
//                // or: 'update'
//                'on' => 'create',
//                'message' => 'Error uploading file'
//            )
//        ),
        
    );

    

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
                $results[$key][$this->alias]['created'] = CakeTime::format(ADMIN_DATE_FORMAT,$val[$this->alias]['created'],null,TIME_ZONE);
            }
        }
        return $results;
    }
}
