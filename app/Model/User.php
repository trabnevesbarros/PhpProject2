<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $useTable = 'users';
    public $validate = array(
        'name' => array('rule' => 'notEmpty'),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A senha é necessária'
            ),
            'min_length' => array(
                'rule' => array('minLength', '8'),  
                'message' => 'A senha precisa ter uma quantidade minima de 8 caracteres'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Por favor, confirme sua senha'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'As senhas não são iguais'
            )
        ),         
        'email' => array(
            'required' => array(
                'rule' => array('email'),    
                'message' => 'Este e-mail é inválido'   
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Este e-mail já existe',
            ),
        ),
        'password_update' => array(
        ),
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false
            )
        )
    );
    
    public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }
        
        return true;
    }

}
