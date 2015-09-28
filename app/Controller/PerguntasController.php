<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PerguntasController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Pergunta', 'Tipo');
    public $components = array(
        'Search.Prg',
        'Paginator'
    );
    public $paginate = array(
        'limit' => 12
    );
    public $presetVars = array(
        'pergunta_search' => array('type' => 'value'),
        'tipo_search' => array('type' => 'value')
    );

    public function find() {
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Pergunta->parseCriteria($this->Prg->parsedParams());
        $this->set('perguntas', $this->paginate());
        $tipos = array('' => '--');
        array_push($tipos, $this->Tipo->find('list'));
        $this->set('tipos', $tipos);
    }

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $this->Pergunta->recursive = 0;
        $this->set('perguntas', $this->paginate());
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
        $tipos = $this->Tipo->find('list');
        if (!$tipos) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->set('tipos', $tipos);
        if ($this->request->is('post')) {
            $this->Pergunta->create();
            if ($this->Pergunta->save($this->request->data)) {
                $this->Session->setFlash(__('Pergunta cadastrada'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Nao foi possivel cadastrar pergunta'));
            }
        }
    }

    public function edit($id = null) {
        $tipos = $this->Tipo->find('list');
        if (!$tipos) {
            throw new NotFoundException(__('Invalid'));
        }
        $this->set('tipos', $tipos);
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
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $pergunta;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $pergunta = $this->Pergunta->findById($id);
        if (!$pergunta) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Pergunta->delete($id)) {
            $this->Session->setFlash('Pergunta removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover pergunta');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
