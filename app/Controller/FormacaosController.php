<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormacaosController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Formacao', 'Tipo');

    public function index() {
        $this->set('formacaos', $this->Formacao->query('SELECT "Formacao"."id" AS "Formacao__id", "Formacao"."name" AS "Formacao__name", "Formacao"."tipo_id" AS "Formacao__tipo_id" FROM "public"."formacaos" AS "Formacao" WHERE 1 = 1'));
        //$this->set('formacaos', $this->Formacao->find('all');
        $this->set('tipos', $this->Tipo->query('SELECT "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."tipos" AS "Tipo" WHERE 1 = 1'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $formacao = $this->Formacao->query('SELECT "Formacao"."id" AS "Formacao__id", "Formacao"."name" AS "Formacao__name", "Formacao"."tipo_id" AS "Formacao__tipo_id" FROM "public"."formacaos" AS "Formacao" WHERE "Formacao"."id" = '.$id.' LIMIT 1');
        //$this->Formacao->findById($id);
        if (!$formacao) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('formacao', $formacao[0]);
    }

    public function add() {
        $tipos = $this->Tipo->find('list');
        if (!$tipos) {
            throw new NotFountException(__('Invalid'));
        }
        $this->set('tipos', $tipos);
        
        if ($this->request->is('post')) {
            $this->Formacao->create();
            if ($this->Formacao->save($this->request->data)) {
                $this->Session->setFlash(__('Formacao cadastrado'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar Formação'));
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function edit($id = NULL) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $formacao = $this->Formacao->query('SELECT "Formacao"."id" AS "Formacao__id", "Formacao"."name" AS "Formacao__name", "Formacao"."tipo_id" AS "Formacao__tipo_id" FROM "public"."formacaos" AS "Formacao" WHERE "Formacao"."id" = '.$id.' LIMIT 1');
                //$formacao = $this->Formacao->findById($id);

        if (!isset($formacao)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Formacao->id = $id;
            if ($this->Formacao->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $formacao;
        }
       
    }

    public function delete($id = NULL) {

        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $formacao = $this->Formacao->findById($id);

        if (!isset($formacao)) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Formacao->delete($id)) {
            $this->Session->setFlash(__('Formação removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover Formações'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
