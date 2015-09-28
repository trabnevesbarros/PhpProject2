<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Trabalhador extends AppModel {
    
    public $useTable = 'trabalhadores';

    public $validate = array(
        'nome' => array('rule' => 'notEmpty'),
        'formacao' => array('rule' => 'notEmpty')
    );
    
    public $hasMany = array('Trabalhadoresresposta' => array('dependent' => true));
    
    public $belongsTo = array('Ocupacao' => array('dependent' => true));
    
    public $hasAndBelongsToMany = array(
        'Formacao'=> array(
            'className' => 'Formacao',
            'joinTable' => 'trabalhadores_formacoes',
            'foreingKey' => 'trabalhador_id',
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