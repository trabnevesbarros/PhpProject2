<h1>Submenu</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Submenu.name', 'Titulo'); ?></th>
    <th><?php echo $this->Paginator->sort('Submenu.controller', 'Controller'); ?></th>
    <th><?php echo $this->Paginator->sort('Submenu.action', 'Ação'); ?></th>
    <th><?php echo $this->Paginator->sort('Submenu.menu_id', 'Menu'); ?></th>
    <th colspan='2'>Ação</th>
</thead>
<tbody>
    <?php foreach ($submenus as $submenu): ?>
        <tr>      
            <td>
                <?php
                echo $submenu['Submenu']['name'];
                ?>
            </td>
            <td><?php echo $submenu['Submenu']['controller']; ?></td>
            <td><?php echo $submenu['Submenu']['action']; ?></td>
            <td><?php echo $this->Html->link($submenu['Menu']['name'], array('controller' => 'Menus' ,'action' => 'view', $submenu['Menu']['id']));  ?></td>
  
            <td>
                <?php
                echo $this->Html->link('Alterar', array('action' => 'edit', $submenu['Submenu']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', array('action' => 'delete', $submenu['Submenu']['id']), array('confirm' => 'Você tem certeza?'));
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php 
echo $this->Html->link('Adicionar submenu', array('action' => 'add'));
echo '<br/>';
echo $this->Html->link('Pesquisar', array('action' => 'find'));
?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>
    






