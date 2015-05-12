<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrabalhadoresController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Trabalhador', 'Pergunta', 'Trabalhadoresresposta');

    public function index() {
        $this->set('perguntas', $this->Pergunta->find('all'));
        $this->set('trabalhadores', $this->Trabalhador->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $trabalhador = $this->Trabalhador->findById($id);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('trabalhador', $trabalhador);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Trabalhador->create();
            if ($this->Trabalhador->save($this->request->data)) {
                $this->Session->setFlash(__('Trabalhador cadastrado'));
                $perguntas = $this->Pergunta->find('all');
                if (!$perguntas) {
                    $this->Session->setFlash(__('Não foi possivel responder questionario'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    return $this->redirect(array('action' => 'questionarioAdd', $this->Trabalhador->id, true));
                }
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar trabalhador'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $trabalhador = $this->Trabalhador->findById($id);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Trabalhador->id = $id;
            if ($this->Trabalhador->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $trabalhador;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $trabalhador = $this->Trabalhador->findById($id);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Trabalhador->delete($id)) {
            $this->Session->setFlash(__('Trabalhador removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover trabalhador'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function questionarioIndex($trabalhadorId = null) {
        if (!$trabalhadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('trabalhadorId', $trabalhadorId);

        $respostas = $this->Trabalhadoresresposta->find('all', array(
            'conditions' => array('trabalhador_id' => $trabalhadorId)));
        if (!$respostas) {
            $this->redirect(array('action' => 'questionarioAdd', $trabalhadorId));
        }

        $this->set('respostas', $respostas);
    }

    public function questionarioView($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Trabalhadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioAdd($trabalhadorId = null, $first = null) {
        if (!$trabalhadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $trabalhador = $this->Trabalhador->findById($trabalhadorId);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('trabalhador', $trabalhador);

        $respostas = $this->Trabalhadoresresposta->find('all', array(
            'conditions' => array('trabalhador_id' => $trabalhadorId)));
        if ($respostas) {
            $this->set('respostas', $respostas);
        }

        $perguntas = $this->Pergunta->find('all');
        if (!$perguntas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);

        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Trabalhadoresresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Trabalhadoresresposta->create();
                    } else {
                        $this->Trabalhadoresresposta->id = $values['id'];
                    }
                    $this->Trabalhadoresresposta->save($values);
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $trabalhadorId));
            } else {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function questionarioEdit($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Trabalhadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $resposta['Pergunta'];
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Trabalhadoresresposta->id = $respostaId;
            if ($this->Trabalhadoresresposta->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array(
                            'action' => 'questionarioIndex',
                            $resposta['Trabalhadoresresposta']['trabalhador_id']));
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

        $resposta = $this->Trabalhadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Trabalhadoresresposta->delete($respostaId)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Trabalhadoresresposta']['trabalhador_id']));
    }

}
