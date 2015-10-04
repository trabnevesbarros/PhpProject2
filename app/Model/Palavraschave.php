<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Palavraschave extends AppModel {
    
    public $validate = array(
        'palavra' => array(array('rule' => 'notEmpty'), array('rule' => 'isUnique', 'message' => 'Already exists')));
    
    public $hasAndBelongsToMany = array(
        'Docentesresposta' => array(
            'className' => 'Docentesresposta',
            'joinTable' => 'docentes_palavras',
            'foreignKey' => 'palavrachave_id',
            'associationForeignKey' => 'docenteresposta_id'
        ),
        'Empregadoresresposta' => array(
            'className' => 'Empregadoresresposta',
            'joinTable' => 'empregadores_palavras',
            'foreignKey' => 'palavrachave_id',
            'associationForeignKey' => 'empregadorresposta_id'
        ),
        'Trabalhadoresresposta' => array(
            'className' => 'Trabalhadoresresposta',
            'joinTable' => 'trabalhadores_palavras',
            'foreignKey' => 'palavrachave_id',
            'associationForeignKey' => 'trabalhadorresposta_id'
        )
    );
    
    public $virtualFields = array(
        'docentes' => 'SELECT count(*) FROM palavraschaves INNER JOIN docentes_palavras ON (docentes_palavras.palavrachave_id = palavraschaves.id) WHERE palavraschaves.id = Palavraschave.id',
        'empregadores' => 'SELECT count(*) FROM palavraschaves INNER JOIN empregadores_palavras ON (empregadores_palavras.palavrachave_id = palavraschaves.id) WHERE palavraschaves.id = Palavraschave.id',
        'trabalhadores' => 'SELECT count(*) FROM palavraschaves INNER JOIN trabalhadores_palavras ON (trabalhadores_palavras.palavrachave_id = palavraschaves.id) WHERE palavraschaves.id = Palavraschave.id'
    );
    public $actsAs = array('Containable');
}

