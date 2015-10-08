<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmpregadoresrespostasController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Empregadoresresposta', 'Empregador', 'Pergunta', 'Palavraschave');
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
        $this->set('respostas', $this->Empregadoresresposta->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Empregadoresresposta->findById($id);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioFind($empregadorId = null) {
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();

        if (!$empregadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $empregador = $this->Empregador->findById($empregadorId);
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from empregadoresrespostas where empregador_id = ' . $empregadorId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;

        $conditions = $this->Empregadoresresposta->parseCriteria($this->Prg->parsedParams());
        $conditions['tipo'] = 'Empregador';
        $this->Paginator->settings['conditions'] = $conditions;
        $this->Paginator->settings['contain'] = array(
            'Empregadoresresposta' =>
            array('conditions' =>
                array('empregador_id' => $empregadorId)
            )
        );
        $this->Paginator->settings['limit'] = 12;

        $perguntas = $this->paginate('Pergunta');

        $this->set('perguntas', $perguntas);
        $this->set('empregador', $empregador);
    }

    public function questionarioIndex($empregadorId = null) {
        $this->Paginator->settings = $this->paginate;
        if (!$empregadorId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Empregador->recursive = -1;
        $empregador = $this->Empregador->findById($empregadorId);
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from empregadoresrespostas where empregador_id = ' . $empregadorId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;
        $this->Paginator->settings['Pergunta'] = array('contain' =>
            array(
                'Empregadoresresposta' =>
                array('conditions' =>
                    array('empregador_id' => $empregadorId)
                )
            ),
            'conditions' => array('tipo' => 'Empregador'),
            'limit' => 12
        );

        $perguntas = $this->paginate('Pergunta');
        if (!$perguntas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);
        $this->set('empregador', $empregador);
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

        $this->Empregador->recursive = -1;
        $empregador = $this->Empregador->findById($empregadorId);
        if (!$empregador) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('empregador', $empregador);

        if (!isset($perguntaId) || $first) {
            $respostas = $this->Empregadoresresposta->find('all', array(
                'conditions' => array('empregador_id' => $empregadorId)));
            if ($respostas) {
                $this->set('respostas', $respostas);
            }

            $this->Pergunta->recursive = 0;
            $perguntas = $this->Pergunta->find('all', array('conditions' => array('tipo' => 'Empregador')));
            if (!$perguntas) {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $perguntas);
        } else {
            $pergunta[0] = $this->Pergunta->findById($perguntaId);
            if (!$pergunta[0] || $pergunta[0]['Tipo']['name'] != 'Empregador') {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $pergunta);
        }
        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Empregadoresresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Empregadoresresposta->create();
                        $response = $this->Empregadoresresposta->save($values);
                        $this->palavrasAdd($response['Empregadoresresposta']['id']);
                    } else {
                        $this->Empregadoresresposta->id = $values['id'];
                        $response = $this->Empregadoresresposta->save($values);
                        $this->palavrasAdd($response['Empregadoresresposta']['id']);
                    }
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $empregadorId));
            } else {
                return $this->redirect(array('action' => 'index', 'controller' => 'Empregadores'));
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
                $this->palavrasAdd($respostaId);
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

        if ($this->Empregadoresresposta->delete($respostaId, true)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Empregadoresresposta']['empregador_id']));
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
                    'table' => 'empregadores_palavras',
                    'alias' => 'EmpregadoresPalavra',
                    'conditions' => array('EmpregadoresPalavra.palavrachave_id = Palavraschave.id')
                )
            ),
            'conditions' => array(
                'empregadorresposta_id' => $respostaId
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

        $this->Empregadoresresposta->recursive = -1;
        $resposta = $this->Empregadoresresposta->findById($respostaId);

        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->loadModel('Stopword');
        $stopwords = $this->Stopword->find('list', array('fields' => array('compare')));

        $string = strtolower(trim($resposta['Empregadoresresposta']['resposta']));
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
            $resposta['Palavraschave'] = array_unique($palavraIds);
            $this->Empregadoresresposta->id = $respostaId;
            $this->Empregadoresresposta->save($resposta);
        }
    }

}
