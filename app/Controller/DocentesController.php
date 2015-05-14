<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DocentesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Docente', 'Pergunta', 'Docentesresposta');

    public function index() {
        $this->set('perguntas', $this->Pergunta->find('all'));
        $this->set('docentes', $this->Docente->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

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
                $perguntas = $this->Pergunta->find('all');
                if (!$perguntas) {
                    $this->Session->setFlash(__('Não foi possivel responder questionario'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    return $this->redirect(array('action' => 'questionarioAdd', $this->Docente->id, true));
                }
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar docente'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

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
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

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

    public function questionarioIndex($docenteId = null) {
        if (!$docenteId) {
            throw new NotFoundException(__('Invalid'));
        }

        $respostas = $this->Docentesresposta->find('all', array(
            'conditions' => array('docente_id' => $docenteId)));
        if (!$respostas) {
            $this->redirect(array('action' => 'questionarioAdd', $docenteId));
        }

        $this->set('respostas', $respostas);
    }

    public function questionarioView($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioAdd($docenteId = null, $first = null) {
        if (!$docenteId) {
            throw new NotFoundException(__('Invalid'));
        }

        $docente = $this->Docente->findById($docenteId);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('docente', $docente);

        $respostas = $this->Docentesresposta->find('all', array(
            'conditions' => array('docente_id' => $docenteId)));
        if ($respostas) {
            $this->set('respostas', $respostas);
        }

        $perguntas = $this->Pergunta->find('all');
        if (!$perguntas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);

        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Docentesresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Docentesresposta->create();
                    } else {
                        $this->Docentesresposta->id = $values['id'];
                    }
                    $this->Docentesresposta->save($values);
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $docenteId));
            } else {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function questionarioEdit($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);

        if ($this->request->is(array('post', 'put'))) {
            $this->Docentesresposta->id = $respostaId;
            if ($this->Docentesresposta->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array(
                            'action' => 'questionarioIndex',
                            $resposta['Docentesresposta']['docente_id']));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $resposta;
        }
    }

    public function questionarioDelete($respostaId = null) {
        if ($this->request->is('get')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Docentesresposta->delete($respostaId)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Docentesresposta']['docente_id']));
    }

}
