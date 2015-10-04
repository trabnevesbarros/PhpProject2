<h1>Questionario <?php echo '(Empregador ' . $empregador['Empregador']['nome'] . ')'; ?></h1>

<?php
echo $this->Form->create('Empregadoresresposta', array(
    'url' => array_merge(
            array(
        'action' => 'questionarioFind'
            ), $this->params['pass']
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
                    echo $this->Form->input('pergunta_search', array(
                        'div' => false,
                        'label' => 'Pergunta'
                            )
                    );
                    ?>
                </td>
            </tr>
            <tr><td><?php echo $this->Form->end('Pesquisar'); ?></td></tr>
        </tbody>
    </table>
</div>

<?php
echo '<br/>';
echo $this->Html->link('Voltar', array('action' => 'index'));
?>

<table>
    <thead>
    <th><?php echo $this->Paginator->sort('Pergunta.pergunta', 'Pergunta'); ?></th>
    <th><?php echo $this->Paginator->sort('Pergunta.status', 'Status'); ?></th>
    <th colspan='3'>Ação</th>
</thead>
<tbody>
    <?php 
    $respondidas;
    foreach ($perguntas as $pergunta): 
        if($pergunta['Empregadoresresposta']):
    ?>
        <tr>    
            <td>
                <?php
                $value = $pergunta['Pergunta']['pergunta'];
                if (strlen($value) > 50) {
                    $value = substr($value, 0, 50) . "...";
                }
                echo $this->Html->link($value, array('action' => 'questionarioView',
                    $pergunta['Empregadoresresposta'][0]['id'],
                    $pergunta['Pergunta']['id']));
                ?>
            </td>
            <td>Respondida</td>
            <td>
                <?php
                echo $this->Html->Link('Editar', array(
                    'action' => 'questionarioEdit',
                    $pergunta['Empregadoresresposta'][0]['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink('Remover', 
                        array('action' => 'questionarioDelete', $pergunta['Empregadoresresposta'][0]['id']), 
                        array('confirm' => 'Você tem certeza?')
                );
                ?>
            </td>
            <td>
                <?php
                echo $this->html->Link('Palavras-Chave', 
                        array('action' => 'palavrasIndex', $pergunta['Empregadoresresposta'][0]['id'])
                );
                ?>
            </td>
        </tr>
    <?php 
        else: 
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
                    $empregador['Empregador']['id'],
                    $pergunta['Pergunta']['id']));
                ?>
            </td>
            <td></td>
            <td></td>
        </tr>
    <?php
        endif;
    endforeach; 
    ?>

</tbody>
</table>

<?php
echo $this->Html->Link('Responder questionario', array('action' => 'questionarioAdd', $empregador['Empregador']['id'])); 
echo '<br/>';
echo $this->Html->link('Voltar', array('action' => 'questionarioIndex', $empregador['Empregador']['id']));
?>

<div class="paging">
<?php
echo $this->Paginator->prev('Anterior');
echo $this->Paginator->numbers();
echo $this->Paginator->next('Próximo');
?>
</div>
