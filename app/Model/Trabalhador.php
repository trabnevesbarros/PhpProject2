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
        'tempo_atuacao' => array(
            array('rule' => 'notEmpty'),
            array('rule' => 'numeric', 'message' => 'Campo numérico'))
    );
    public $virtualFields = array(
        'formacoes_count' => 'SELECT count(*) FROM trabalhadores_formacoes WHERE trabalhador_id = Trabalhador.id',
        'ocupacao' => 'SELECT name FROM ocupacoes WHERE id = Trabalhador.ocupacao_id'
    );
    public $hasMany = array('Trabalhadoresresposta' => array('dependent' => true));
    public $belongsTo = array('Ocupacao' => array('dependent' => true));
    public $hasAndBelongsToMany = array(
        'Formacao'=> array(
            'className' => 'Formacao',
            'joinTable' => 'trabalhadores_formacoes',
            'foreignKey' => 'trabalhador_id',
            'associationForeignKey' => 'formacao_id')
    );
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'nome_search' => array(
            'type' => 'ilike',
            'field' => 'nome',
            'required' => false
        ),
        'ocupacao_search' => array(
            'type' => 'value',
            'field' => 'ocupacao_id',
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
        'formacoes' => array(
            'type' => 'subquery',
            'method' => 'findByFormacoes',
            'field' => '"Trabalhador"."id"'
        ),
    );
    
        public function findByFormacoes($data = array()) {
        $this->Formacao->Behaviors->attach('Containable', array(
                'autoFields' => false
            )
        );
        $this->Formacao->TrabalhadoresFormacao->Behaviors->attach('Search.Searchable');
        $query = $this->Formacao->TrabalhadoresFormacao->getQuery('all', array(
            'conditions' => array(
                array('TrabalhadoresFormacao.formacao_id' => $data['formacoes'])
            ),
            'fields' => array(
                'trabalhador_id'
            ),
            'contain' => array(
                'Trabalhador'
            )
        ));
        return $query;
    }
    
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
            );            $op = '=';
            if (!empty($data['tempo_atuacao_op']) && in_array($data['tempo_atuacao_op'], $operators)) {
                $op = $data['tempo_atuacao_op'];
            } 
            return array(
                'OR' => array(
                    $this->alias . '.tempo_atuacao '.$op => $nameField,
                    ));
    }
    
}
