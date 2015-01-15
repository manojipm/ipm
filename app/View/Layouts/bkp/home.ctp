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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Date Your with Your love</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<!--[if IE]>  
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>  
<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<?php echo $this->element('front/front_css'); ?>
</head>
<body>
<div class="page">
	<?php 
		echo $this->element('front/header'); 
		echo $this->element('front/banner');
		echo $this->element('front/feature-banner');
	?>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('front/footer'); ?>
</div>
<?php echo $this->element('front/front_js'); ?>
<script type="text/javascript">
    $(window).load(function(){
      $('#slider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script> 
<script type="text/javascript">
  
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 160,
        itemMargin: 35,
        minItems: 2,
        maxItems: 4,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
	
	
	jQuery(document).ready(function () {
		$("#Agencyregistration").colorbox({inline:true, width:"50%"});        
    });
	
	
  </script>
</body>
</html>