<ul class="sidebar-nav">
    <li class="sidebar-brand">
        <h1>
            Menu
        </h1>
    </li>
    <li>
        <?php
        echo $this->Html->link('Início', array('controller' => 'pages', 'action' => 'home'));
        ?>
    </li>
    <li>
        <?php
        if ($this->Session->check('Auth.User.super')) {
            echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index'));
        }
        ?>
    </li>
    <?php
    foreach ($array as $value) {
        
    }
    ?>
    <li>
        <?php echo $this->Html->link('Docentes', array('controller' => 'docentes', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Empregadores', array('controller' => 'empregadores', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Trabalhadores', array('controller' => 'trabalhadores', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Stopwords', array('controller' => 'stopwords', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Perguntas', array('controller' => 'perguntas', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Tipos', array('controller' => 'tipos', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Palavras-chave', array('controller' => 'palavraschaves', 'action' => 'index')); ?>
    </li>
    <li>
        <?php
        if ($this->Session->check('Auth.User')) {
            echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('id' => 'logout'));
        } else {
            echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
        }
        ?>                        
    </li>
</ul>