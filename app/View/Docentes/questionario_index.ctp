<h1>Questionario <?php echo '[Id do docente = ' . $docenteId . ']'; ?></h1>

<table>
    <thead>
    <th>Id</th>
    <th>Pergunta</th>
    <th colspan='2'>Ação</th>
</thead>
<tbody>
    <?php foreach ($respostas as $resposta): ?>
        <tr>
            <td><?php echo $resposta['Docentesresposta']['id']; ?></td>        
            <td>
                <?php
                $pergunta = $resposta['Pergunta'];
                $value = $pergunta['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array('action' => 'questionarioView',
                    $resposta['Docentesresposta']['id'],
                    $pergunta['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->Link('Editar', array(
                    'action' => 'questionarioEdit',
                    $resposta['Docentesresposta']['id']));
                ?>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'questionarioDelete', $resposta['Docentesresposta']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
<?php endforeach; ?>

</tbody>
</table>

<?php
echo $this->Html->Link('Responder questionario', array('action' => 'questionarioAdd', $docenteId));
echo '<br/>';
echo $this->Html->Link('Voltar', array('action' => 'index'));
