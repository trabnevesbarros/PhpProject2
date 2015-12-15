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
            'field' => 'name',
            'required' => false
        ),
        'controller_search' => array(
            'type' => 'ilike',
            'field' => 'controller',
            'required' => false
        ),
        'action_search' => array(
            'type' => 'ilike',
            'field' => 'action',
            'required' => false
        ),
        'menu_search' => array(
            'type' => 'value',
            'field' => 'menu_id',
            'required' => false
        )
    );
    
    public $belongsTo = array('Menu' => array('dependent' => true));
}