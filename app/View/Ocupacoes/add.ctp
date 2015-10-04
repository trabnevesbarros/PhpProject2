<h1>Cadastrar Ocupação</h1>
<?php

echo $this->Form->create('Ocupacao', array('inputDefaults' => array('type' => 'text')));

echo $this->Form->input('name', array('label' => 'Nome'));

echo $this->Form->end('Salvar');
