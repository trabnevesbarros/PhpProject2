<h1>Palavras chave</h1>

<table>
    <thead>
        <th>Id</th>
        <th>Palavra</th>
        <th colspan='3'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($palavraschaves as $palavraschave): ?>
        <tr>
            <td><?php echo $palavraschave['Palavraschave']['id']; ?></td>        
            <td>
                <?php 
                echo $this->Html->link($palavraschave['Palavraschave']['palavra'], 
                        array('action' => 'view', $palavraschave['Palavraschave']['id'])); 
                ?>
            </td>        
            <td>
                <?php
                echo $this->Html->link('Alterar', 
                        array('action' => 'edit', $palavraschave['Palavraschave']['id'])); 
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'delete', $palavraschave['Palavraschave']['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
            <td>
                <?php echo $this->Html->Link('Respostas', array('action' => 'respostasIndex', $palavraschave['Palavraschave']['id'])); ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar palavra chave', array('action' => 'add')); ?>
    