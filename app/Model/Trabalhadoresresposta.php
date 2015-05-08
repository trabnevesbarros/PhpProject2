<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Trabalhadoresresposta extends AppModel {

    public $belongsTo = array('Trabalhador' => array(
            'className' => 'Trabalhador',
            'foreignKey' => 'trabalhador_id'),
        'Trabalhadorespergunta' => array(
            'className' => 'Trabalhadorespergunta',
            'foreignKey' => 'trabalhadorespergunta_id'));

}
