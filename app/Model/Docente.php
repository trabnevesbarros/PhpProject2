<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Docente extends AppModel {
    
    public $useTable = 'docentes';

    public $validate = array(
        'nome' => array('rule' => 'notEmpty'),
        'tempo_atuacao' => array(
            array('rule' => 'notEmpty'),
            array('rule' => 'numeric', 'message' => 'Campo numérico'))
    );
    public $virtualFields = array(
        'formacoes_count' => 'SELECT count(*) FROM docentes_formacoes WHERE docente_id = Docente.id',
        'area' => 'SELECT name FROM areas WHERE id = Docente.area_id'
    );
    public $hasMany = array('Docentesresposta' => array('dependent' => true));
    public $belongsTo = array('Area' => array('dependent' => true));
    public $hasAndBelongsToMany = array(
        'Formacao'=> array(
            'className' => 'Formacao',
            'joinTable' => 'docentes_formacoes',
            'foreignKey' => 'docente_id',
            'associationForeignKey' => 'formacao_id')
    );
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'nome_search' => array(
            'type' => 'ilike',
            'field' => 'nome',
            'required' => false
        ),
        'area_search' => array(
            'type' => 'value',
            'field' => 'area_id',
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
            'field' => '"Docente"."id"'
        ),
    );
    
        public function findByFormacoes($data = array()) {
        $this->Formacao->Behaviors->attach('Containable', array(
                'autoFields' => false
            )
        );
        $this->Formacao->DocentesFormacao->Behaviors->attach('Search.Searchable');
        $query = $this->Formacao->DocentesFormacao->getQuery('all', array(
            'conditions' => array(
                array('DocentesFormacao.formacao_id' => $data['formacoes'])
            ),
            'fields' => array(
                'docente_id'
            ),
            'contain' => array(
                'Docente'
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
