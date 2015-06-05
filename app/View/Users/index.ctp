<h1>Usuarios</h1>

<table>
    <thead>
        <th>Nome</th>
        <th>Administrador</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>       
            <td>
                <?php 
                echo $this->Html->link($user['User']['username'], 
                        array('action' => 'view', $user['User']['id'])); 
                ?>
            </td>
            <td>
                <?php echo $user['User']['super']?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $user['User']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $user['User']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar usuario', array('action' => 'add')); ?>
    