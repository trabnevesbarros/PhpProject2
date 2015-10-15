<h1>Palavras chave</h1>

<?php
echo $this->Form->create('Palavraschave', array(
'url' => array_merge(
array(
'action' => 'find'
),
$this->params['pass']
),
'inputDefaults' => array('type' => 'text', 'class' => 'txtSearch')
)
);

?>  

<div class="search">
    <h2>Filtros:</h2>
    <table class="tableSearch">
        <tbody>
            <tr>
                <td><?php
                    echo $this->Form->input('palavra_search', array(
                        'div' => false,
                        'label' => 'Palavra'
                            )
                    );
                    ?>
                </td>
            </tr>
            <tr><td><?php echo $this->Form->end('Pesquisar'); ?></td></tr>
        </tbody>
    </table>
</div>

<table>
    <thead>
        <th><?php echo $this->Paginator->sort('Palavraschave.palavra', 'Palavra'); ?></th>
        <th><?php echo $this->Paginator->sort('Palavraschave.num', 'Ocorrências'); ?></th>
        <th colspan='3'>Respostas</th>
        <th colspan='2'>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($palavraschaves as $palavraschave): ?>
        <tr>
            <td>
                <?php 
                echo $palavraschave['Palavraschave']['palavra']
                ?>
            </td>
            <td>
                <?php
                echo $palavraschave['Palavraschave']['num'];
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Docentes', 
                        array('action' => 'docenteRespostas', $palavraschave['Palavraschave']['id']))
                . ' [' . $palavraschave['Palavraschave']['docentes'] . ']';
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Trabalhadores', 
                        array('action' => 'trabalhadorRespostas', $palavraschave['Palavraschave']['id']))
                . ' [' . $palavraschave['Palavraschave']['trabalhadores'] . ']';
                ?>
            </td>
            <td>
                <?php
                echo $this->Html->link('Empregadores', 
                        array('action' => 'empregadorRespostas', $palavraschave['Palavraschave']['id']))
                . ' [' . $palavraschave['Palavraschave']['empregadores'] . ']';
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
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->Html->link('Adicionar palavra chave', array('action' => 'add'));
echo '<br/>';
echo $this->Html->link('Voltar', array('action' => 'index'));
?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>
    