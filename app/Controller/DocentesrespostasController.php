<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DocentesrespostasController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Docentesresposta', 'Docente', 'Pergunta', 'Palavraschave');
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
        $this->set('respostas', $this->Docentesresposta->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($id);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioFind($docenteId = null) {
        $this->Paginator->settings = $this->paginate;
        $this->Prg->commonProcess();

        if (!$docenteId) {
            throw new NotFoundException(__('Invalid'));
        }

        $docente = $this->Docente->findById($docenteId);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from docentesrespostas where docente_id = ' . $docenteId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;

        $conditions = $this->Docentesresposta->parseCriteria($this->Prg->parsedParams());
        $conditions['tipo'] = 'Docente';
        $this->Paginator->settings['conditions'] = $conditions;
        $this->Paginator->settings['contain'] = array(
            'Docentesresposta' =>
            array('conditions' =>
                array('docente_id' => $docenteId)
            )
        );
        $this->Paginator->settings['limit'] = 12;

        $perguntas = $this->paginate('Pergunta');

        $this->set('perguntas', $perguntas);
        $this->set('docente', $docente);
    }

    public function questionarioIndex($docenteId = null) {
        $this->Paginator->settings = $this->paginate;
        if (!$docenteId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Docente->recursive = -1;
        $docente = $this->Docente->findById($docenteId);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Pergunta->virtualFields['status'] = 'CASE WHEN "Pergunta"."id" IN (select pergunta_id from docentesrespostas where docente_id = ' . $docenteId . ') THEN true ELSE false END';
        $this->Pergunta->recursive = 1;
        $this->Paginator->settings['Pergunta'] = array('contain' =>
            array(
                'Docentesresposta' =>
                array('conditions' =>
                    array('docente_id' => $docenteId)
                )
            ),
            'conditions' => array('tipo' => 'Docente'),
            'limit' => 12
        );

        $perguntas = $this->paginate('Pergunta');
        if (!$perguntas) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('perguntas', $perguntas);
        $this->set('docente', $docente);
    }

    public function questionarioView($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);
    }

    public function questionarioAdd($docenteId = null, $perguntaId = null, $first = null) {
        if (!$docenteId) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->Docente->recursive = -1;
        $docente = $this->Docente->findById($docenteId);
        if (!$docente) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('docente', $docente);

        if (!isset($perguntaId) || $first) {
            $respostas = $this->Docentesresposta->find('all', array(
                'conditions' => array('docente_id' => $docenteId)));
            if ($respostas) {
                $this->set('respostas', $respostas);
            }

            $this->Pergunta->recursive = 0;
            $perguntas = $this->Pergunta->find('all', array('conditions' => array('tipo' => 'Docente')));
            if (!$perguntas) {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $perguntas);
        } else {
            $pergunta[0] = $this->Pergunta->findById($perguntaId);
            if (!$pergunta[0] || $pergunta[0]['Tipo']['name'] != 'Docente') {
                throw new NotFoundException(__('Invalid'));
            }

            $this->set('perguntas', $pergunta);
        }
        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data['Docentesresposta'] as $values) {
                if (!empty($values['resposta'])) {
                    if (!isset($values['id'])) {
                        $this->Docentesresposta->create();
                        $response = $this->Docentesresposta->save($values);
                        $this->palavrasAdd($response['Docentesresposta']['id']);
                    } else {
                        $this->Docentesresposta->id = $values['id'];
                        $response = $this->Docentesresposta->save($values);
                        $this->palavrasAdd($response['Docentesresposta']['id']);
                    }
                }
            }
            $this->Session->setFlash(__('Questionario respondido'));

            if (!$first) {
                return $this->redirect(array('action' => 'questionarioIndex', $docenteId));
            } else {
                return $this->redirect(array('action' => 'index', 'controller' => 'Docentes'));
            }
        }
    }

    public function questionarioEdit($respostaId = null) {
        if (!$respostaId) {
            throw new NotFoundException(__('Invalid'));
        }

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('resposta', $resposta);

        if ($this->request->is(array('post', 'put'))) {
            $this->Docentesresposta->id = $respostaId;
            if ($this->Docentesresposta->save($this->request->data)) {
                $this->palavrasAdd($respostaId);
                $this->Session->setFlash(__('Registro alterado'));
                return $this->redirect(array(
                            'action' => 'questionarioIndex',
                            $resposta['Docentesresposta']['docente_id']));
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

        $resposta = $this->Docentesresposta->findById($respostaId);
        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->Docentesresposta->delete($respostaId, true)) {
            $this->Session->setFlash(__('Resposta removida'));
        } else {
            $this->Session->setFlash(__('Não foi possivel remover resposta'));
        }
        return $this->redirect(array(
                    'action' => 'questionarioIndex',
                    $resposta['Docentesresposta']['docente_id']));
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
                    'table' => 'docentes_palavras',
                    'alias' => 'DocentesPalavra',
                    'conditions' => array('DocentesPalavra.palavrachave_id = Palavraschave.id')
                )
            ),
            'conditions' => array(
                'docenteresposta_id' => $respostaId
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

        $this->Docentesresposta->recursive = -1;
        $resposta = $this->Docentesresposta->findById($respostaId);

        if (!$resposta) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->loadModel('Stopword');
        $stopwords = $this->Stopword->find('list', array('fields' => array('compare')));

        $string = trim($resposta['Docentesresposta']['resposta']);
        $compares = array_diff(preg_split("/[ \n\r]+/", $this->Acentos->removeAcentos(utf8_decode($string))), $stopwords);
        $words = preg_split("/[ \n\r]+/", $string);

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
            $this->Docentesresposta->id = $respostaId;
            $this->Docentesresposta->save($resposta);
        }
    }

}
