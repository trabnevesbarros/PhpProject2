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
        <div id="container">
            <div id="header">
                <?php echo $this->element('header'); ?>
            </div>
            <div id="content">
                <div id="sidebar-wrapper">
                    <?php echo $this->element('sidebar'); ?>
                </div>
                <div id="page-content-wrapper">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>
        <div id="footer">  
            <?php echo $this->element('footerIf'); ?>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
