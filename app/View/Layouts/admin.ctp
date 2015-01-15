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
        <script>
            
                var currency = "<?php echo CURRENCY; ?>";
        </script>
        <?php
        echo $this->Html->meta('icon');
        
        
        echo $this->Html->css(
                array(
                    'font-awesome.min',
                    'bootstrap.min',
                    'bootstrap-responsive.min',
                    'plugins/jquery-ui/smoothness/jquery-ui',
                    'plugins/jquery-ui/smoothness/jquery.ui.theme',
                    'plugins/pageguide/pageguide',
                    'plugins/fullcalendar/fullcalendar',
                    'plugins/fullcalendar/fullcalendar.print',
                    'plugins/tagsinput/jquery.tagsinput',
                    'plugins/multiselect/multi-select',
                    'plugins/datatable/TableTools',
                    'plugins/chosen/chosen',
                    'plugins/timepicker/bootstrap-timepicker.min',
                    'plugins/colorpicker/colorpicker',
                    'plugins/datepicker/datepicker',
                    'plugins/plupload/jquery.plupload.queue',
                    'style',
                    'themes',
                    'plugins/select2/select2',
                    'plugins/colorbox/colorbox',
                    'plugins/icheck/all',
					
                )
        );

      
        
        
        
        echo $this->Html->script(array(
                'jquery-min-2.0.2',
                'jquery-migrate-1.2.1.min',
                'admin',
                //'AdminLTE/app',
                )
        );
        ?>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min
        <![endif]-->

        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>

    </head>
    <body class="" >
        <?php echo $this->element('admin/header'); ?>
        <div class="container-fluid" id="content">
            
                <div id="content" class="container-fluid">
                    <?php echo $this->element('admin/left-sidebar'); ?>
                    <section style="padding-left:16%;">
                    <?php echo $this->Session->flash(); ?>
                    </section>
                    <section style="padding-left:16%;">
                        <?php echo $this->element('ajax_flash_message'); ?>
                    </section>
                    <div class="contant">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                    
                    
                </div>

            <?php echo $this->element('sql_dump'); ?>
        </div>
    </body>
</html>

<?php

echo $this->Html->script(array(
        
        'plugins/nicescroll/jquery.nicescroll.min',
        'plugins/imagesLoaded/jquery.imagesloaded.min',
        'plugins/jquery-ui/jquery.ui.core.min',
        'plugins/jquery-ui/jquery.ui.widget.min',
        'plugins/jquery-ui/jquery.ui.mouse.min',
        'plugins/jquery-ui/jquery.ui.resizable.min',
        'plugins/jquery-ui/jquery.ui.sortable.min',
        'plugins/jquery-ui/jquery.ui.spinner',
        'plugins/jquery-ui/jquery.ui.slider',
        'bootstrap.min',
        'plugins/colorbox/jquery.colorbox-min',
        'plugins/bootbox/jquery.bootbox',
        'plugins/maskedinput/jquery.maskedinput.min',
        'plugins/tagsinput/jquery.tagsinput.min',
        'plugins/datepicker/bootstrap-datepicker',
        'plugins/timepicker/bootstrap-timepicker.min',
        'plugins/colorpicker/bootstrap-colorpicker',
        'plugins/chosen/chosen.jquery.min',
        'plugins/multiselect/jquery.multi-select',
        'plugins/plupload/plupload.full',
        'plugins/plupload/jquery.plupload.queue',
        'plugins/fileupload/bootstrap-fileupload.min',
        'plugins/mockjax/jquery.mockjax',
        'plugins/select2/select2.min',
        'plugins/icheck/jquery.icheck.min',
        'plugins/complexify/jquery.complexify-banlist.min',
        'plugins/complexify/jquery.complexify.min',
        'application.min',
        'demonstration.min',

));
?>
<?php
################## data table jquery ################
echo $this->Html->script(array(

        
        'plugins/datatable/jquery.dataTables.min',
        'plugins/datatable/TableTools.min',
        'plugins/datatable/ColReorder.min',
        'plugins/datatable/ColVis.min',
        'plugins/datatable/jquery.dataTables.columnFilter',
        'eakroko.min',
        

));
################## data table jquery ################
?>
<!--[if lte IE 9]>
        plugins/placeholder/jquery.placeholder.min
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
	
	
	// Published date on new add/edit
	if($('.datepickpub').length > 0){
		$('.datepickpub').datepicker({
			 startDate: "today"
		}).on('changeDate', function(e){
			$(this).datepicker('hide');
		});
	}
        
        $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
        });
</script>

 








