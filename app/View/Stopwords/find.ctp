<h1>Stopwords</h1>

<?php
echo $this->Form->create('Stopword', array(
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
                    echo $this->Form->input('termo_search', array(
                        'div' => false,
                        'label' => 'Palavra'
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
    <th><?php echo $this->Paginator->sort('termo', 'Termo') ?></th>
    <th colspan='2'>Ação</th>
</thead>
<tbody>
    <?php foreach ($stopwords as $stopword): ?>
        <tr>     
            <td>
                <?php
                echo $this->Html->link($stopword['Stopword']['termo'], array('action' => 'view', $stopword['Stopword']['id']));
                ?>
            </td>        
            <td>
                <?php
                echo $this->Html->link('Alterar', array('action' => 'edit', $stopword['Stopword']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', array('action' => 'delete', $stopword['Stopword']['id']), array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php 
echo $this->Html->link('Adicionar stop words', array('action' => 'add')); 
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
