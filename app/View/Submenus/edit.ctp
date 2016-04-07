<h1>Alterar Registro</h1>
<?php
echo $this->Form->create('Submenu', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Titulo'));
echo $this->Form->input('controller', array('label' => 'Controlador', 'type' => 'select', 'options' => $controller));
echo $this->Form->input('menu_id', array('label' => 'Menus', 'type' => 'select', 'options' => $menu));
echo $this->Form->input('action', array('label' => 'Ação', 'type' => 'select', 'options' => $action));
echo $this->form->input('Submenu.id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');













