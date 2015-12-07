<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Submenu extends AppModel{
    public $useTable = 'submenus';
    
    public $validate = array(
        'titulo' => array(
            array('rule' => 'notEmpty')
        )
    );
    
    public $actsAs = array('Search.Searchable');
    
    
    public $filterArgs = array(
        'name_search' => array(
            'type' => 'ilike',
            'field' => 'titulo',
            'required' => false
        )
    );
    
    public $belongsTo = array('Menu' => array('dependent' => true));
}