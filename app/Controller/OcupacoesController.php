<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OcupacoesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $paginate = array(
        'limit' => 12
    );
    public $components = array(
        'Search.Prg',
        'Paginator'
    );
    public $presetVars = array('name_search' => array('type' => 'value'));

    public function find() {         
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Ocupacao->parseCriteria($this->Prg->parsedParams());
        $this->set('ocupacoes', $this->paginate());
    }

    public function index() {         
        $this->Paginator->settings = $this->paginate;
        $this->set('ocupacoes', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $ocupacao = $this->Ocupacao->findById($id);
        if (!$ocupacao) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('ocupacao', $ocupacao);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Ocupacao->create();
            if ($this->Ocupacao->save($this->request->data)) {
                $this->Session->setFlash(__('Ocupacao cadastrada'));                      
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Nao foi possivel cadastrar ocupacao'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $ocupacao = $this->Ocupacao->findById($id);
        if (!$ocupacao) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Ocupacao->id = $id;
            if ($this->Ocupacao->save($this->request->data)) {
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $ocupacao;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $ocupacao = $this->Ocupacao->findById($id);
        if (!$ocupacao) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Ocupacao->delete($id)) {
            $this->Session->setFlash('Ocupacao removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover ocupacao');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
