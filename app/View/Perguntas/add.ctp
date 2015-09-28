<h1>Cadastrar Pergunta</h1>
<?php

echo $this->Form->create('Pergunta', array('inputDefaults' => array('type' => 'text')));

echo $this->Form->input('pergunta', array('label' => 'Pergunta'));

echo $this->Form->input('tipo_id', array('type' => 'select', 'label' => 'Tipo', 'options' => $tipos));

echo $this->Form->end('Salvar');
