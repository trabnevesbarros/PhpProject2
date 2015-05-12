<h1>Cadastrar tipo de pergunta</h1>
<?php
echo $this->Form->create('Perguntastipo', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('tipo', array('label' => 'Tipo'));
echo $this->Form->end('Salvar');
