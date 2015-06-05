
<p><strong>Usuario:</strong> <?php echo h($user['User']['username']) ?></p>
<p>
    <strong>Permissão:</strong> 
    <?php 
if($user['User']['super']) {
    echo h('Administrador'); 
} else {
    echo h('Normal'); 
}
    ?>
</p>
