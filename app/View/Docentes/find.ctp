<h1>Docentes</h1>

<?php
echo $this->Form->create('Docente', array(
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
                    echo $this->Form->input('area_search', array(
                        'div' => false,
                        'label' => 'Area'
                            )
                    );
                    ?>
                </td>
                <td><?php
                    echo $this->Form->input('formacao_search', array(
                        'div' => false,
                        'label' => 'Formação'
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
                    ?>
                </td>
                <td class="boxSearch"><?php
                    echo $this->Form->input('tempo_atuacao_op', array(
                        'div' => false,
                        'label' => 'Operador',
                        'type' => 'select',
                        'options' => $operators
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
    <th><?php echo $this->Paginator->sort('Docente.nome', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Docente.area', 'Área'); ?></th>
    <th><?php echo $this->Paginator->sort('Docente.formacao', 'Formação'); ?></th>
    <th><?php echo $this->Paginator->sort('Docente.tempo_atuacao', 'Tempo de atuação'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php foreach ($docentes as $docente): ?>
        <tr>      
            <td>
                <?php
                echo $this->Html->link($docente['Docente']['nome'], array('action' => 'view', $docente['Docente']['id']));
                ?>
            </td>           
            <td><?php echo $docente['Docente']['area']; ?></td>
            <td><?php echo $docente['Docente']['formacao']; ?></td>
            <td><?php echo $docente['Docente']['tempo_atuacao']; ?></td>
            <td>
                <?php
                echo $this->Html->link('Alterar', array('action' => 'edit', $docente['Docente']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', array('action' => 'delete', $docente['Docente']['id']), array('confirm' => 'Você tem certeza?'));
                ?>
            </td>
            <td>
                <?php
                if (!empty($perguntas)) {
                    echo $this->Html->link('Ver questionario', array('controller' => 'docentesrespostas', 'action' => 'questionarioIndex', $docente['Docente']['id']));
                }
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php
echo $this->Html->link('Adicionar docente', array('action' => 'add')); 
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
