<p><strong>Nome: </strong><?php echo h($docente['Docente']['nome']); ?>.</p>
<p><strong>Área: </strong> <?php echo h($docente['Area']['name']); ?>.</p>
<div class='formacoes_ul'><strong>Formação(ões):</strong> 
    <ul>
    <?php 
    foreach($docente['Formacao'] as $formacao)
    echo '<li>' . $formacao['name'] . '</li>'; 
    ?>
    </ul>
</div>
<p><strong>Tempo de atuação:</strong> <?php echo h($docente['Docente']['tempo_atuacao']) ?>.</p>
