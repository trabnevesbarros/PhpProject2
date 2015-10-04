<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Formacao extends AppModel {
    
    public $useTable = 'formacoes';

    public $validate = array(
        'name' => array(
            array('rule' => 'notEmpty'), 
            array('rule' => 'isUnique', 'message' => 'Entrada já existe')
        )
    );
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'name_search' => array(
            'type' => 'ilike',
            'field' => 'name',
            'required' => false
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Docente'=> array(
            'className' => 'Docente',
            'joinTable' => 'docentes_formacoes',
            'foreigngKey' => 'formacao_id',
            'associationForeinKey' => 'docente_id'),
       
        'Empregador'=> array(
            'className' => 'Empregador',
            'joinTable' => 'empregadores_formacoes',
            'foreigngKey' => 'formacao_id',
            'associationForeinKey' => 'empregador_id'),
        
        'Trabalhador'=> array(
            'className' => 'Trabalhador',
            'joinTable' => 'trabalhadores_formacoes',
            'foreigngKey' => 'formacao_id',
            'associationForeinKey' => 'trabalhador_id')
    );
}