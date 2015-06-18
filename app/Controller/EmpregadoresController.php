<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmpregadoresController extends AppController {

    public $helpers = array('Html', 'Form');
    public $uses = array('Empregador', 'Pergunta', 'Empregadoresresposta');

    public function index() {
        $this->set('perguntas', $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Tipo"."name" = \'Empregador\' '));
        //$this->Pergunta->find('all'), (onde tipo.name = Empregador)^
        $this->set('empregadores', $this->Empregador->query('	SELECT "Empregador"."id" AS "Empregador__id", "Empregador"."nome" AS "Empregador__nome", "Empregador"."cargo" AS "Empregador__cargo", "Empregador"."palavras" AS "Empregador__palavras", "Empregador"."formacao" AS "Empregador__formacao" FROM "public"."empregadores" AS "Empregador" WHERE 1 = 1'));
        //$this->Empregador->find('all')^
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $empregador = $this->Empregador->query('SELECT "Empregador"."id" AS "Empregador__id", "Empregador"."nome" AS "Empregador__nome", "Empregador"."cargo" AS "Empregador__cargo", "Empregador"."palavras" AS "Empregador__palavras", "Empregador"."formacao" AS "Empregador__formacao" FROM "public"."empregadores" AS "Empregador" WHERE "Empregador"."id" = '.$id.' LIMIT 1');
        //$this->Empregador->findById($id)^
        if (!isset($empregador[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('empregador', $empregador[0]);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Empregador->create();
            if ($this->Empregador->save($this->request->data)) {
                $this->Session->setFlash(__('Empregador cadastrado'));
                $perguntas = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Tipo"."name" = \'Empregador\'');
                //$this->Pergunta->find('all'), (onde tipo.name = Empregador)^
                if (isset($perguntas[0])) {
                    return $this->redirect(array('action' => 'questionarioAdd', $this->Empregador->id, 0, true));
                }
                $this->Session->setFlash(__('Não foi possivel responder questionario'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel cadastrar empregador'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $empregador = $this->Empregador->query('SELECT "Empregador"."id" AS "Empregador__id", "Empregador"."nome" AS "Empregador__nome", "Empregador"."cargo" AS "Empregador__cargo", "Empregador"."palavras" AS "Empregador__palavras", "Empregador"."formacao" AS "Empregador__formacao" FROM "public"."empregadores" AS "Empregador" WHERE "Empregador"."id" = '.$id.' LIMIT 1');
        //$this->Empregador->findById($id)^
        if (!isset($empregador[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Empregador->id = $id;
            if ($this->Empregador->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $empregador[0];
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $empregador = $this->Empregador->query('SELECT "Empregador"."id" AS "Empregador__id", "Empregador"."nome" AS "Empregador__nome", "Empregador"."cargo" AS "Empregador__cargo", "Empregador"."palavras" AS "Empregador__palavras", "Empregador"."formacao" AS "Empregador__formacao" FROM "public"."empregadores" AS "Empregador" WHERE "Empregador"."id" = '.$id.' LIMIT 1');
        //$this->Empregador->findById($id)^
        if (!isset($empregador[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Empregador->delete($id)) {
            $this->Session->setFlash(__('Empregador removido'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover empregador'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function questionarioIndex($empregadorId = null) {
        if (!$empregadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $respostas = $this->Empregadoresresposta->find('all', array(
            'conditions' => array('empregador_id' => $empregadorId)));
        if (!$respostas) {
            $this->redirect(array('action' => 'questionarioAdd', $empregadorId));
        }

        $this->set('respostas', $respostas);

        $perguntas = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Tipo"."name" = \'Empregador\' ');
        //$this->Pergunta->find('all'), (onde tipo.name = Empregador)^
        if (!isset($perguntas[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);
    }

    public function questionarioView($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Empregadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioAdd($empregadorId = null, $perguntaId = null, $first = null) {
        if (!$empregadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $empregador = $this->Empregador->query('SELECT "Empregador"."id" AS "Empregador__id", "Empregador"."nome" AS "Empregador__nome", "Empregador"."cargo" AS "Empregador__cargo", "Empregador"."palavras" AS "Empregador__palavras", "Empregador"."formacao" AS "Empregador__formacao" FROM "public"."empregadores" AS "Empregador" WHERE "Empregador"."id" = '.$empregadorId.' LIMIT 1');
        //$this->Empregador->findById($empregadorId)^
        if (!isset($empregador[0])) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('empregador', $empregador[0]);

        if (!isset($perguntaId) || $first) {
            $respostas = $this->Empregadoresresposta->find('all', array(
                'conditions' => array('empregador_id' => $empregadorId)));
            if ($respostas) {
                $this->set('respostas', $respostas);
            }

            $perguntas = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Tipo"."name" = \'Empregador\' ');
            //$this->Pergunta->find('all'), (onde tipo.name = Empregador)^
            if (!isset($perguntas[0])) {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $perguntas);
        } else {
            $perguntas = $this->Pergunta->query('SELECT "Pergunta"."id" AS "Pergunta__id", "Pergunta"."pergunta" AS "Pergunta__pergunta", "Pergunta"."tipo_id" AS "Pergunta__tipo_id", "Tipo"."id" AS "Tipo__id", "Tipo"."name" AS "Tipo__name" FROM "public"."perguntas" AS "Pergunta" LEFT JOIN "public"."tipos" AS "Tipo" ON ("Pergunta"."tipo_id" = "Tipo"."id") WHERE "Pergunta"."id" = '.$perguntaId.' LIMIT 1');
            //$this->Pergunta->findById($id)^
            if (!isset($perguntas[0]) || $perguntas[0]['Tipo']['name'] != 'Empregador') {
                throw new NotFoundException(__('Invalid'));
            }
            
            $this->set('perguntas', $perguntas);
        }
        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Empregadoresresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Empregadoresresposta->create();
                    } else {
                        $this->Empregadoresresposta->id = $values['id'];
                    }
                    $this->Empregadoresresposta->save($values);
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $empregadorId));
            } else {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function questionarioEdit($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Empregadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);

        if ($this->request->is(array('post', 'put'))) {
            $this->Empregadoresresposta->id = $respostaId;
            if ($this->Empregadoresresposta->save($this->request->data)) {
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array(
                            'action' => 'questionarioIndex',
                            $resposta['Empregadoresresposta']['empregador_id']));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $resposta;
        }
    }

    public function questionarioDelete($respostaId = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Empregadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Empregadoresresposta->delete($respostaId)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Empregadoresresposta']['empregador_id']));
    }

}
