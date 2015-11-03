<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmpregadoresController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Empregador', 'Empregadoresresposta', 'Pergunta', 'Cargo', 'Formacao');
    public $paginate = array(
        'limit' => 12
    );
    public $components = array(
        'Search.Prg',
        'Paginator'
    );

    public $presetVars = array(
        'nome_search' => array(
            'type' => 'value'
        ),
        'cargo_search' => array(
            'type' => 'value'
        ),
        'tempo_atuacao_search' => array(
            'type' => 'value'
        ),
        'tempo_atuacao_op' => array(
            'type' => 'value'
            
        ),
        'formacoes' => array(
            'type' => 'value'
        )
    );
    
    public function find() {         
        $this->Paginator->settings = $this->paginate;
        $this->Formacao->recursive = 2;
        $formacoes = $this->Formacao->find('list');
        $this->set('formacoes', $formacoes);
        $cargos = $this->Cargo->find('list');
        $this->set('cargos', $cargos);
        $this->set('operators', array(
            '=' => '=',
            '>' => '>',
            '<' => '<',
            '>=' => '>=',
            '<=' => '<=',
            '!=' => '!='
            ));
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Empregador->parseCriteria($this->Prg->parsedParams());
        $this->set('perguntas', $this->Pergunta->find('first', array('conditions' => array('tipo' => 'Empregador'))));
        $this->set('empregadores', $this->paginate());
    }

    public function index() {        
        $this->Paginator->settings = $this->paginate;
        $this->Pergunta->recursive = 0;
        $this->Empregador->recursive = 1;
        $this->set('perguntas', $this->Pergunta->find('first', array('conditions' => array('tipo' => 'Empregador'))));
        $this->set('empregadores', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Empregador->recursive = 1;
        $empregador = $this->Empregador->findById($id);
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('empregador', $empregador);
    }

    public function add() {
        
        $this->Cargo->recursive = -1;
        $cargos = $this->Cargo->find('list');
        $this->set('cargos', $cargos);
        
        $this->Formacao->recursive = 2;
        $formacoes = $this->Formacao->find('list');
        $this->set('formacoes', $formacoes);
        
        if ($this->request->is('post')) {
            $this->Empregador->create();
            if ($this->Empregador->save($this->request->data)) {
                $this->Session->setFlash(__('Empregador cadastrado'));
                $perguntas = $this->Pergunta->find('first', array('conditions' => array('Tipo.name' => 'Empregador')));
                if ($perguntas) {
                    return $this->redirect(array('action' => 'questionarioAdd', 'controller' => 'Empregadoresrespostas', $this->Empregador->id, 0, true));
                }
                $this->Session->setFlash(__('Não foi possivel responder questionario'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar empregador'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Empregador->recursive = 1;
        $empregador = $this->Empregador->findById($id);
        $this->set('empregador', $empregador);
        
        $this->Cargo->recursive = -1;
        $cargos = $this->Cargo->find('list');
        $this->set('cargos', $cargos);
        
        $this->Formacao->recursive = 2;
        $formacoes = $this->Formacao->find('list');
        $this->set('formacoes', $formacoes);
        
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Empregador->id = $id;
            $this->request->data['Empregador']['Formacao']['Empregador']['id'] = $empregador['Empregador']['id'];
            if ($this->Empregador->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $empregador;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Empregador->recursive = -1;
        $empregador = $this->Empregador->findById($id);
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Empregador->delete($id)) {
            $this->Session->setFlash(__('Empregador removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover empregador'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
