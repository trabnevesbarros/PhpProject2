<h1>Palavras chave</h1>

<table>
    <thead>
        <th><?php echo $this->Paginator->sort('Palavraschave.palavra', 'Palavra'); ?></th>
        <th colspan='3'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($palavraschaves as $palavraschave): ?>
        <tr>
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
                <?php
                if ($palavraschave['Palavraschave']['docentes'] + $palavraschave['Palavraschave']['empregadores'] + $palavraschave['Palavraschave']['trabalhadores'] >= 1) {
                    echo $this->Html->Link('Respostas', array('action' => 'respostasIndex', $palavraschave['Palavraschave']['id'])); 
                }
                ?>
            </td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar palavra chave', array('action' => 'add')); ?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>
    