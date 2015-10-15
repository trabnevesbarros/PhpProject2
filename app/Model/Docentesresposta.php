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
            'foreignKey' => 'docenteresposta_id',
            'associationForeignKey' => 'palavrachave_id'
        )
    );

    public $virtualFields = array(
        'docente' => 'select nome from docentes where docentes.id = Docentesresposta.docente_id',
        'pergunta' => 'select perguntas.pergunta from perguntas where perguntas.id = Docentesresposta.pergunta_id',     
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
        )
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
