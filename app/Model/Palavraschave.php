<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Palavraschave extends AppModel {
    
    public $validate = array(
        'palavra' => array(array('rule' => 'notEmpty'), array('rule' => 'isUnique', 'message' => 'Already exists')));
    
    public $hasAndBelongsToMany = array(
        'Docentesresposta' => array(
            'className' => 'Docentesresposta',
            'joinTable' => 'docentes_palavras',
            'fereignKey' => 'palavraschave_id',
            'associationForeignKey' => 'docentesresposta_id'
        )
    );
}

