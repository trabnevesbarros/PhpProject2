<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>




        <?php
        echo $this->Html->charset();
        echo $this->Html->css('custom');
        echo $this->Html->css('cake.generic');
        ?>
        <title>
            Observatório
        </title>
        <?php
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div id="container">
                <div id="header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">          
                                <div>
                                    <img src="/PhpProject2/img/logoif.png" class="logoif"/>		
                                    <img src="/PhpProject2/img/observatorio2.jpg" class="logoobs"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content">

                        <div id="sidebar-wrapper">
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
                        </div>


                        <div id="page-content-wrapper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php echo $this->Session->flash(); ?>

                                        <?php echo $this->fetch('content'); ?>

                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="footer">  
                        <img src="/PhpProject2/img/logoif.png" class="rodape"/>
                        <p class="alinhar">
                            Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul - Câmpus Rio Grande
                            <br>
                            Rua Eng. Alfredo Huch, 475 | Bairro Centro | CEP: 96201-460 | Rio Grande/RS
                        </p>
                    </div>
                </div>
            </div>
        </div>
<?php echo $this->element('sql_dump'); ?>
    </body>
</html>
