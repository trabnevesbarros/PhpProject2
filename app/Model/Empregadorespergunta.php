<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Empregadorespergunta extends AppModel {
    
    public $validate = array(
        'pergunta' => array('rule' => 'notEmpty')
    );
    
    public $hasMany = array('Empregadoresresposta' => array('dependent' => true));
    
}