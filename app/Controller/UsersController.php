<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function login() {
        if($this->Session->check('Auth.User')){
            $this->redirect($this->Auth->redirectUrl());      
        }
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalido'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario cadastrado'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Não foi possivel cadastrar usuario'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($user['User']['id'] == $this->Session->read('Auth.User.id')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('Usuario removido'));

            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Não foi possivel remover usuario'));
        return $this->redirect(array('action' => 'index'));
    }

}
