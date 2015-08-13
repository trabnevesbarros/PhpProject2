<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrabalhadoresController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Trabalhador', 'Trabalhadoresresposta', 'Pergunta');
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
        'formacao_search' => array(
            'type' => 'value'
        )
    );

    public function find() {
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Trabalhador->parseCriteria($this->Prg->parsedParams());
        $this->set('trabalhadores', $this->paginate());
    }

    public function index() {
        $this->Pergunta->recursive = 0;
        $this->Trabalhador->recursive = -1;
        $this->set('perguntas', $this->Pergunta->find('first', array('conditions' => array('Tipo.name' => 'Trabalhador'))));
        $this->set('trabalhadores', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhador->recursive = -1;
        $trabalhador = $this->Trabalhador->findById($id);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('trabalhador', $trabalhador);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Trabalhador->create();
            if ($this->Trabalhador->save($this->request->data)) {
                $this->Session->setFlash(__('Trabalhador cadastrado'));
                $perguntas = $this->Pergunta->find('first', array('conditions' => array('Tipo.name' => 'Trabalhador')));
                if ($perguntas) {
                    return $this->redirect(array('action' => 'questionarioAdd', $this->Trabalhador->id, 0, true));
                }
                $this->Session->setFlash(__('Não foi possivel responder questionario'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar trabalhador'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhador->recursive = -1;
        $trabalhador = $this->Trabalhador->findById($id);

        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Trabalhador->id = $id;
            if ($this->Trabalhador->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $trabalhador;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhador->recursive = -1;
        $trabalhador = $this->Trabalhador->findById($id);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Trabalhador->delete($id)) {
            $this->Session->setFlash(__('Trabalhador removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover trabalhador'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
