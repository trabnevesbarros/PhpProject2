<h1>Tipos de perguntas</h1>

<table>
    <thead>
        <th>Id</th>
        <th>Tipo</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($perguntastipos as $perguntastipo): ?>
        <tr>
            <td><?php echo $perguntastipo['Perguntastipo']['id']; ?></td>        
            <td>
                <?php 
                echo $this->Html->link($perguntastipo['Perguntastipo']['tipo'], 
                        array('action' => 'view', $perguntastipo['Perguntastipo']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $perguntastipo['Perguntastipo']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $perguntastipo['Perguntastipo']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar tipo', array('action' => 'add')); ?>
    