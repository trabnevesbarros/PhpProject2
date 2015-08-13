<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PerguntasController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Pergunta', 'Tipo');
    public $paginate = array(
        'limit' => 12
    );
    public $components = array(
        'Search.Prg',
        'Paginator'
    );
    public $presetVars = array('pergunta_search' => array('type' => 'value'));

    function find() {
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Pergunta->parseCriteria($this->Prg->parsedParams());
        $this->set('Perguntas', $this->paginate());
    }

    public function index() {
        $this->Pergunta->virtualFields['tipo'] = 'select name from tipos where id = "Pergunta"."tipo_id"';
        $this->Pergunta->recursive = -1;
        $this->set('perguntas', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Pergunta"."id" = ' . $id . ' LIMIT 1');
        //$this->Pergunta->findById($id)^
        if (!isset($pergunta[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('pergunta', $pergunta[0]);
    }

    public function add() {
        $tipos = $this->Tipo->find('list');
        if (!$tipos) {
            throw new NotFountException(__('Invalid'));
        }
        $this->set('tipos', $tipos);

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

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Pergunta"."id" = ' . $id . ' LIMIT 1');
        //$this->Pergunta->findById($id)^
        if (!isset($pergunta[0])) {
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
            $this->request->data = $pergunta[0];
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Pergunta"."id" = ' . $id . ' LIMIT 1');
        //$this->Pergunta->findById($id)^
        if (!isset($pergunta[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Pergunta->delete($id)) {
            $this->Session->setFlash(__('Pergunta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover pergunta'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
