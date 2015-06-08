<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $useTable = 'users';
    public $validate = array(
        'name' => array('rule' => 'notEmpty'),
        'password' => array('rule' => 'notEmpty')
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}
