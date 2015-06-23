<h1>Docentes</h1>

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

<?php echo $this->Html->link('Adicionar docente', array('action' => 'add')); ?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
<div>
    