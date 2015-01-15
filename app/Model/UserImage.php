<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class UserImage extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
//    public $belongsTo = array(
//        'UserImage'=>array(
//                'className'     => 'UserImage',  
//                'dependent'=> true 
//            )
//    );
    public $primaryKey = 'user_id';
    
    public $validate = array(
        
        'image_name' => array(
            'extension' => array(
                'rule' => array('extension', array('jpeg', 'jpg','png','gif')),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'jpg, jpeg , png, gif   files',
            ),
            'uploadProfileImage' => array(
                'rule' => array('uploadProfileImage'),
                'message' => 'Error uploading file'
            )
        ),
        
    ); 

    public function uploadProfileImage($check) {

        $key = key($check);

        $uploadData = array_shift($check);

        $ext = pathinfo($uploadData['name']);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        
        $fileName = time() . '.' . $ext['extension'];
        $uploadPath = USER_PIC_PATH . DS . $fileName;

        if (!file_exists(USER_PIC_PATH)) {
            $oldmask = umask(0);
            mkdir($uploadFolder, 0777);
            umask($oldmask);
        }
        
        if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
            if (isset($this->data[$this->alias]['id'])) {
                $this->unlinkProfileImage($key);
            }
            $this->set('pdf_path', $fileName);
            $this->data[$this->alias][$key] = $fileName;
            return true;
        }

        return false;
    }

    public function unlinkProfileImage($key) {
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
                @unlink(WWW_ROOT .USER_PIC_PATH . DS . $files[$this->alias][$key]);
        }
    }


    function beforeValidate($options = array()) {
        
        if (isset($this->data[$this->alias]["image_name"]["name"]) && $this->data[$this->alias]["image_name"]["name"] == '') {
            unset($this->data[$this->alias]["image_name"]);
            //unset($this->data[$this->alias]["is_profile_pic"]);
        }
        return true; //this is required, otherwise validation will always fail
    }
}
