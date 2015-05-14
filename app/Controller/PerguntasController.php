<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PerguntasController extends AppController {
    
    public $helpers = array('Html', 'Form');
    public $uses = array('Pergunta', 'Perguntastipo');
    
    public function index() {
        
        $this->set('perguntastipos', (($this->Perguntastipo->find('count') > 0 ) ? true : false));
//  
 $this->set('perguntas', $this->Pergunta->query('select perguntas.id, pergunta, perguntastipos.name  from perguntas inner join perguntastipos on (perguntastipos.id = perguntas.perguntastipo_id);'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Pergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('pergunta', $pergunta);
    }

    public function add() {
        $perguntastipos = $this->Perguntastipo->find('list');
        if (!$perguntastipos) {
            throw new NotFountException(__('Invalid'));
        }
        $this->set('perguntastipos', $perguntastipos);
        
        if ($this->request->is('post')) {
            $this->Pergunta->create();
            if ($this->Pergunta->save($this->request->data)) {
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

        $pergunta = $this->Pergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Pergunta->id = $id;
            if ($this->Pergunta->save($this->request->data)) {
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

        $pergunta = $this->Pergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }
        
        if($this->Pergunta->delete($id)){
            $this->Session->setFlash(__('Pergunta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover pergunta'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
}
