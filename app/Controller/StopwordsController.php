<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StopwordsController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Acentos');
    public $paginate = array(
        'limit' => 12
    );

    public function index() {
        $conditions = array();

        if (($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])) {
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;

            foreach ($this->data['Filter'] as $name => $value) {
                if ($value) {
                    $filter_url[$name] = urlencode($value);
                }
            }

            return $this->redirect($filter_url);
        } else {
            foreach ($this->params['named'] as $param_name => $value) {
                if (!in_array($param_name, array('page', 'sort', 'direction', 'limit'))) {
                    if ($param_name == "search") {
                        $conditions['OR'] = array(
                            array('Stopword.termo LIKE' => '%' . $value . '%')
                        );
                    } else {
                        $conditions['Stopword.' . $param_name] = $value;
                    }
                    $this->request->data['Filter'][$param_name] = $value;
                }
            }
        }
        
        $this->paginate = array('conditions' => $conditions);

        $this->set('stopwords', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $stopword = $this->Stopword->findById($id);
        if (!$stopword) {
            throw new NotFoundException(__('Invalid'));
        }

        $this->set('stopword', $stopword);
    }

    public function add() {
        if ($this->request->is('post')) {
            if (empty($this->request->data)) {
                $this->Session->setFlash('Não foi possivel cadastrar stop words');
            } else {
                $rows = preg_split("/[ \n\r]+/", trim($this->request->data['Stopword']['termos']));
                foreach ($rows as $row) {
                    $data = array('Stopword' => array('termo' => $row, 'compare' => $this->Acentos->removeAcentos(utf8_decode($row))));
                    $this->Stopword->create();
                    if (!$this->Stopword->save($data)) {
                        $this->Session->setFlash('Não foi possivel cadastrar stop word');
                    }
                }
                $this->Session->setFlash('Stop words cadastradas');
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid'));
        }

        $stopword = $this->Stopword->findById($id);
        if (!$stopword) {
            throw new NotFoundException(__('Invalid'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Stopword->id = $id;
            if ($this->Stopword->save($this->request->data)) {
                $this->Session->setFlash('Registro alterado');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $stopword;
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new UnauthorizedException(__('Not allowed'));
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        $stopword = $this->Stopword->findById($id);
        if (!$stopword) {
            throw new NotFoundException(__('Invalid id'));
        }

        if ($this->Stopword->delete($id)) {
            $this->Session->setFlash('Stop word removida');
        } else {
            $this->Session->setFlash('Não foi possivel remover stop word');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
