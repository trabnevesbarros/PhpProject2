<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tipo extends AppModel {
    
    public $useTable = 'tipos';

    public $validate = array(
        'name' => array('rule' => 'notEmpty'));
    
    public $actsAs = array('Search.Searchable');
    
    public $hasMany = array('Pergunta' => array('dependent' => true));
    
    public $filterArgs = array(
        'name_search' => array(
            'type' => 'ilike',
            'field' => 'name',
            'required' => false
        )
    );

}

