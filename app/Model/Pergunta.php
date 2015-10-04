<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pergunta extends AppModel {

    public $validate = array(
        'pergunta' => array('rule' => 'notEmpty'),
        'tipo_id' => array('rule' => 'notEmpty')
    );
    public $virtualFields = array(
        'tipo' => 'SELECT name FROM tipos WHERE id = Pergunta.tipo_id'
    );
    public $hasMany = array('Docentesresposta' => array('dependent' => true),
        'Empregadoresresposta' => array('dependent' => true),
        'Trabalhadoresresposta' => array('dependent' => true));
    public $belongsTo = array('Tipo');
    public $actsAs = array('Containable', 'Search.Searchable');
    public $filterArgs = array(
        'pergunta_search' => array(
            'type' => 'ilike',
            'field' => 'pergunta',
            'required' => false
        ),
        'tipo_search' => array(
            'type' => 'value',
            'field' => 'tipo_id',
            'required' => false
        )
    );

}
