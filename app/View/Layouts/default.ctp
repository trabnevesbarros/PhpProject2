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


       

        <link href="css/custom.css" rel="stylesheet">
        <link href="css/cake.generic.css" rel="stylesheet">
        <?php echo $this->Html->charset(); ?>
        <title>
            Observatório
        </title>
        <?php
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>

        <div id="container">
            <div id="header">
                <img src="/PhpProject2/img/4.jpg"/>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/PhpProject2/img/logoif.png" class="logoif"/>			
                            <img src="/PhpProject2/img/observatorio2.jpg" class="logoobs"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">

            <div id="wrapper">

                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <a>
                                Menu
                            </a>
                        </li>
                        <li>
                            <a href="/PhpProject2/">Início</a>
                        </li>
                        <!--<li>
                        <?php /* if ($this->Auth->read('Auth.User.super')){
                          echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
                          }else {
                          echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
                          } */ ?>
                            
                        </li>-->
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
                            <?php echo $this->Html->link('Formações', array('controller' => 'formacaos', 'action' => 'index')); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('Perguntas', array('controller' => 'perguntas', 'action' => 'index')); ?>
                        </li>
                        <li>
                            <?php
                            /* if ($this->Auth->check('Auth.User')) {
                              $this->redirect(array('action' => 'login'));
                              } else {
                              $this->redirect(array('action' => 'logout'));
                              } */
                            ?>
                        </li>
                    </ul>
                </div>


                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $this->Session->flash(); ?>

                                <?php echo $this->fetch('content'); ?>

                                <?php echo $this->element('sql_dump'); ?>

                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>

    </body>
</html>
