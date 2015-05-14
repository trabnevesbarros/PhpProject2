<h1>Cadastrar pergunta</h1>
<?php
echo $this->Form->create('Pergunta', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('perguntastipo_id', array('type' => 'select', 'label' => 'Tipo', 'options' => $perguntastipos, 'empty' => '(Selecionar um)'));
echo $this->Form->input('pergunta', array('label' => 'Pergunta', 'rows' => 3));
echo $this->Form->end('Salvar');
