<h1>Ocupacao</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Ocupacao.name', 'Nome'); ?></th>
    <th colspan="3">Ação</th>
    </thead>
    
    <tbody>
        <?php foreach ($ocupacoes as $ocupacao):?>
            <tr>
                
                <td><?php echo $this->Html->link($ocupacao['Ocupacao']['name'], array('action' => 'view', $ocupacao['Ocupacao']['id']));  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $ocupacao['Ocupacao']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $ocupacao['Ocupacao']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar ocupacao', array('action' => 'add')); 
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
    
    
    