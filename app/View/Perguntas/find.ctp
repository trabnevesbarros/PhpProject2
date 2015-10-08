<?php?>
<h1>Pergunta</h1>

<?php
echo $this->Form->create('Pergunta', array(
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
                    echo $this->Form->input('pergunta_search', array(
                        'div' => false,
                        'label' => 'Pergunta'
                            )
                    );
                    ?>
                </td>
                <td><?php
                    echo $this->Form->input('tipo_search', array(
                        'type' => 'select',
                        'div' => false,
                        'class' => 'boxSearch',
                        'label' => 'Tipo',
                        'options' => $tipos
                    ));
                    ?>
                </td>
            </tr>
            <tr><td><?php echo $this->Form->end('Pesquisar'); ?></td></tr>
        </tbody>
    </table>
</div>


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
                
                <td><?php echo $pergunta['Pergunta']['tipo']; ?></td>
                
                <td><?php echo $this->Html->link('Alterar', array('action' => 'edit', $pergunta['Pergunta']['id']));?></td>
                
                <td><?php echo $this->Form->postLink('Remover', array('action' => 'delete', $pergunta['Pergunta']['id']), array('confirm' => 'Você tem certeza?')); ?></td>
                
            
            </tr>
            
        <?php endforeach; ?>  
        
    </tbody>

</table>
</br>
<?php echo $this->Html->link('Adicionar Pergunta', array('action' => 'add')); 
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
    
    
    
    