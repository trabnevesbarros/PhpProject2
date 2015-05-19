<h1>Perguntas</h1>

<table>
    <thead>
        <th>Pergunta</th>
        <th>Tipo</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($perguntas as $pergunta): ?>
        <tr>     
            <td>
                <?php 
                $value = $pergunta['Pergunta']['pergunta'];
                if (strlen($value) > 50) $value = substr($value, 0, 50) . "...";
                echo $this->Html->link($value, 
                        array('action' => 'view', $pergunta['Pergunta']['id'])); 
                ?>
            </td>
            <td><?php echo $pergunta['Tipo']['name'] ?></td>
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $pergunta['Pergunta']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $pergunta['Pergunta']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
if(isset($tipos[0])){
    echo $this->Html->link('Adicionar pergunta', array('action' => 'add'));
} else {
    echo $this->Html->link('Adicionar tipos primeiro', array('controller' => 'Tipos', 'action' => 'index'));
}