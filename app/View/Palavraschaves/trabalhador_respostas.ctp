<h1>Lista de respostas de trabalhadores conectadas a palavra "<?php echo $palavra['palavra'] ?>"</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Trabalhadoresresposta.trabalhador', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Trabalhadoresresposta.pergunta', 'Pergunta'); ?></th>
</thead>
<tbody>
    <?php foreach ($trabalhadoresrespostas as $trabalhadoresresposta): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($trabalhadoresresposta['trabalhador'], array('controller' => 'trabalhadoresrespostas', 'action' => 'questionarioIndex', $trabalhadoresresposta['trabalhador_id'])); ?>
            </td>
            <td>
                <?php
                $value = $trabalhadoresresposta['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array(
                    'controller' => 'Trabalhadoresrespostas', 
                    'action' => 'questionarioView', $trabalhadoresresposta['id'])) 
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