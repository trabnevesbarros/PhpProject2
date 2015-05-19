<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tipo extends AppModel{
    
    public $validate = array(
        'name' => array('rule' => 'notEmpty')
    );
    
    public $hasMany = array('Pergunta' => array('dependent' => true));
}

