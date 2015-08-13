<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Docentesresposta extends AppModel {

    public $belongsTo = array('Docente', 'Pergunta');
    
    public $hasAndBelongsToMany = array(
        'Palavraschave' => array(
            'className' => 'Palavraschave',
            'joinTable' => 'docentes_palavras',
            'foreignKey' => 'docentesresposta_id',
            'associationForeignKey' => 'palavraschave_id'
        )
    );
    
    public $actsAs = array('Containable', 'Search.Searchable');
    
    public $filterArgs = array(
        'resposta_search' => array(
            'type' => 'ilike',
            'field' => 'resposta',
            'required' => false
        ),
        'pergunta_search' => array(
            'type' => 'query',
            'method' => 'filterPergunta',
            'field' => 'pergunta'
        ),
        'range' => array(
            'type' => 'expression',
            'method' => 'makeRangeCondition',
            'field' => 'Docentesresposta.views BETWEEN ? AND ?'
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
    
    public function filterPergunta($data, $field = null) {
        if (empty($data['pergunta_search'])) {
                return array();
            }
            $nameField = $data['pergunta_search'];        
            
            return array(
                'OR' => array(
                    'Pergunta' . '.pergunta ILIKE' => '%' . $nameField . '%'
                )
            );
        
    }

}
