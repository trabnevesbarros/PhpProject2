<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormacoesController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array(
        'Search.Prg',
        'Paginator'
    );
    public $paginate = array(
        'limit' => 12
    );
    
    public $presetVars = array('name_search' => array('type' => 'value'));

    public function find() {         
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Formacao->parseCriteria($this->Prg->parsedParams());
        $this->Formacao->recursive = -1;
        $this->set('formacoes', $this->paginate());
    }

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $this->Formacao->recursive = -1;
        $this->set('formacoes', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Formacao->recursive = -1;
        $formacao = $this->Formacao->findById($id);
        if (!$formacao) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('formacao', $formacao);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Formacao->create();
            if ($this->Formacao->save($this->request->data)) {
                $this->Session->setFlash(__('Formacao cadastrada'));                      
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Nao foi possivel cadastrar formacao'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->Formacao->recursive = -1;
        $formacao = $this->Formacao->findById($id);
        if (!$formacao) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Formacao->id = $id;
            if ($this->Formacao->save($this->request->data)) {
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $formacao;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $this->Formacao->recursive = -1;
        $formacao = $this->Formacao->findById($id);
        if (!$formacao) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Formacao->delete($id)) {
            $this->Session->setFlash('Formacao removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover formacao');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
