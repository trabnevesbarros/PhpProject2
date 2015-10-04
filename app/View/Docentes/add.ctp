<h1>Cadastrar docente</h1>
<?php
echo $this->Form->create('Docente', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('nome', array('label' => 'Nome'));
echo $this->Form->input('area_id', array('label' => 'Área', 'type' => 'select', 'options' => $areas));
echo $this->Form->input('Formacao', array('label' => 'Formação', 'type' => 'select', 'multiple' => true, 'options' => $formacoes));
echo $this->Form->input('tempo_atuacao', array('label' => 'Tempo de atuação'));
echo $this->form->input('Docente.id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
