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
        $this->set('perguntastipos', $this->Perguntastipo->query('SELECT "Perguntastipo"."id" AS "Perguntastipo__id", "Perguntastipo"."name" AS "Perguntastipo__name" FROM "public"."perguntastipos" AS "Perguntastipo" WHERE 1 = 1'));
        //$this->Perguntastipos->find('all')^
        $this->set('perguntas', $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."perguntastipo_id" AS "Pergunta__perguntastipo_id", "Perguntastipo"."id" AS "Perguntastipo__id", "Perguntastipo"."name" AS "Perguntastipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."perguntastipos" AS "Perguntastipo" ON ("Pergunta"."perguntastipo_id" = "Perguntastipo"."id") WHERE 1 = 1'));
        //$this->Perguntas->find('all')^
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."perguntastipo_id" AS "Pergunta__perguntastipo_id", "Perguntastipo"."id" AS "Perguntastipo__id", "Perguntastipo"."name" AS "Perguntastipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."perguntastipos" AS "Perguntastipo" ON ("Pergunta"."perguntastipo_id" = "Perguntastipo"."id") WHERE "Pergunta"."id" = '.$id.' LIMIT 1');
        //$this->Pergunta->findById($id)^
        if (!isset($pergunta[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('pergunta', $pergunta[0]);
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

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."perguntastipo_id" AS "Pergunta__perguntastipo_id", "Perguntastipo"."id" AS "Perguntastipo__id", "Perguntastipo"."name" AS "Perguntastipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."perguntastipos" AS "Perguntastipo" ON ("Pergunta"."perguntastipo_id" = "Perguntastipo"."id") WHERE "Pergunta"."id" = '.$id.' LIMIT 1');
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
            throw new NotAllowedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $pergunta = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."perguntastipo_id" AS "Pergunta__perguntastipo_id", "Perguntastipo"."id" AS "Perguntastipo__id", "Perguntastipo"."name" AS "Perguntastipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."perguntastipos" AS "Perguntastipo" ON ("Pergunta"."perguntastipo_id" = "Perguntastipo"."id") WHERE "Pergunta"."id" = '.$id.' LIMIT 1');
        //$this->Pergunta->findById($id)^
        if (!isset($pergunta[0])) {
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
