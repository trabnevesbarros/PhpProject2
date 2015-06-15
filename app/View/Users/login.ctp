<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Por favor, insira seu e-mail e senha'); ?></legend>
        <?php
        echo $this->Form->input('email', array('type' => 'text'));
        echo $this->Form->input('password', array('type' => 'password'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<ul>
    <li>
    <?php echo $this->Html->link('Cadastrar usuario', array('action'=>'add')); ?>
    </li>
</ul>