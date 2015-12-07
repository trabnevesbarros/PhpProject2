<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MenusController extends AppController{
    
    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Menu');
    
    public $paginate = array(
        'limit' => 12
    );
    public $components = array(
        'Search.Prg',
        'Paginator'
    );
 
    public $presetVars = array(
        'titulo_search' => array(
            'type' => 'value'
        ));
    
    
    
    
    public function index() {        
        $this->Paginator->settings = $this->paginate;
        $this->Menu->recursive = 1;
        $this->set('menus', $this->paginate());
    }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Menu->recursive = 1;
        $menu = $this->Menu->findById($id);
        if (!$menu) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('menu', $menu);
    }
    
    public function add(){
        $this->set('controller', $this->Ctrl->get());
        
        $this->set('action', array(
            'inicio' => 'index',
            'adicionar' => 'add',
            'pesquisa' => 'find'
            ));
    
    if ($this->request->is('post')) {
            $this->Menu->create();
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash(__('Menu cadastrado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar menu'));
            }
        }
        
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Menu->parseCriteria($this->Prg->parsedParams());
        $this->set('menus', $this->paginate());
        
    }
    
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('controller', $this->Ctrl->get());
        
        $this->set('action', array(
            'inicio' => 'index',
            'adicionar' => 'add',
            'pesquisa' => 'find'
            ));
        
        if (!$menu) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Menu->id = $id;
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $menu;
        }
    }
    
    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Menu->recursive = -1;
        $menu = $this->Menu->findById($id);
        if (!$menu) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Menu->delete($id)) {
            $this->Session->setFlash(__('Menu removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover empregador'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
}