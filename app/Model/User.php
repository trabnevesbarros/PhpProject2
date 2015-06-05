<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends AppModel {
    
    public $useTable = 'users';

    public $validate = array(
        'name' => array('rule' => 'notEmpty'),
        'password' => array('rule' => 'notEmpty')
    );

}
