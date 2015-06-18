<h1>Cadastrar usuario</h1>
<?php
echo $this->Form->create('User', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Nome'));
echo $this->Form->input('email', array('label' => 'E-mail'));
echo $this->Form->input('password', array('label' => 'Senha', 'type' => 'password'));
echo $this->Form->input('password_confirm', array('label' => 'Confirmar senha', 'type'=>'password'));
echo $this->Form->input('super', array('label' => 'Administrador', 'type' => 'checkbox'));
echo $this->Form->end('Salvar');
