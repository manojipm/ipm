<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class UserVideo extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
//    public $belongsTo = array(
//        'UserVideo'=>array(
//                'className'     => 'UserVideo',  
//                'dependent'=> true 
//            )
//    );
    public $primaryKey = 'user_id';
    public $validate = array(
        'profile_vedio' => array(
            'extension' => array(
                'rule' => array('extension', array('mp4', 'mpg', 'mp3')),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'mp4,mp3 ,mpg  files',
            ),
            'uploadVideo' => array(
                'rule' => array('uploadVideo'),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'Error uploading file'
            )
        ),
    );

    public function uploadVideo($check) {

        $key = key($check);

        $uploadData = array_shift($check);

        $ext = pathinfo($uploadData['name']);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        
        $fileName = time() . '.' . $ext['extension'];
        $uploadPath = USER_VIDEO_PATH . DS . $fileName;

        if (!file_exists(USER_VIDEO_PATH)) {
            $oldmask = umask(0);
            mkdir($uploadFolder, 0777);
            umask($oldmask);
        }

        if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
            if (isset($this->data[$this->alias]['id'])) {
                $this->unlinkVideo($key);
            }

            $this->set('pdf_path', $fileName);
            $this->data[$this->alias][$key] = $fileName;
            return true;
        }

        return false;
    }

    public function unlinkVideo($key) {
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
            @unlink(WWW_ROOT . USER_VIDEO_PATH . DS . $files[$this->alias][$key]);
        }
    }

    function beforeValidate($options = array()) {
        if (isset($this->data[$this->alias]["profile_vedio"]["name"]) && $this->data[$this->alias]["profile_vedio"]["name"] == '') {
            unset($this->data[$this->alias]["profile_vedio"]);
        }
        return true; //this is required, otherwise validation will always fail
    }

}
