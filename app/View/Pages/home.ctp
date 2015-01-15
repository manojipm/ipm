<section class="main">
    <div class="container">
      <div class="row">
		<?php if ($this->Session->read('Auth.User') && $this->Session->read('Auth.User.role_id') != AGENCY_ID ){ ?>
				<div class="<?php if($this->Session->read('Auth.User.role_id') == WOMAN_ID){ ?> col-md-9 <?php  }else{ ?>col-md-6 <?php } ?>col-md-push-3 col-sm-12 col-sm-push-0">
             	<!------------------ Cards/gifts Details ---------------------->
				 <?php if(isset($pages) && !empty($pages)){ ?>
				  <ul class="Romance row">
				  <?php foreach($pages as $page){ ?>
					<li class="col-sm-6">
					  <h5><a href="#"><?php echo $page['Page']['name']; ?></a> </h5>
					  <div class="img-bdr-left">
						<?php
						if(isset($page['Page']['image']) && !is_array($page['Page']['image']) && !empty($page['Page']['image'])  && file_exists(WWW_ROOT . 'uploads' . DS . 'page_images' . DS . $page['Page']['image'])){
							echo $this->Html->Image('../uploads/page_images/' . $page['Page']['image'], array('height' => 100, 'width' => 100));
						}else{ 
							echo $this->Html->Image('no-image.jpg', array('height' => 100, 'width' => 100));
						 }	?>
					  
					  </div>
					  <?php echo substr(strip_tags($page['Page']['content']),0, 251).'...'; ?>
					</li>
					<?php } ?>
				  </ul>
				  <?php } ?>
				  
				  <?php if(isset($news) && !empty($news)){ ?>
				  <div class="news-cell">
					<h4>News</h4>
					<ul>
					<?php foreach($news as $val){ ?>
					  <li><a href="#" class="img-left"> 
							<?php
								if(isset($val['News']['news_image']) && !is_array($val['News']['news_image']) && !empty($val['News']['news_image'])  && file_exists(WWW_ROOT . 'uploads' . DS . 'news_images' . DS . $val['News']['news_image'])){
									echo $this->Html->Image('../uploads/news_images/' . $val['News']['news_image'], array('height' => 170, 'width' => 170));
								}else{ 
									echo $this->Html->Image('no-image.jpg', array('height' => 170, 'width' => 170));
								 }	
							?>
					  </a>
						<h5><a href="#"> <?php echo $val['News']['title']; ?> </a> </h5>
						<?php echo substr(strip_tags($val['News']['description']),0, 251).'...'; ?>
					  </li> 
					<?php } ?>				  
					</ul>
					<a href="#" class="btn btn-danger pull-right">View All</a>
				</div>
				<?php } ?>
				</div>
			<?php 
				if ($this->Session->read('Auth.User.role_id') == MAN_ID){
					/**************** Online Girls ******************/
					echo $this->element('front/onlinegirls_sidebar'); 
					/**************** Top Brides ******************/
					echo $this->element('front/topbrides_sidebar');
				}else if($this->Session->read('Auth.User.role_id') == WOMAN_ID){
					/**************** Online Girls ******************/
					echo $this->element('front/onlinemen_sidebar'); 
				}
			?>
		<?php }else{ ?>
		
			<?php if(isset($news) && !empty($news)){ ?>
			<div class="col-sm-6">
				<div class="news-cell">
				<h4>News</h4>
				<ul>
				<?php foreach($news as $val){ ?>
				  <li> <a href="#"> 
				  <?php
						if(isset($val['News']['news_image']) && !is_array($val['News']['news_image']) && !empty($val['News']['news_image'])  && file_exists(WWW_ROOT . 'uploads' . DS . 'news_images' . DS . $val['News']['news_image'])){
							echo $this->Html->Image('../uploads/news_images/' . $val['News']['news_image'], array('height' => 170, 'width' => 170,'class'=>'img-left'));
						}else{ 
							echo $this->Html->Image('no-image.jpg', array('height' => 170, 'width' => 170,'class'=>'img-left'));
						 }	
					?></a>
					<h5><a href="#"> <?php echo $val['News']['title']; ?> </a> </h5>
					<?php echo substr(strip_tags($val['News']['description']),0, 251).'...'; ?>
				  </li>
				<?php } ?>
				</ul>
				<a href="#" class="btn btn-danger pull-right">View All</a> 
				</div>
			</div>
			<?php } ?>
			
			<?php if(isset($testimonials) && !empty($testimonials)){ ?>
			<div class="col-sm-6">
			  <div class="test-cell">
				<h4>Testimonials</h4>
				<ul>
					<?php foreach($testimonials as $val){ ?>
						<li> <a href="#"> 
							<?php 
								$id = $val['User']['id'];  
								$profilePic = $this->Common->profilePic($id);
								 if (isset($profilePic) && !empty($profilePic)  && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $profilePic)) {
									echo $this->Html->Image('../uploads/user_images/' . $profilePic, array('class'=>"img-left", 'height' => 170, 'width' => 170));
								 }else{
									echo $this->Html->Image('no-image.jpg', array('class'=>"img-left",'height' => 170, 'width' => 170));
								 }
							?>
						</a>
							<p> <i class="fa fa-quote-left"></i> &nbsp; <?php echo substr(strip_tags($val['Testimonial']['description']),0, 250); ?> &nbsp; <i class="fa fa-quote-right"></i></p>
							<h6>- By <?php if(isset($val['User']['UserProfile']['first_name']) && !empty($val['User']['UserProfile']['first_name'])){
								echo $val['User']['UserProfile']['first_name'];
							} ?></h6>
						</li>
				  <?php } ?>
				</ul>
				<a href="#" class="btn btn-danger pull-right">View All</a> </div>
			</div>
		  <?php } ?>
	<?php } ?>
	  </div>
    </div>
  </section>
  
  <div style='display:none'>
        <div id='Agencyregistration' style='padding:10px; background:#fff;'>
        hi nfgjkldfsjkgk
        </div>
</div>