<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrabalhadoresrespostasController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Trabalhadoresresposta', 'Trabalhador', 'Pergunta', 'Palavraschave');
    public $components = array(
        'Search.Prg',
        'Paginator',
        'Acentos'
    );
    public $paginate = array(
        'limit' => 12
    );
    public $presetVars = array('pergunta_search' => array('type' => 'value'));

    public function index() {         
        $this->Paginator->settings = $this->paginate;
        $this->set('respostas', $this->Trabalhadoresresposta->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Trabalhadoresresposta->findById($id);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioFind($trabalhadorId = null) {
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();

        if (!$trabalhadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $trabalhador = $this->Trabalhador->findById($trabalhadorId);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from trabalhadoresrespostas where trabalhador_id = ' . $trabalhadorId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;

        $conditions = $this->Trabalhadoresresposta->parseCriteria($this->Prg->parsedParams());
        $conditions['tipo'] = 'Trabalhador';
        $this->Paginator->settings['conditions'] = $conditions;
        $this->Paginator->settings['contain'] = array(
            'Trabalhadoresresposta' =>
            array('conditions' =>
                array('trabalhador_id' => $trabalhadorId)
            )
        );
        $this->Paginator->settings['limit'] = 12;

        $perguntas = $this->paginate('Pergunta');

        $this->set('perguntas', $perguntas);
        $this->set('trabalhador', $trabalhador);
    }

    public function questionarioIndex($trabalhadorId = null) {
        $this->Paginator->settings = $this->paginate;
        if (!$trabalhadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhador->recursive = -1;
        $trabalhador = $this->Trabalhador->findById($trabalhadorId);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from trabalhadoresrespostas where trabalhador_id = ' . $trabalhadorId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;
        $this->Paginator->settings['Pergunta'] = array('contain' =>
            array(
                'Trabalhadoresresposta' =>
                array('conditions' =>
                    array('trabalhador_id' => $trabalhadorId)
                )
            ),
            'conditions' => array('tipo' => 'Trabalhador'),
            'limit' => 12
        );

        $perguntas = $this->paginate('Pergunta');
        if (!$perguntas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);
        $this->set('trabalhador', $trabalhador);
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

    public function questionarioAdd($trabalhadorId = null, $perguntaId = null, $first = null) {
        if (!$trabalhadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhador->recursive = -1;
        $trabalhador = $this->Trabalhador->findById($trabalhadorId);
        if (!$trabalhador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('trabalhador', $trabalhador);

        if (!isset($perguntaId) || $first) {
            $respostas = $this->Trabalhadoresresposta->find('all', array(
                'conditions' => array('trabalhador_id' => $trabalhadorId)));
            if ($respostas) {
                $this->set('respostas', $respostas);
            }

            $this->Pergunta->recursive = 0;
            $perguntas = $this->Pergunta->find('all', array('conditions' => array('tipo' => 'Trabalhador')));
            if (!$perguntas) {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $perguntas);
        } else {
            $pergunta[0] = $this->Pergunta->findById($perguntaId);
            if (!$pergunta[0] || $pergunta[0]['Tipo']['name'] != 'Trabalhador') {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $pergunta);
        }
        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Trabalhadoresresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Trabalhadoresresposta->create();
                        $response = $this->Trabalhadoresresposta->save($values);
                        $this->palavrasAdd($response['Trabalhadoresresposta']['id']);
                    } else {
                        $this->Trabalhadoresresposta->id = $values['id'];
                        $response = $this->Trabalhadoresresposta->save($values);
                        $this->palavrasAdd($response['Trabalhadoresresposta']['id']);
                    }
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $trabalhadorId));
            } else {
                return $this->redirect(array('action' => 'index', 'controller' => 'Trabalhadores'));
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

        $this->set('resposta', $resposta);

        if ($this->request->is(array('post', 'put'))) {
            $this->Trabalhadoresresposta->id = $respostaId;
            if ($this->Trabalhadoresresposta->save($this->request->data)) {
                $this->palavrasAdd($respostaId);
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
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Trabalhadoresresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Trabalhadoresresposta->delete($respostaId, true)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Trabalhadoresresposta']['trabalhador_id']));
    }

    public function palavrasIndex($respostaId) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Palavraschave->recursive = -1;
        $this->Paginator->settings['Palavraschave'] = array(
            'paramType' => 'querystring',
            'limit' => 12,
            'joins' => array(
                array(
                    'type' => 'INNER',
                    'table' => 'trabalhadores_palavras',
                    'alias' => 'TrabalhadoresPalavra',
                    'conditions' => array('TrabalhadoresPalavra.palavrachave_id = Palavraschave.id')
                )
            ),
            'conditions' => array(
                'trabalhadorresposta_id' => $respostaId
            )
        );

        $palavras = $this->paginate('Palavraschave');

        if (!$palavras) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('palavras', $palavras);
    }

    public function palavrasAdd($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Trabalhadoresresposta->recursive = -1;
        $resposta = $this->Trabalhadoresresposta->findById($respostaId);

        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->loadModel('Stopword');
        $stopwords = $this->Stopword->find('list', array('fields' => array('compare')));

        $string = strtolower(trim($resposta['Trabalhadoresresposta']['resposta']));
        $compares = array_diff(preg_split("/\P{L}+/u", $this->Acentos->removeAcentos($string)), $stopwords);
        $words = preg_split("/\P{L}+/u", $string);

        //similar_text($string2, $string1, $percent));

        $this->Palavraschave->recursive = -1;
        $palavraIds = array();
        foreach ($compares as $i => $compare) {
            $palavra = $this->Palavraschave->findByCompare($compare);
            if (!$palavra) {
                $this->Palavraschave->create();
                $values = array('Palavraschave' => array('palavra' => $words[$i], 'compare' => $compare));
                $palavra = $this->Palavraschave->save($values);
            }
            $palavraIds[] = $palavra['Palavraschave']['id'];
        }

        if (!empty($palavraIds)) {
            $resposta['Palavraschave']['Palavraschave'] = array_unique($palavraIds);
            $this->Trabalhadoresresposta->id = $respostaId;
            $this->Trabalhadoresresposta->save($resposta);
        }
    }
    public function teste() {
        set_time_limit(999999999);
        $respostas = $this->Trabalhadoresresposta->find('all');
        foreach($respostas as $resposta) {
            $this->palavrasAdd($resposta['Trabalhadoresresposta']['id']);
        }
    }

}
