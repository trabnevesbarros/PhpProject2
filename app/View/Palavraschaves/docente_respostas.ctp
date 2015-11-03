<h1>Lista de respostas de docentes conectadas a palavra "<?php echo $palavra['palavra'] ?>"</h1>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Docentesresposta.docente', 'Nome'); ?></th>
    <th><?php echo $this->Paginator->sort('Docentesresposta.pergunta', 'Pergunta'); ?></th>
</thead>
<tbody>
    <?php foreach ($docentesrespostas as $docentesresposta): ?>
        <tr>
            <td>
                <?php 
                //echo $this->Html->link($docentesresposta['docente'], array('controller' => 'Docentes', 'action' => 'view', $docentesresposta['docente_id'])); 
                echo $this->Html->link($docentesresposta['docente'], array('controller' => 'docentesrespostas', 'action' => 'questionarioIndex', $docentesresposta['docente_id']));
                ?>
            </td>
            <td>
                <?php
                $value = $docentesresposta['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array(
                    'controller' => 'Docentesrespostas', 
                    'action' => 'questionarioView', $docentesresposta['id'])) 
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