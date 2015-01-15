<?php if(isset($sliders) && !empty($sliders)){ ?>
<section class="banner">
	<div class="container">
	  <div id="slider" class="flexslider">
		<ul class="slides">
		<?php foreach($sliders as $slider){
				$slider_img = $slider['Slider']['slider_image']; ?>
		  <li> <img src="<?php echo SITEURL; ?>uploads/slider_images/<?php echo $slider_img; ?>" alt="slider" /> </li>
		 <?php } ?>
		</ul>
	  </div>
	</div>
</section>
<?php } ?>