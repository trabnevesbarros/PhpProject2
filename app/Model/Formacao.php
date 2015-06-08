<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Formacao extends AppModel {

    public $validate = array('name' => array('rule' => 'notEmpty'));
    
    public $hasAndBelongsToMany = array(
        'Docente'=> array(
            'className' => 'Docente',
            'joinTable' => 'docentes_formacaos',
            'foreingKey' => 'formacao_id',
            'associationForeinKey' => 'docente_id'),
       
        'Empregador'=> array(
            'className' => 'Empregador',
            'joinTable' => 'empregadores_formacaos',
            'foreingKey' => 'formacao_id',
            'associationForeinKey' => 'empregador_id'),
        
        'Trabalhador'=> array(
            'className' => 'Trabalhador',
            'joinTable' => 'trabalhadores_formacaos',
            'foreingKey' => 'formacao_id',
            'associationForeinKey' => 'trabalhador_id')
    );
}