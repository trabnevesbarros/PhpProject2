<h1>Lista de respostas conectadas a palavra "<?php echo $palavra['palavra'] ?>"</h1>

<table>
    <thead>
    <th>Pergunta</th>
    <th>Tipo</th>
</thead>
<tbody>
    <?php foreach ($palavra_respostas as $resposta): ?>
        <tr>      
            <td>
                <?php echo $this->Html->link($resposta['Pergunta']['pergunta'], array(
                    'controller' => $resposta['Tipo']['name'].'s', 
                    'action' => 'QuestionarioView', $resposta['id'])) ?>
            </td>
            <td>
                <?php echo $resposta['Tipo']['name']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>