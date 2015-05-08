<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrabalhadoresperguntasController extends AppController {
    
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('perguntas', $this->Trabalhadorespergunta->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Trabalhadorespergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('pergunta', $pergunta);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Trabalhadorespergunta->create();
            if ($this->Trabalhadorespergunta->save($this->request->data)) {
                $this->Session->setFlash(__('Pergunta cadastrada'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar pergunta'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Trabalhadorespergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Trabalhadorespergunta->id = $id;
            if ($this->Trabalhadorespergunta->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $pergunta;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Trabalhadorespergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }
        
        if($this->Trabalhadorespergunta->delete($id)){
            $this->Session->setFlash(__('Pergunta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover pergunta'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
}
