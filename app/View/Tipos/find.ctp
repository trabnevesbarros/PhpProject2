<?php?>
<h1>Tipos</h1>

<?php
echo $this->Form->create('Tipo', array(
'url' => array_merge(
array(
'action' => 'find'
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
            </tr>
            <tr><td><?php echo $this->Form->end('Pesquisar'); ?></td></tr>
        </tbody>
    </table>
</div>


<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Tipo.name', 'Nome'); ?></th>
    <th colspan="3">Ação</th>
    </thead>
    
    <tbody>
        <?php foreach ($tipos as $tipo):?>
            <tr>
                
                <td><?php echo $this->Html->link($tipo['Tipo']['name'], array('action' => 'view', $tipo['Tipo']['id']));  ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $tipo['Tipo']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $tipo['Tipo']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar tipo', array('action' => 'add')); 
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
