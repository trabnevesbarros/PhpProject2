<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DocentesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Docente', 'Docentesresposta', 'Pergunta');
    
    public $paginate = array(
        'limit' => 12,
    );

    public function index() {
        $this->Pergunta->recursive = 0;
        $this->Docente->recursive = -1;
        $this->set('perguntas', $this->Pergunta->find('first', array('conditions' => array('Tipo.name' => 'Docente'))));
        $this->set('docentes', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Docente->recursive = -1;
        $docente = $this->Docente->findById($id);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('docente', $docente);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Docente->create();
            if ($this->Docente->save($this->request->data)) {
                $this->Session->setFlash(__('Docente cadastrado'));
                $perguntas = $this->Pergunta->find('count', array('conditions' => array('Tipo.name' => 'Docente')));
                if ($perguntas) {
                    return $this->redirect(array('action' => 'questionarioAdd', $this->Docente->id, 0, true));
                }
                $this->Session->setFlash(__('Não foi possivel responder questionario'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar docente'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Docente->recursive = -1;
        $docente = $this->Docente->findById($id);

        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Docente->id = $id;
            if ($this->Docente->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $docente;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Docente->recursive = -1;
        $docente = $this->Docente->findById($id);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Docente->delete($id)) {
            $this->Session->setFlash(__('Docente removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover docente'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
