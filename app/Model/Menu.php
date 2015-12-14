<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Menu extends AppModel{
    public $useTable = 'menus';
    
    public $validate = array(
        'name' => array(
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
        'controller' => array(
            'type' => 'ilike',
            'field' => 'controller',
            'required' => false
        ),
        'action' => array(
            'type' => 'ilike',
            'field' => 'action',
            'required' => false
        )
    );
    
    public $hasMany = array('Submenu' => array('dependent' => true));
}