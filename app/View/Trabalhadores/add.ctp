<h1>Cadastrar trabalhador</h1>
<?php
echo $this->Form->create('Trabalhador', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('nome', array('label' => 'Nome'));
echo $this->Form->input('ocupacao_id', array('label' => 'Ocupação', 'type' => 'select', 'options' => $ocupacoes));
echo $this->Form->input('Formacao', array('label' => 'Formação', 'type' => 'select', 'multiple' => true, 'options' => $formacoes));
echo $this->Form->input('tempo_atuacao', array('label' => 'Tempo de atuação'));
echo $this->form->input('Trabalhador.id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
