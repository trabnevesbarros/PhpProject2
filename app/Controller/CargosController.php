<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CargosController extends AppController {
    
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
        $this->Paginator->settings['conditions'] = $this->Cargo->parseCriteria($this->Prg->parsedParams());
        $this->set('cargos', $this->paginate());
    }

    public function index() {         
        $this->Paginator->settings = $this->paginate;
        $this->set('cargos', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $cargo = $this->Cargo->findById($id);
        if (!$cargo) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('cargo', $cargo);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Cargo->create();
            if ($this->Cargo->save($this->request->data)) {
                $this->Session->setFlash(__('Cargo cadastrada'));                      
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Nao foi possivel cadastrar cargo'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $cargo = $this->Cargo->findById($id);
        if (!$cargo) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Cargo->id = $id;
            if ($this->Cargo->save($this->request->data)) {
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $cargo;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $cargo = $this->Cargo->findById($id);
        if (!$cargo) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Cargo->delete($id)) {
            $this->Session->setFlash('Cargo removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover cargo');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
