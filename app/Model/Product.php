<?php

App::uses('AppModel', 'Model');

/**
 * Product Model
 *
 */
class Product extends AppModel {
	public $name = 'Product';
        public $validate = array(
            'name' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Name is required',
                )
            ),
			"quantity"  => array(
				"numeric"  => array(
					"allowEmpty"=> false,
					'rule' => array('numericvalidation'),
					"message"   => "Only valid and numeric characters allowed.",
				),
			),
			"credits"  => array(
				"numeric"  => array(
					"allowEmpty"=> true,
					'rule' => 'Numeric',
					"message"   => "Only numeric characters allowed.",
				),
			),
			"amount"  => array(
				"numeric"  => array(
					"allowEmpty"=> false,
					'rule' => 'Numeric',
					"message"   => "Only numeric characters allowed.",
				),
			),
            'image_file' => array(
                    'extension' => array(
                            'rule' => array('extension', array('gif','jpg', 'png','jpeg','mp3')),
                            'required' => false,
                            'allowEmpty' => true,
                            // or: 'update'
                           // 'on' => 'create',
                            'message' => 'Please upload "gif", "jpg", "jpeg", "png" for gift images  and "mp3" for music file.'
                            
                    ),
                    'upload-file-products' => array(
                            'rule' => array('uploadProductVirImage'),
                            //'required' => true,
                            //'allowEmpty' => false,
                            // or: 'update'
                           // 'on' => 'create',
                            'message' => 'Please upload "gif","jpg", "jpeg", "png" for gift images  and "mp3" for music file.'
                    )
            ), 
			
        );
    
	public function numericvalidation(){
		if(isset($this->data['Product']['type']) && !empty($this->data['Product']['type']) && $this->data['Product']['type'] == 'real'){
			$quantity = $this->data['Product']['quantity'];
			if(empty($quantity) || !is_numeric($quantity)){
				return false;
			}
		}
		return true;
	}
	
	
	 public function uploadProductVirImage($check) {
		if(isset($this->data['Product']['type']) && !empty($this->data['Product']['type'])){
			if($this->data['Product']['type'] == 'virtual'){
				$filePath = VIRPRODUCT_FILE_PATH;
				$fileThumbPath = VIRPRODUCT_THUMB_FILE_PATH;
			}else if($this->data['Product']['type'] == 'love'){
				$filePath = LOVEPRODUCT_FILE_PATH;
				$fileThumbPath = '';//LOVEPRODUCT_THUMB_FILE_PATH;
			}else if($this->data['Product']['type'] == 'romance'){
				$filePath = ROMANCEPRODUCT_FILE_PATH;
				$fileThumbPath = ROMANCEPRODUCT_THUMB_FILE_PATH;
			}else if($this->data['Product']['type'] == 'real'){
				$filePath = REALPRODUCT_FILE_PATH;
				$fileThumbPath = REALPRODUCT_THUMB_FILE_PATH;
			}
			$key = key($check);
			
			$uploadData = array_shift($check);

			$ext = pathinfo($uploadData['name']);
			
			if($this->data['Product']['type'] == 'love' && $ext['extension'] != 'mp3'){
				return false;
			}else if($this->data['Product']['type'] != 'love' && $ext['extension'] == 'mp3'){
				return false;
			}
			
			if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
				return false;
			}

			$fileName = time() . '.' . $ext['extension'];
			$uploadPath = $filePath . DS . $fileName;

			if (!file_exists($filePath)) {
				$oldmask = umask(0);
				mkdir($filePath, 0777);
				umask($oldmask);
			}

			if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
				if (isset($this->data[$this->alias]['id'])) {
					$this->unlinkFileVIRProduct($key,$filePath,$fileThumbPath);
				}
				App::import('Component','Image');
				// Thumb Image 
				if (isset($fileThumbPath) && !empty($fileThumbPath)) {
					$image = new ImageComponent(new ComponentCollection);
					$image->resize_image($filePath. DS . $fileName,'200','110', $fileThumbPath. DS . $fileName);
				}
				$this->set('pdf_path', $fileName);
				$this->data[$this->alias][$key] = $fileName;
				return true;
			}
		}
        return false;
    }

    public function unlinkFileVIRProduct($key,$filePath,$fileThumbPath) {  
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
            @unlink(WWW_ROOT . $filePath . DS . $files[$this->alias][$key]);
            if (isset($fileThumbPath) && !empty($fileThumbPath)) {
				@unlink(WWW_ROOT . $fileThumbPath . DS . $files[$this->alias][$key]);
			}
        }
    }
    function beforeValidate($options = array()) {
        if (isset($this->data[$this->alias]["image_file"]["name"]) && $this->data[$this->alias]["image_file"]["name"] == '') {
            unset($this->data[$this->alias]["image_file"]);
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
