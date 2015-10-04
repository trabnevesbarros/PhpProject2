<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AreasController extends AppController {

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
        $this->Paginator->settings['conditions'] = $this->Area->parseCriteria($this->Prg->parsedParams());
        $this->Area->recursive = -1;
        $this->set('areas', $this->paginate());
    }

    public function index() {         
        $this->Paginator->settings = $this->paginate;
        $this->Area->recursive = -1;
        $this->set('areas', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Area->recursive = -1;
        $area = $this->Area->findById($id);
        if (!$area) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('area', $area);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Area->create();
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('Area cadastrada'));                      
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Nao foi possivel cadastrar area'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Area->recursive = -1;
        $area = $this->Area->findById($id);
        if (!$area) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Area->id = $id;
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $area;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $this->Area->recursive = -1;
        $area = $this->Area->findById($id);
        if (!$area) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Area->delete($id)) {
            $this->Session->setFlash('Area removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover area');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
