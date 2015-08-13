<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Empregador extends AppModel {

    public $validate = array(
        'nome' => array('rule' => 'notEmpty'),
        'cargo' => array('rule' => 'notEmpty'),
        'formacao' => array('rule' => 'notEmpty')
    );
    
    public $hasMany = array('Empregadoresresposta' => array('dependent' => true));
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'nome_search' => array(
            'type' => 'ilike',
            'field' => 'nome',
            'required' => false
        ),
        'cargo_search' => array(
            'type' => 'ilike',
            'field' => 'cargo',
            'required' => false
        ),
        'formacao_search' => array(
            'type' => 'ilike',
            'field' => 'formacao',
            'required' => false
        ),
        'range' => array(
            'type' => 'expression',
            'method' => 'makeRangeCondition',
            'field' => 'Docente.views BETWEEN ? AND ?'
        ),
        'enhanced_search' => array(
            'type' => 'like',
            'encode' => true,
            'before' => false,
            'after' => false,
            'field' => array(
                'ThisModel.name', 'OtherModel.name'
            )
        ),
    );

}
