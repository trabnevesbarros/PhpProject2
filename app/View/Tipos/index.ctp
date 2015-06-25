<h1>Tipos de perguntas</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('name', 'Tipo'); ?></th>
        <th colspan='3'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($tipos as $tipo): ?>
        <tr>       
            <td>
                <?php 
                echo $this->Html->link($tipo['Tipo']['name'], 
                        array('action' => 'view', $tipo['Tipo']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $tipo['Tipo']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $tipo['Tipo']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar tipo', array('action' => 'add')); ?>
    
<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>