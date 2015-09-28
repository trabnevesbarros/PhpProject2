<h1>Area</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Area.name', 'Nome'); ?></th>
    <th colspan="3">Ação</th>
    </thead>
    
    <tbody>
        <?php foreach ($areas as $area):?>
            <tr>
                
                <td><?php echo $this->Html->link($area['Area']['name'], array('action' => 'view', $area['Area']['id']));  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $area['Area']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $area['Area']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar area', array('action' => 'add')); 
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
    
    
    