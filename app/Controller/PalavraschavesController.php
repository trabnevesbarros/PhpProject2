<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PalavraschavesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Palavraschave', 'Pergunta', 'Tipo', 'Docentesresposta', 'Empregadoresresposta', 'Trabalhadoresresposta');
    public $components = array('Acentos');
 
    public function index() {
        $this->Palavraschave->recursive = -1;
        $this->set('palavraschaves', $this->Palavraschave->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Palavraschave->recursive = -1;
        $palavraschave = $this->Palavraschave->findById($id);
        if (!$palavraschave) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('palavraschave', $palavraschave);

        //$this->autoDelete($id);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Palavraschave->create();
            $data = $this->request->data;
            $data['Palavraschave']['palavra'] = preg_split("/[ \n\r]+/", $data['Palavraschave']['palavra'])[0];
            $data['Palavraschave']['compare'] = $this->Acentos->removeAcentos(utf8_decode($data['Palavraschave']['palavra']));
            if ($this->Palavraschave->save($data)) {
                $this->Session->setFlash('Palavraschave cadastrado');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Não foi possivel cadastrar palavra chave');
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Palavraschave->recursive = -1;
        $palavraschave = $this->Palavraschave->findById($id);
        if (!$palavraschave) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Palavraschave->id = $id;
            $data = $this->request->data;
            $data['Palavraschave']['palavra'] = preg_split("/[ \n\r]+/", $data['Palavraschave']['palavra'])[0];
            $data['Palavraschave']['compare'] = $this->Acentos->removeAcentos(utf8_decode($data['Palavraschave']['palavra']));
            if ($this->Palavraschave->save($data)) {
                $this->Session->setFlash('Registro Alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $palavraschave;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Palavraschave->recursive = -1;
        $palavraschave = $this->Palavraschave->findById($id);
        if (!$palavraschave) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Palavraschave->delete($id)) {
            $this->Session->setFlash('Palavra chave removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover palavra chave');
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function respostasIndex($palavraId) {
        if (!$palavraId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Palavraschave->recursive = 1;

        $palavra = $this->Palavraschave->find('all', array(
                    'fields' => array('Palavraschave.id', 'Palavraschave.palavra'),
                    'conditions' => array('Palavraschave.id' => $palavraId)
                ))[0];

        if (!$palavra) {
            throw new NotFoundException(__('Invalid'));
        }

        $palavra_respostas = null;

        foreach ($palavra as $key => $respostas) {
            if ($key != 'Palavraschave') {
                foreach ($respostas as $resposta) {
                    $palavra_respostas[] = $resposta;
                }
            }
        }

        if (!$palavra_respostas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->recursive = 0;
        foreach ($palavra_respostas as $key => $resposta) {
            $pergunta = $this->Pergunta->findById($resposta['pergunta_id']);
            $palavra_respostas[$key]['Pergunta'] = $pergunta['Pergunta'];
            $palavra_respostas[$key]['Tipo'] = $pergunta['Tipo'];
        }

        $this->set('palavra', $palavra['Palavraschave']);
        $this->set('palavra_respostas', $palavra_respostas);
    }

}
