<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stopword extends AppModel {

    public $validate = array(
        'termo' => array('rule' => 'notEmpty'));
    
    public $actsAs = array('Search.Searchable');
    
    public $filterArgs = array(
        'termo_search' => array(
            'type' => 'ilike',
            'field' => 'termo',
            'required' => false
        ),
        'range' => array(
            'type' => 'expression',
            'method' => 'makeRangeCondition',
            'field' => 'Stopword.views BETWEEN ? AND ?'
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

}
