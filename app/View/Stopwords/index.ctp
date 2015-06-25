<h1>Stopwords</h1>

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

    <?php echo $this->Html->link('Adicionar stop words', array('action' => 'add')); ?>


<div class="paging">
    <?php
    echo $this->Paginator->prev('Anterior');
    echo $this->Paginator->numbers();
    echo $this->Paginator->next('Próximo');
    ?>
</div>
