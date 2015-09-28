<h1>Cadastrar Area</h1>
<?php

echo $this->Form->create('Area', array('inputDefaults' => array('type' => 'text')));

echo $this->Form->input('name', array('label' => 'Nome'));

echo $this->Form->end('Salvar');
