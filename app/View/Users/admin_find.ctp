<h1>Usuarios</h1>

<?php
echo $this->Form->create('User', array(
'url' => array_merge(
array(
'controller' => 'users',
'action' => 'adminFind'
),
$this->params['pass']
),
'inputDefaults' => array('type' => 'text', 'class' => 'txtSearch')
)
);

?>  

<div class="search">
    <h2>Filtros:</h2>
    <table class="tableSearch">
        <tbody>
            <tr>
                <td><?php
                    echo $this->Form->input('name_search', array(
                        'div' => false,
                        'label' => 'Nome'
                            )
                    );
                    ?>
                </td>
                <td><?php
                    echo $this->Form->input('email_search', array(
                        'div' => false,
                        'label' => 'e-mail'
                            )
                    );
                    ?>
                </td>
            </tr>
            <tr><td><?php echo $this->Form->end('Pesquisar'); ?></td></tr>
        </tbody>
    </table>
</div>
<table>
    <thead>
    <th><?php echo $this->Paginator->sort('User.name', 'Nome'); ?></th>
        <th><?php echo $this->Paginator->sort('User.email', 'E-mail'); ?></th>
        <th><?php echo $this->Paginator->sort('User.super', 'Admin'); ?></th>
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

<?php
echo $this->Html->link('Adicionar user', array('action' => 'adminAdd')); 
echo '<br/>';
echo $this->Html->link('Voltar', array('action' => 'adminIndex'));
?>

<div class="paging">
    <?php
    echo $this->Paginator->prev('Anterior');
    echo $this->Paginator->numbers();
    echo $this->Paginator->next('Próximo');
    ?>
</div>
