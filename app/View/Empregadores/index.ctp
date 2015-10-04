<h1>Empregadores</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Empregador.nome', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Empregador.cargo', 'Área'); ?></th>
    <th><?php echo 'Nº formações' ?></th>
    <th><?php echo $this->Paginator->sort('Empregador.tempo_atuacao', 'Tempo de atuação'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php foreach ($empregadores as $empregador): ?>
        <tr>      
            <td>
                <?php
                echo $this->Html->link($empregador['Empregador']['nome'], array('action' => 'view', $empregador['Empregador']['id']));
                ?>
            </td>           
            <td><?php echo $empregador['Cargo']['name']; ?></td>
            <td><?php echo $empregador['Empregador']['formacoes_count']; ?></td>
            <td><?php echo $empregador['Empregador']['tempo_atuacao']; ?></td>
            <td>
                <?php
                echo $this->Html->link('Alterar', array('action' => 'edit', $empregador['Empregador']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', array('action' => 'delete', $empregador['Empregador']['id']), array('confirm' => 'Você tem certeza?'));
                ?>
            </td>
            <td>
                <?php
                if (!empty($perguntas)) {
                    echo $this->Html->link('Ver questionario', array('controller' => 'empregadoresrespostas', 'action' => 'questionarioIndex', $empregador['Empregador']['id']));
                }
                ?>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>

<?php 
echo $this->Html->link('Adicionar empregador', array('action' => 'add'));
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
    