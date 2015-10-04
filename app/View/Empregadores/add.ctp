<h1>Cadastrar empregador</h1>
<?php
echo $this->Form->create('Empregador', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('nome', array('label' => 'Nome'));
echo $this->Form->input('cargo_id', array('label' => 'Área', 'type' => 'select', 'options' => $cargos));
echo $this->Form->input('Formacao', array('label' => 'Formação', 'type' => 'select', 'multiple' => true, 'options' => $formacoes));
echo $this->Form->input('tempo_atuacao', array('label' => 'Tempo de atuação'));
echo $this->form->input('Empregador.id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
