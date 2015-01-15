<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class News extends AppModel {
	public $name = 'News';
        public $validate = array(
            'title' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Title is required',
                )
            ),
            'description' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Description is required',
                )
            ),
            'role_id' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Role type is required',
                )
            ),
            'published' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Published is required',
                )
            ),
            'news_image' => array(
                    'extension' => array(
                            'rule' => array('extension', array('jpg', 'png','jpeg')),
                            'required' => false,
                            'allowEmpty' => true,
                            // or: 'update'
                            //'on' => 'create',
                            'message' => 'Please file upload only jpg jpeg png.'
                            
                    ),
                    'upload-file-news' => array(
                            'rule' => array('uploadNewsImage'),
                            //'required' => true,
                            //'allowEmpty' => false,
                            // or: 'update'
                            //'on' => 'create',
                            'message' => 'Error uploading file'
                    )
            ),
			
        );
    

    function beforeValidate($options = array()) {
        if (isset($this->data[$this->alias]["news_image"]["name"]) && $this->data[$this->alias]["news_image"]["name"] == '') {
            unset($this->data[$this->alias]["news_image"]);
        }
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
