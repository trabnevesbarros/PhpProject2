<p><strong>Nome: </strong><?php echo h($empregador['Empregador']['nome']); ?>.</p>
<p><strong>Área: </strong> <?php echo h($empregador['Cargo']['name']); ?>.</p>
<div class='formacoes_ul'><strong>Formação(ões):</strong> 
    <ul>
    <?php 
    foreach($empregador['Formacao'] as $formacao)
    echo '<li>' . $formacao['name'] . '</li>'; 
    ?>
    </ul>
</div>
<p><strong>Tempo de atuação:</strong> <?php echo h($empregador['Empregador']['tempo_atuacao']) ?>.</p>
