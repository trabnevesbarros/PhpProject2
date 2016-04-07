<h1>Menu</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Menu.name', 'Titulo'); ?></th>
    <th><?php echo $this->Paginator->sort('Menu.controller', 'Controller'); ?></th>
    <th><?php echo $this->Paginator->sort('Menu.action', 'Ação'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php foreach ($menus as $menu): ?>
        <tr>      
            <td>
                <?php
                echo $menu['Menu']['name'];
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
                <?php
                echo $this->Form->postLink($this->Html->image('/img/up.png',
       array('alt' => 'Subir', 'title' => 'Subir', 'id' => 'seta')), array('action' => 'move', $menu['Menu']['id'], 0), array('escape' => false));
                
                echo " ".$this->Form->postLink($this->Html->image('/img/down.png',
       array('alt' => 'Descer', 'title' => 'Descer', 'id' => 'seta')), array('action' => 'move', $menu['Menu']['id'], 1), array('escape' => false));
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php 
echo $this->Html->link('Adicionar menu', array('action' => 'add'));
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
    






