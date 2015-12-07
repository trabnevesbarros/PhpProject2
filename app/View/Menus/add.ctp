<h1>Cadastrar docente</h1>
<?php
echo $this->Form->create('Menu', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('titulo', array('label' => 'Titulo'));
echo $this->Form->input('controller', array('label' => 'Controlador', 'type' => 'select', 'options' => $controller));
echo $this->Form->input('action', array('label' => 'Ação', 'type' => 'select', 'options' => $acition));

echo $this->Form->end('Salvar');













