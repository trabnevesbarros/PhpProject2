<h1>Perguntas</h1>

<table>
    <thead>
        <th>Id</th>
        <th>Pergunta</th>
        <th>Tipo</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php debug($perguntas);foreach ($perguntas as $pergunta): ?>
        <tr>
            <td><?php echo $pergunta[0]['id']; ?></td>        
            <td>
                <?php 
                $value = $pergunta[0]['pergunta'];
                if (strlen($value) > 50) $value = substr($value, 0, 50) . "...";
                echo $this->Html->link($value, 
                        array('action' => 'view', $pergunta[0]['id'])); 
                ?>
            </td>
            <td><?php echo $pergunta[0]['name'] ?></td>
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $pergunta[0]['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $pergunta[0]['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
if($perguntastipos){
    echo $this->Html->link('Adicionar pergunta', array('action' => 'add'));
} else {
    echo $this->Html->link('Adicionar tipos primeiro', array('controller' => 'Perguntastipos', 'action' => 'index'));
}