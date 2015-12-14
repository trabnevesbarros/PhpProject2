<h1>Cadastrar docente</h1>
<?php
echo $this->Form->create('Submenu', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Titulo'));
echo $this->Form->input('controller', array('label' => 'Controlador', 'type' => 'select', 'options' => $controller));
echo $this->Form->input('menu', array('label' => 'Menus', 'type' => 'select', 'options' => $menus));
echo $this->Form->input('action', array('label' => 'Ação', 'type' => 'select', 'options' => $action));

echo $this->Form->end('Salvar');













