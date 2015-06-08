<h1>Formacao</h1>

<table>
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th colspan="3">Acao</th>
    </thead>
    
    <tbody>
        <?php foreach ($formacaos as $formacao):?>
            <tr>
                <td><?php echo $formacao['Formacao']['id'];?></td>
                
                <td><?php echo $this->Html->link($formacao['Formacao']['name'], array('action' => 'view', $formacao['Formacao']['id']));  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $formacao['Formacao']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $formacao['Formacao']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar formação', array('action' => 'add')); ?>
    
    
    
    