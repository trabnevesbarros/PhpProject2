<h1>Cadastrar Tipo</h1>
<?php

echo $this->Form->create('Tipo', array('inputDefaults' => array('type' => 'text')));

echo $this->Form->input('name', array('label' => 'Nome'));

echo $this->Form->end('Salvar');
