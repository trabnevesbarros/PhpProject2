<h1>Cargo</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Cargo.name', 'Nome'); ?></th>
    <th colspan="3">Ação</th>
    </thead>
    
    <tbody>
        <?php foreach ($cargos as $cargo):?>
            <tr>
                
                <td><?php echo $this->Html->link($cargo['Cargo']['name'], array('action' => 'view', $cargo['Cargo']['id']));  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $cargo['Cargo']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $cargo['Cargo']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar cargo', array('action' => 'add')); 
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
    
    
    