<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PalavraschavesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array(
        'Search.Prg',
        'Paginator',
        'Acentos'
    );
    public $presetVars = array('palavra_search' => array('type' => 'value'));
    
    public $uses = array('Palavraschave','Pergunta', 'Tipo', 'Docentesresposta', 'Empregadoresresposta', 'Trabalhadoresresposta');
    public $paginate = array(
        'limit' => 12,
    );

    public function find() {         
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Palavraschave->parseCriteria($this->Prg->parsedParams());
        $this->Palavraschave->recursive = -1;        
        $this->set('palavraschaves', $this->paginate());
    }
    
    public function index() {
        $this->Paginator->settings = $this->paginate;
        $this->Palavraschave->recursive = -1;        
        $this->set('palavraschaves', $this->paginate());
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
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Palavraschave->create();
            $data = $this->request->data;
            $data['Palavraschave']['palavra'] = preg_split("/\P{L}+/u", $data['Palavraschave']['palavra'])[0];
            $data['Palavraschave']['compare'] = $this->Acentos->removeAcentos(utf8_decode($data['Palavraschave']['palavra']));
            if ($this->Palavraschave->save($data)) {
                $this->Session->setFlash('Palavraschave cadastrado');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Não foi possivel cadastrar palavra chave');
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
            $data['Palavraschave']['palavra'] = preg_split("/\P{L}+/u", $data['Palavraschave']['palavra'])[0];
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
    
    public function docenteRespostas($palavraId = null) {
        if (!$palavraId) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->recursive = -1;
        $palavra = $this->Palavraschave->findById($palavraId);
        
        if (!$palavra) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->DocentesPalavra->bindModel(
            array('belongsTo' => array(
                'Docentesresposta' => array(
                    'foreignKey' => 'docenteresposta_id'
                )
            ))
        );
        
        $this->Paginator->settings['DocentesPalavra'] = array(
            'contain' => array(
                'Docentesresposta'
            ),
            'limit' => 12,
            'conditions' => array('DocentesPalavra.palavrachave_id' => $palavraId)
        );
        
        $docentesrespostas = $this->paginate('DocentesPalavra');
        
        foreach ($docentesrespostas as $key => $docentesresposta) {
            $docentesrespostas[$key] = $docentesresposta['Docentesresposta'];
        }
        
        $this->set('palavra', $palavra['Palavraschave']);
        $this->set('docentesrespostas', $docentesrespostas);
    }
    
    public function trabalhadorRespostas($palavraId = null) {
        if (!$palavraId) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->recursive = -1;
        $palavra = $this->Palavraschave->findById($palavraId);
        
        if (!$palavra) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->TrabalhadoresPalavra->bindModel(
            array('belongsTo' => array(
                'Trabalhadoresresposta' => array(
                    'foreignKey' => 'trabalhadorresposta_id'
                )
            ))
        );
        
        $this->Paginator->settings['TrabalhadoresPalavra'] = array(
            'contain' => array(
                'Trabalhadoresresposta'
            ),
            'limit' => 12,
            'conditions' => array('TrabalhadoresPalavra.palavrachave_id' => $palavraId)
        );
        
        $trabalhadoresrespostas = $this->paginate('TrabalhadoresPalavra');
        
        foreach ($trabalhadoresrespostas as $key => $trabalhadoresresposta) {
            $trabalhadoresrespostas[$key] = $trabalhadoresresposta['Trabalhadoresresposta'];
        }
        
        $this->set('palavra', $palavra['Palavraschave']);
        $this->set('trabalhadoresrespostas', $trabalhadoresrespostas);
    }
    
    public function empregadorRespostas($palavraId = null) {
        if (!$palavraId) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->recursive = -1;
        $palavra = $this->Palavraschave->findById($palavraId);
        
        if (!$palavra) {
            throw new NotFoundException(__('Invalid'));
        }
        
        $this->Palavraschave->EmpregadoresPalavra->bindModel(
            array('belongsTo' => array(
                'Empregadoresresposta' => array(
                    'foreignKey' => 'empregadorresposta_id'
                )
            ))
        );
        
        $this->Paginator->settings['EmpregadoresPalavra'] = array(
            'contain' => array(
                'Empregadoresresposta'
            ),
            'limit' => 12,
            'conditions' => array('EmpregadoresPalavra.palavrachave_id' => $palavraId)
        );
        
        $empregadoresrespostas = $this->paginate('EmpregadoresPalavra');
        
        foreach ($empregadoresrespostas as $key => $empregadoresresposta) {
            $empregadoresrespostas[$key] = $empregadoresresposta['Empregadoresresposta'];
        }
        
        $this->set('palavra', $palavra['Palavraschave']);
        $this->set('empregadoresrespostas', $empregadoresrespostas);
    }

}
