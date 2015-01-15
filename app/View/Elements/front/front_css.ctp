<?php 
	echo $this->fetch('css');
	echo $this->Html->css(array('front/bootstrap','front/flexslider', 'plugins/datepicker/datepicker','front/font-awesome','plugins/select2/select2','plugins/colorbox/colorbox','front/slicknav','front/style','front/custom'));
	// Jquery Min will be load on top
	echo $this->HTML->script(array('front/jquery-1.11.1.min'));
?>
<script>
	var siteurl = '<?php SITEURL; ?>';
</script>