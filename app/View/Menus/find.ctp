<h1>Menues</h1>

<?php
echo $this->Form->create('Menu', array(
    'url' => array_merge(
            array(
        'action' => 'find'
            ), $this->params['pass']
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
    'label' => 'Titulo'
        )
);
?>
                </td>            
                <td><?php
                    echo $this->Form->input('controller', array(
                        'div' => false,
                        'label' => 'Controller',
                        'type' => 'select',
                        'class' => 'boxSearch',
                        'options' => $controller
                            )
                    );
?>
                </td>
            </tr>
            <tr>
                <td><?php
                    echo $this->Form->input('action', array(
                        'div' => false,
                        'type' => 'select',
                        'options' => $action,
                        'label' => 'Action'
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
    <th><?php echo $this->Paginator->sort('Menu.name', 'Titulo'); ?></th>
    <th><?php echo $this->Paginator->sort('Menu.controller', 'Controller'); ?></th>
    <th><?php echo $this->Paginator->sort('Menu.action', 'Action'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
<?php foreach ($menus as $menu): ?>
        <tr>      
            <td>
    <?php
    echo $this->Html->link($menu['Menu']['name'], array('action' => 'view', $menu['Menu']['id']));
    ?>
            </td>           
            <td><?php echo $menu['Menu']['controller']; ?></td>
            <td><?php echo $menu['Menu']['action']; ?></td>
            <td>
    <?php
    echo $this->Html->link('Alterar', array('action' => 'edit', $menu['Menu']['id']));
    ?>
            </td>
            <td>
    <?php
    echo $this->Form->postLink('Remover', array('action' => 'delete', $menu['Menu']['id']), array('confirm' => 'Você tem certeza?'));
    ?>
            </td>
            <td>
    
            </td>
        </tr>

<?php endforeach; ?>
</tbody>
</table>

<?php
echo $this->Html->link('Adicionar menu', array('action' => 'add'));
echo '<br/>';
echo $this->Html->link('Voltar', array('action' => 'index'));
?>


<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>