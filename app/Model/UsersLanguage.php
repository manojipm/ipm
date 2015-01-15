<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class UsersLanguage extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $useTable  = 'users_languages';
    /**
    * @see Model::$actsAs
    */
    public $actsAs = array(
        'Containable',
    );

    /**
     * @see Model::$belongsTo
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
        'Language' => array(
            'className' => 'Language',
            'foreignKey' => 'language_id',
        ),
    );

}
