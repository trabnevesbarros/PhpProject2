<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Area extends AppModel {

    public $useTable = 'areas';
    
    public $validate = array(
        'name' => array(
            array('rule' => 'notEmpty'),
            array('rule' => 'isUnique')
        )
    );
    
    public $actsAs = array('Search.Searchable');
    
    public $hasMany = array('Docente' => array('dependent' => true));
    
    public $filterArgs = array(
        'name_search' => array(
            'type' => 'ilike',
            'field' => 'name',
            'required' => false
        )
    );

}
