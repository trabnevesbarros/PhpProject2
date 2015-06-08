<div class="users form">
    <?php echo $this->Session->flash('Autenticação'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Por favor, insira seu nome de usuario e senha'); ?></legend>
        <?php
        echo $this->Form->input('username', array('type' => 'text'));
        echo $this->Form->input('password', array('type' => 'password'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>