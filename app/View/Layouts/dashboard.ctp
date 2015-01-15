<?php
/**
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
        <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title><?php echo $title_for_layout; ?></title>
        <!-- bootstrap 3.0.2 -->

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(
                array(
                    'font-awesome.min',
                    'AdminLTE',
                    'admin',
                    'bootstrap.min',
                    'plugins/jquery-ui/smoothness/jquery-ui',
                    'plugins/jquery-ui/smoothness/jquery.ui.theme',
                    'plugins/datatable/TableTools',
                    'plugins/chosen/chosen',
                    'style',
                    'themes'
                )
        );
//        echo $this->Html->script(array(
//            'jquery-min-2.0.2',
//            'AdminLTE/app',
//            'jquery-migrate-1.2.1.min',
//            'admin',
//                )
//        );
        ?>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>

    </head>
    <body class="" > <?php echo $this->element('admin/header'); ?>
        <div class="container-fluid" id="content">
            <section style="padding-left:16%;">
            <?php echo $this->Session->flash(); ?>
            </section>
                <div id="content" class="container-fluid">
                    <?php echo $this->element('admin/left-sidebar'); ?>
                
                    <?php echo $this->fetch('content'); ?>
                    
                </div>

            <?php echo $this->element('sql_dump'); ?>
        </div>
    </body>
</html>

<?php
echo $this->Html->script(array(
    'jquery.min',
    'plugins/nicescroll/jquery.nicescroll.min',
    'plugins/imagesLoaded/jquery.imagesloaded.min',
    'plugins/jquery-ui/jquery.ui.core.min',
    'plugins/jquery-ui/jquery.ui.widget.min',
    'plugins/jquery-ui/jquery.ui.mouse.min',
    'plugins/jquery-ui/jquery.ui.resizable.min',
    'plugins/jquery-ui/jquery.ui.sortable.min',
    'plugins/slimscroll/jquery.slimscroll.min',
    'bootstrap.min',
    'plugins/bootbox/jquery.bootbox',
    'plugins/datatable/jquery.dataTables.min',
    'plugins/datatable/TableTools.min',
    'plugins/datatable/ColReorder.min',
    'plugins/datatable/ColVis.min',
    'plugins/datatable/jquery.dataTables.columnFilter',
    'plugins/chosen/chosen.jquery.min',
    'eakroko.min',
    'application.min',
    'demonstration.min',
));
?>


<!--[if lte IE 9]>
        <script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
        <script>
                $(document).ready(function() {
                        $('input, textarea').placeholder();
                });
        </script>
<![endif]-->
<!-- Favicon -->

<script>
    $(function () {
        setTimeout(function () {
            $("#successFlashMsg").fadeOut('slow');
        }, 2000)
    });
</script> 