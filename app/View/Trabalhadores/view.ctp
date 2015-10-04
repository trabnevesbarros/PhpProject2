<p><strong>Nome: </strong><?php echo h($trabalhador['Trabalhador']['nome']); ?>.</p>
<p><strong>Ocupação: </strong> <?php echo h($trabalhador['Ocupacao']['name']); ?>.</p>
<div class='formacoes_ul'><strong>Formação(ões):</strong> 
    <ul>
    <?php 
    foreach($trabalhador['Formacao'] as $formacao)
    echo '<li>' . $formacao['name'] . '</li>'; 
    ?>
    </ul>
</div>
<p><strong>Tempo de atuação:</strong> <?php echo h($trabalhador['Trabalhador']['tempo_atuacao']) ?>.</p>
