<h1>Formação</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Pergunta.pergunta', 'Pergunta'); ?></th>
    <th><?php echo $this->Paginator->sort('Pergunta.tipo', 'Tipo'); ?></th>
    <th colspan="3">Ação</th>
    </thead>
    
    <tbody>
        <?php foreach ($perguntas as $pergunta):?>
            <tr>
                <td>
                <?php 
                $value = $pergunta['Pergunta']['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array('action' => 'view', $pergunta['Pergunta']['id']));  
                ?>
                </td>
                
                <td><?php echo $pergunta['Pergunta']['tipo'];  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $pergunta['Pergunta']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $pergunta['Pergunta']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar pergunta', array('action' => 'add')); 
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
    
    
    