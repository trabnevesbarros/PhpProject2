<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Empregador extends AppModel {

    public $useTable = 'empregadores';
    
    public $validate = array(
        'nome' => array('rule' => 'notEmpty')
    );
    
    public $hasMany = array('Empregadoresresposta' => array('dependent' => true));
    
    public $belongsTo = array('Cargo' => array('dependent' => true));
    
    public $hasAndBelongsToMany = array(
        'Formacao'=> array(
            'className' => 'Formacao',
            'joinTable' => 'empregadores_formacoes',
            'foreingKey' => 'empregador_id',
            'associationForeinKey' => 'formacao_id')
    );
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'nome_search' => array(
            'type' => 'ilike',
            'field' => 'nome',
            'required' => false
        )
    );

}
