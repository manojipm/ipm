<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Slider extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
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
                'message' => 'Role Type is required',
                
            )
        ),
        'slider_image' => array(
            'extension' => array(
                'rule' => array('extension', array('jpg', 'png')),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'png, jpg  files',
            ),
            'upload-slider' => array(
                'rule' => array('uploadFileSlider'),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'Error uploading file'
            )
        ),
    );

    public function uploadFileSlider($check) {

        $key = key($check);

        $uploadData = array_shift($check);

        $ext = pathinfo($uploadData['name']);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        $fileName = time() . '.' . $ext['extension'];
        $uploadPath = SLIDER_FILE_PATH . DS . $fileName;

        if (!file_exists(SLIDER_FILE_PATH)) {
            $oldmask = umask(0);
            mkdir(SLIDER_FILE_PATH, 0777);
            umask($oldmask);
        }

        if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
			$image = new ImageComponent(new ComponentCollection);
			$image->resize_image($uploadPath,'1140','435', $uploadPath);
			
            if (isset($this->data[$this->alias]['id'])) {
                $this->unlinkFileSlider($key);
            }

            $this->set('pdf_path', $fileName);
            $this->data[$this->alias][$key] = $fileName;
            return true;
        }

        return false;
    }

    public function unlinkFileSlider($key) {
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
            @unlink(WWW_ROOT . SLIDER_FILE_PATH . DS . $files[$this->alias][$key]);
        }
    }

    function beforeValidate($options = array()) {
        if (isset($this->data[$this->alias]["slider_image"]["name"]) && $this->data[$this->alias]["slider_image"]["name"] == '') {
            unset($this->data[$this->alias]["slider_image"]);
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
                $results[$key][$this->alias]['created'] = CakeTime::format(ADMIN_DATE_FORMAT, $val[$this->alias]['created'], null, TIME_ZONE);
            }
        }
        return $results;
    }

}
