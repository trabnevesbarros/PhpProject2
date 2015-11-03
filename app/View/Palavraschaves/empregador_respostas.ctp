<h1>Lista de respostas de empregadores conectadas a palavra "<?php echo $palavra['palavra'] ?>"</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Empregadoresresposta.empregador', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Empregadoresresposta.pergunta', 'Pergunta'); ?></th>
</thead>
<tbody>
    <?php foreach ($empregadoresrespostas as $empregadoresresposta): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($empregadoresresposta['empregador'], array('controller' => 'empregadoresrespostas', 'action' => 'questionarioIndex', $empregadoresresposta['empregador_id'])); ?>
            </td>
            <td>
                <?php
                $value = $empregadoresresposta['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array(
                    'controller' => 'Empregadoresrespostas', 
                    'action' => 'questionarioView', $empregadoresresposta['id'])) 
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>