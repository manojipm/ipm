<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
function initialize()
{
var mapProp = {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:7,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
	#googleMap img{max-width:10000px;}
</style>
<section id="main" class="home-page content-page">
<section class="slider contactmap">

<div id="googleMap" style="width:1150px;height:380px;"></div>

</section>
  <div class="home">
    <div class="wrapper">
      <div class="container-fluid">
        <div class="row">
          <section class="pages_inner_left">
           
            <div class="content">
            	<div id="contact-form">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                        <h2 class="panel-title">
                        Contact Us</h2>
                        </div>
                        <div class="panel-body">
                         <?php echo $this->Form->create('Page'); ?>
                        <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputName">Name</label>
                               
                        <div class="col-lg-10">
                       <?php echo $this->Form->input('name',array('div'=>false,'label'=>false,'class'=>'form-control')); ?>
                                </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputEmail1">Email</label>
                               
                        <div class="col-lg-10">
                        <?php echo $this->Form->input('email',array('div'=>false,'label'=>false,'class'=>'form-control')); ?>
                                </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputSubject">Subject</label>
                               
                        <div class="col-lg-10">
                       <?php echo $this->Form->input('subject',array('div'=>false,'label'=>false,'class'=>'form-control')); ?>
                                </div>
                        </div>
                        <div class="form-group">
                        <label class="col-lg-2 control-label" for="inputPassword1">Message</label>
                               
                        <div class="col-lg-10">
                        <?php echo $this->Form->input('message',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control')); ?>
                                </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-default" type="submit">
                                  Send Message
                                 </button>
                                </div>
                        </div>
                        </form>
                        </div>
                        </div>
                </div>
            </div>
          </section>
          <aside class="pages_inner_right">
            <div class="sidebar">
              <div class="right_block find-trip-block">
                <div class="title">
                  <h1>Find your Perfect Trip</h1>
                </div>
                <ul>
                 <li><a href="#"><span class="trip-icons"><?php echo $this->Html->image('trip-icon-1.png',array('alt'=>''));?></span>Browse thousands of places by theme and holiday type <i class="fa fa-angle-right"></i></a></li>
                  <li><a href="#"><span class="trip-icons"><?php echo $this->Html->image('trip-icon-2.png',array('alt'=>''));?></span>Browse thousands of places by theme and holiday type <i class="fa fa-angle-right"></i></a></li>
                </ul>
              </div>
              <div class="right_block latest-photo-block">
                <div class="title">
                  <h1>Latest Photos <i class="fa fa-angle-right"></i></h1>
                </div>
                <ul >
                  <?php foreach ($latestPlaces as $datas){ ?>
                  <li>
                    <div class="thumb">
                    <?php
										$controller = $this->Html->url(array("controller" => "places", "action" => "detail"));
										$controller2 = $this->Html->url(array("controller" => "places", "action" => "detail",$datas['Place']['slug']));
										 if(isset($datas['PlaceImage'][0]['image'])){
										 echo $this->Html->image('uploads/places/60x60/'.$datas['PlaceImage'][0]['image'],array('alt'=>'logo','data-id'=>$controller2 ,'data-rel'=>$controller,'class'=>'placeMainImage'));
										 }else{
											 echo $this->Html->image('popular_places_thumb_01.jpg',array('alt'=>'logo')); 
										 }
						 
						 ?>
                      </div>
                    
                    </li>
                <?php } ?>
                <li><div class="seemore"><?php echo $this->Html->link('See More', array('controller'=>'places','action'=>'/'));?></div></li>
                </ul>
              </div>
              <div class="right_block browse-photo-block">
                <div class="title">
                  <h2>Browse Places <i class="fa fa-angle-right"></i></h2>
                </div>
                <p><?php foreach ($hitCountKeywords as $datas){ ?>
  
    <?php echo $this->Html->link($datas['Keyword']['keyword'],array('controller'=>'places','action'=>'/',$datas['Keyword']['slug']));?> &middot;   
    <?php }?></p>
              </div>
              <?php /*?><div class="sidebar_footer">
              		<div class="country-list">
                      <ul>
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'display','home'));?>">Home</a></li>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'display','privacy-policy'));?>">Privacy Policy</a></li>
                        
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'display','about-us'));?>">About us</a></li>
                        
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'#'));?>">Places</a></li>
                        
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'display','terms-of-use'));?>">Terms of Use</a></li>
                    </ul>
                    <ul>
                        <li><a href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'display','contact-us'));?>">Contact Us</a></li>
                        <li><a href="<?php echo Router::url(array('controller'=>'tripideas', 'action'=>'index'));?>">Tripideas</a></li>
                        <li><a href="#">Site map</a></li>
                        <li><a href="#">Maldives</a></li>
                        <li><a href="#">Spain</a></li>
                        <li><a href="#">Venezuela</a></li>
                    </ul>
              </div>
              <!--	<div class="social-links">
                	<ul class="">
                    <li class="fb"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="twtr"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="ggl"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li class="print"><a href="#"><i class="fa fa-print"></i></a></li>
                    <li class="email"><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
               <p class="copyright">Copyright &copy; 2013 Triparoom.com<sup>&#8482;</sup>. 
All rights reserved. </p>-->
            </div><?php */?>
    </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</section>