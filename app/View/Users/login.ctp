<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
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
<ul style="margin: 1.5em">
    <list>
        <li>
        <?php echo $this->Html->link('Registrar novo usuario', array('action'=>'add')); ?>
        </li>    
    </list>
</ul>