<h1>Alterar registro</h1>
<?php
echo $this->Form->create('User', array('inputDefaults' => array('type' => 'text')));
echo $this->Form->input('name', array('label' => 'Nome'));
echo $this->Form->input('email', array('label' => 'E-mail'));
echo $this->Form->input('password_update', array('label' => 'Nova senha (deixe em branco se não quiser alterar)', 'type'=>'password','required' => 0));
echo $this->Form->input('password_confirm_update', array('label' => 'Confirmar nova senha', 'type'=>'password','required' => 0));
if ($this->Session->read('Auth.User.super')) {
    echo $this->Form->input('super', array('label' => 'Administrador', 'type' => 'checkbox'));
}
echo $this->form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Salvar');
