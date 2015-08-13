<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Docente extends AppModel {

    public $validate = array(
        'nome' => array('rule' => 'notEmpty'),
        'area' => array('rule' => 'notEmpty'),
        'formacao' => array('rule' => 'notEmpty'),
        'tempo_atuacao' => array(
            array('rule' => 'notEmpty'),
            array('rule' => 'numeric', 'message' => 'Campo numérico'))
    );
    
    public $hasMany = array('Docentesresposta' => array('dependent' => true));
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'nome_search' => array(
            'type' => 'ilike',
            'field' => 'nome',
            'required' => false
        ),
        'area_search' => array(
            'type' => 'ilike',
            'field' => 'area',
            'required' => false
        ),
        'formacao_search' => array(
            'type' => 'ilike',
            'field' => 'formacao',
            'required' => false
        ),
        'tempo_atuacao_search' => array(
            'type' => 'query',
            'field' => 'tempo_atuacao',
            'method' => 'filterTempoAtuacao',
            'required' => false
        ),
        'tempo_atuacao_op' => array(
            'type' => 'checkbox'
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
    
    public function filterTempoAtuacao($data, $field = null) {
            if (empty($data['tempo_atuacao_search'])) {
                return array();
            }
            $nameField = $data['tempo_atuacao_search'];
            if (!is_numeric($nameField)) {
                return array();
            }          
            $operators = array(
            '=' => '=',
            '>' => '>',
            '<' => '<',
            '>=' => '>=',
            '<=' => '<=',
            '!=' => '!='
            );
            $op = '=';
            if (!empty($data['tempo_atuacao_op']) && in_array($data['tempo_atuacao_op'], $operators)) {
                $op = $data['tempo_atuacao_op'];
            } 
            return array(
                'OR' => array(
                    $this->alias . '.tempo_atuacao '.$op => $nameField,
                    ));
    }
    
}
