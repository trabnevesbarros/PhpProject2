<h1>Alterar registro</h1>
<?php
echo $this->Form->create('Tipo', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Tipo'));
echo $this->form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
