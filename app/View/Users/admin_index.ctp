<h1>Usuarios</h1>

<table>
    <thead>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Administrador</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>       
            <td>
                <?php 
                echo $this->Html->link($user['User']['name'], 
                        array('action' => 'adminView', $user['User']['id'])); 
                ?>
            </td>
            <td>
                <?php echo $user['User']['email']; ?>
            </td>
            <td>
                <?php
                if ($user['User']['super']) {
                    echo 'S';
                } else {
                    echo 'N';
                } 
                ?>
            </td>            
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'adminEdit', $user['User']['id'])); 
                ?>
            </td>
            <td>
                <?php if( $user['User']['id'] != $this->Session->read('Auth.User.id')): 
                    echo $this->Form->postLink('Remover', 
                            array('action' => 'adminDelete', $user['User']['id']), 
                            array('confirm' => 'Você tem certeza?')
                    );
                else:
                ?>
                <strike>Remover</strike>
                <?php endif; ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Html->link('Adicionar usuario', array('action' => 'adminAdd')); ?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
<div>