
<p><strong>Nome:</strong> <?php echo h($user['User']['name']) ?></p>
<p><strong>E-mail:</strong> <?php echo h($user['User']['email']) ?></p>
<p>
    <strong>Permissão:</strong> 
    <?php
    if ($user['User']['super']) {
        echo h('Administrador');
    } else {
        echo h('Normal');
    }
    ?>
</p>
