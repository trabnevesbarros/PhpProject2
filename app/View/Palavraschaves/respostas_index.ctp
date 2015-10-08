<h1>Lista de respostas conectadas a palavra "<?php echo $palavra['palavra'] ?>"</h1>

<table>
    <thead>
    <th>Nome</th>    
    <th>Tipo</th>
    <th>Pergunta</th>
</thead>
<tbody>
    <?php foreach ($palavra_respostas as $resposta): ?>
        <tr>
            <td>
                <?php echo $resposta[$resposta['Tipo']['name']]['nome']; ?>
            </td>
            <td>
                <?php echo $resposta['Tipo']['name']; ?>
            </td>
            <td>
                <?php
                $value = $resposta['Pergunta']['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                $controllers = array(
                    'Trabalhador' => 'Trabalhadoresrespostas',
                    'Docente' => 'Docentesrespostas',
                    'Empregador' => 'Empregadoresrespostas'
                );
                echo $this->Html->link($value, array(
                    'controller' => $controllers[$resposta['Tipo']['name']], 
                    'action' => 'questionarioView', $resposta['id'])) 
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>