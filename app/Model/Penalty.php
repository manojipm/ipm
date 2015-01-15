<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Penalty extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'agency_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Select agency is required',
            )
        ),
        'user_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nickname is required',
            )
        ),
        'reason' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Penalty reason is required',
            )
        ),
        'summary' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Summary is required',
            )
        ),
        'amount' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Amount is required',
            )
        ),
        'attachment' => array(
            'extension' => array(
                'rule' => array('extension', array('jpg', 'png')),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'png, jpg  files',
            ),
            'upload-attchment' => array(
                'rule' => array('uploadFileAttchment'),
                'required' => false,
                'allowEmpty' => true,
                // or: 'update'
                //'on' => 'create',
                'message' => 'Error uploading file'
            )
        ),
    );

    public function uploadFileAttchment($check) {

        $key = key($check);

        $uploadData = array_shift($check);

        $ext = pathinfo($uploadData['name']);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        $fileName = time() . '.' . $ext['extension'];
        $uploadPath = PENALTY_ATTACHMENT_FILE_PATH . DS . $fileName;

        if (!file_exists(PENALTY_ATTACHMENT_FILE_PATH)) {
            $oldmask = umask(0);
            mkdir(PENALTY_ATTACHMENT_FILE_PATH, 0777);
            umask($oldmask);
        }

        if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
            if (isset($this->data[$this->alias]['id'])) {
                $this->unlinkFileAttachment($key);
            }

            $this->set('pdf_path', $fileName);
            $this->data[$this->alias][$key] = $fileName;
            return true;
        }

        return false;
    }

    public function unlinkFileAttachment($key) {
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
            @unlink(WWW_ROOT . PENALTY_ATTACHMENT_FILE_PATH . DS . $files[$this->alias][$key]);
        }
    }

    function beforeValidate($options = array()) {
        if (isset($this->data[$this->alias]["attachment"]["name"]) && $this->data[$this->alias]["attachment"]["name"] == '') {
            unset($this->data[$this->alias]["attachment"]);
        }
//        if (!isset($this->data[$this->alias]["status"])) {
//            $this->data[$this->alias]["status"] = 0;
//        }
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
