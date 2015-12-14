<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SubmenusController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Submenu', 'Menu');
    public $paginate = array(
        'limit' => 12
    );
    public $components = array(
        'Search.Prg',
        'Paginator',
        'Ctrl'
    );
    public $presetVars = array(
        'name_search' => array(
            'type' => 'value'),
        'controller' => array(
            'type' => 'value'),
        'action' => array(
            'type' => 'value'
            ));

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $this->Submenu->recursive = 1;
        $this->set('submenus', $this->paginate());
        
    }

    public function add() {
        $controller = array();
        foreach ($this->Ctrl->get() as $key => $value) {
            $controller[$key] = $key;
            
        }
        $this->set('controller', $controller);
        
        $this->set('action', array(
            'index' => 'listar',
            'add' => 'adicionar',
            'find' => 'pesquisar'
        ));
        
        $this->set('menus', $this->Menu->find('list'));
        
        
        if ($this->request->is('post')) {
            $this->Submenu->create();
            
            if ($this->Submenu->save($this->request->data)) {
                $this->Session->setFlash(__('Submenu cadastrado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar submenu'));
            }
        }

        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Submenu->parseCriteria($this->Prg->parsedParams());
        $this->set('submenus', $this->paginate());
    }

    public function edit($id = null) {
        
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }
        $controller = array();
        foreach ($this->Ctrl->get() as $key => $value) {
            $controller[$key] = $key;
            
        }
        $this->set('controller', $controller);
        
        $this->set('action', array(
            'index' => 'listar',
            'add' => 'adicionar',
            'find' => 'pesquisar'
        ));
        
        
        $this->set('menus', $this->Menu->find('list'));
        
        $submenu = $this->Submenu->findById($id);
        if (!$submenu) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Submenu->id = $id;
            if ($this->Submenu->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $submenu;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Submenu->recursive = -1;
        $submenu = $this->Submenu->findById($id);
        if (!$submenu) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Submenu->delete($id)) {
            $this->Session->setFlash(__('Submenu removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover empregador'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    public function find() {  
        
        $controller = array();
        $controller[''] = '--';
        foreach ($this->Ctrl->get() as $key => $value) {
            $controller[$key] = $key;
            
        }
        $this->set('controller', $controller);
        
        $this->set('action', array(
            '' => '--',
            'index' => 'listar',
            'add' => 'adicionar',
            'find' => 'pesquisar'
        ));
        $this->set('menus', $this->Menu->find('list'));
        
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Submenu->parseCriteria($this->Prg->parsedParams());
        $this->set('submenus', $this->paginate());
    }

}
