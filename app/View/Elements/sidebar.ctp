<ul class="sidebar-nav">
    <li class="sidebar-brand">
        <a>
            Menu
        </a>
    </li>
    <li>
        <?php
        echo $this->Html->link('Início', array('controller' => 'pages', 'action' => 'home'));
        ?>
    </li>
    <li>
        <?php
        if ($this->Session->check('Auth.User')) {
            echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
        } else {
            echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
        }
        ?>                        
    </li>
    <li>
        <?php
        if ($this->Session->check('Auth.User.super')) {
            echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index'));
        }
        ?>
    </li>
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
        <?php //echo $this->Html->link('Formações', array('controller' => 'formacaos', 'action' => 'index')); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Perguntas', array('controller' => 'perguntas', 'action' => 'index')); ?>
    </li>

</ul>