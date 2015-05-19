<h1>Cadastrar tipo de pergunta</h1>
<?php
echo $this->Form->create('Tipo', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Tipo'));
echo $this->Form->end('Salvar');
