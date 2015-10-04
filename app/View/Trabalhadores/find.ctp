<h1>Trabalhadores</h1>

<?php
echo $this->Form->create('Trabalhador', array(
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
                    echo $this->Form->input('nome_search', array(
                        'div' => false,
                        'label' => 'Nome'
                            )
                    );
                    ?>
                </td>
                <td><?php
                    echo $this->Form->input('ocupacao_search', array(
                        'div' => false,
                        'label' => 'Ocupacao',
                        'type' => 'select',
                        'class' => 'boxSearch',
                        'options' => $ocupacoes
                            )
                    );
                    ?>
                </td>                
                <td><?php
                    echo $this->Form->input('tempo_atuacao_search', array(
                        'div' => false,
                        'label' => 'Tempo de atuação',
                        'type' => 'number'
                            )
                    );
                    echo $this->Form->input('tempo_atuacao_op', array(
                        'div' => false,
                        'label' => '',
                        'type' => 'select',
                        'class' => 'boxSearch',
                        'options' => $operators
                            )
                    );
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan='3'><?php
                    echo $this->Form->input('formacoes', array(
                        'div' => false,
                        'type' => 'select',
                        'multiple' => 'true',
                        'options' => $formacoes,
                        'label' => 'Formações',
                        'class' => 'formacoes_input'
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
    <th><?php echo $this->Paginator->sort('Trabalhador.nome', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Trabalhador.ocupacao', 'Ocupação'); ?></th>
    <th><?php echo 'Nº formações' ?></th>
    <th><?php echo $this->Paginator->sort('Trabalhador.tempo_atuacao', 'Tempo de atuação'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php foreach ($trabalhadores as $trabalhador): ?>
        <tr>      
            <td>
                <?php
                echo $this->Html->link($trabalhador['Trabalhador']['nome'], array('action' => 'view', $trabalhador['Trabalhador']['id']));
                ?>
            </td>           
            <td><?php echo $trabalhador['Ocupacao']['name']; ?></td>
            <td><?php echo $trabalhador['Trabalhador']['formacoes_count']; ?></td>
            <td><?php echo $trabalhador['Trabalhador']['tempo_atuacao']; ?></td>
            <td>
                <?php
                echo $this->Html->link('Alterar', array('action' => 'edit', $trabalhador['Trabalhador']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', array('action' => 'delete', $trabalhador['Trabalhador']['id']), array('confirm' => 'Você tem certeza?'));
                ?>
            </td>
            <td>
                <?php
                if (!empty($perguntas)) {
                    echo $this->Html->link('Ver questionario', array('controller' => 'trabalhadoresrespostas', 'action' => 'questionarioIndex', $trabalhador['Trabalhador']['id']));
                }
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php
echo $this->Html->link('Adicionar trabalhador', array('action' => 'add')); 
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
