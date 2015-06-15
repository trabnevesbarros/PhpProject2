<h1>Questionario <?php echo '(Docente ' . $respostas[0]['Docente']['nome'] . ')'; ?></h1>

<table>
    <thead>
    <th>Pergunta</th>
    <th>Status</th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php 
    $respondidas;
    foreach ($respostas as $resposta): 
    ?>
        <tr>    
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
            <td>Respondida</td>
            <td>
                <?php
                echo $this->Html->Link('Editar', array(
                    'action' => 'questionarioEdit',
                    $resposta['Docentesresposta']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'questionarioDelete', $resposta['Docentesresposta']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
            <td>
                <?php
                echo $this->html->Link('Palavras-Chave', 
                        array('action' => 'palavrasIndex', $resposta['Docentesresposta']['id'])
                );
                ?>
            </td>
        </tr>
    <?php 
    $respondidas[] = $resposta['Pergunta'];
    endforeach; 
    
    foreach ($perguntas as $pergunta): 
        if (array_search($pergunta['Pergunta'], $respondidas) === false):
    ?>
        <tr>    
            <td>
                <?php
                $value = $pergunta['Pergunta']['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $value;
                ?>
            </td>
            <td>Não respondida</td>
            <td>
                <?php
                echo $this->Html->Link('Responder', array(
                    'action' => 'questionarioAdd',
                    $respostas[0]['Docente']['id'],
                    $pergunta['Pergunta']['id']));
                ?>
            </td>
        </tr>
    <?php
        endif;
    endforeach; 
    ?>

</tbody>
</table>

<?php
echo $this->Html->Link('Responder questionario', array('action' => 'questionarioAdd', $respostas[0]['Docente']['id']));
echo '<br/>';
echo $this->Html->Link('Voltar', array('action' => 'index'));
