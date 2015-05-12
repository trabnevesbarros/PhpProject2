<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PerguntastiposController extends AppController {
    
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('perguntastipos', $this->Perguntastipo->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $perguntastipo = $this->Perguntastipo->findById($id);
        if (!$perguntastipo) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntastipo', $perguntastipo);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Perguntastipo->create();
            if ($this->Perguntastipo->save($this->request->data)) {
                $this->Session->setFlash(__('Tipo cadastrado'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar tipo'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $perguntastipo = $this->Perguntastipo->findById($id);
        if (!$perguntastipo) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Perguntastipo->id = $id;
            if ($this->Perguntastipo->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $perguntastipo;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $perguntastipo = $this->Perguntastipo->findById($id);
        if (!$perguntastipo) {
            throw new NotFoundException(__('Invalid'));
        }
        
        if($this->Perguntastipo->delete($id)){
            $this->Session->setFlash(__('Tipo removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover tipo'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
}


