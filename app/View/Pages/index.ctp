<?php
$urlName = '';
$controller = $this->Html->url(array("controller" => "places", "action" => "sendUrlMail"));
$isoCodeUrl = $this->Html->url(array("controller" => "places", "action" => "setIsoCode"));
?>
<section id="main">
  <div class="popular-places">
  <input type="hidden" id="popular-places" value="<?php echo $controller?>" />
  <input type="hidden" id="isoCodeUrl" value="<?php echo $isoCodeUrl?>" />
    <div class="wrapper">
      <div class="container-fluid">
        	 <div class="row"> 
             	<!--<div class="signup_banner">
                <span><img src="img/signup_icon.png"></span>
                <p>Triparoom is the new way 
to find your perfect holiday</p>
                <a href="">Signup</a>
                </div>-->
             	<?php
				
				 if(isset($this->params['pass'][0])){
				 	echo $this->element('place-left-keyword');
				 }else{
					 echo $this->element('place-left');
				 }
				 ?>
                
                <section class="place_innder_right">
                		<article>
                        <h1>
                		<?php
						
						if($totalPlaces>0){  
							echo number_format($totalPlaces).'&nbsp;';
						}
						  
						if($keywordName!==''){
						  echo $keywordName;
						}
						?>                         
                        Places found
                        
                       
						
                         <?php
						
						
                        if($cityName!==''){
						  echo 'in&nbsp;'.$cityName;
						}
                        if($countryName!==''){
						  echo 'in&nbsp;'.$countryName;
						}
                        ?>
                        
							</h1>
                            
                            	<div class="popular-travel-places">
                                
                                	<div class="nav-container">
                                     <label class="responsive_menu" for="responsive_menu"></label>
                                      <input id="responsive_menu" type="checkbox">
									<?php
                                    if(!isset($this->params['pass'][0])){
                                    ?>
                                    <?php //echo $this->element('hit-count-keywords');?>
                                    <?php
                                    }
                                    ?>
                                  
                                    <div class="popular-travel-bottom">
                                    		<div class="select">
                                    	   		<?php echo $this->Form->create('Place',array('type'=>'file')); ?>
                                    		
                                            	<?php echo $this->Form->input('filters', array('type'=>'select','options'=>$filters, 'label' => false,'div'=>false,'required'=>true));?>
                                             	<?php	echo $this->Form->end();?>
                                             </div>
                                           
                                            <div class="Popular-size">
                                            	<ul>
                                               <?php 
											   $setLayout = $this->Html->url(array("controller" => "places", "action" => "setLayout",));
											   $slug='';											   	
											   ?>
                                                	<li class="active"><?php echo $this->Html->link('',array('controller'=>'pages','action'=>'display',$slug),array('class'=>'size-s layoutTypeSearch','data-id'=>'places-s','data-rel'=>$setLayout));?></li>
                                                    <li><?php echo $this->Html->link('',array('controller'=>'pages','action'=>'display',$slug),array('class'=>'size-m layoutTypeSearch','data-id'=>'places-m','data-rel'=>$setLayout));?></li>
                                                    <li><?php echo $this->Html->link('',array('controller'=>'pages','action'=>'display',$slug),array('class'=>'size-l layoutTypeSearch','data-id'=>'places-l','data-rel'=>$setLayout));?></li>
                                                    <li class="active"><?php echo $this->Html->link('',array('controller'=>'pages','action'=>'/',$slug),array('class'=>'size-xl layoutTypeSearch','data-id'=>'places-x','data-rel'=>$setLayout));?>
                                                    </li>
                                                   <li>
													
													<?php
											 
										$controller3 = $this->Html->url(array("controller" => "places", "action" => "detail"));
														
										$placeSlug = (isset($places[0]['Place']['slug'])) ? $places[0]['Place']['slug'] : '';
										$controller4 = $this->Html->url(array("controller" => "places", "action" => "detail", $placeSlug));
		
								echo ( isset($places) && !empty($places)) ?
									$this->Html->image('f.png',array('alt'=>'logo','data-id'=>$controller4 ,'data-rel'=>$controller3,'class'=>'placeMainImage')) : 
									$this->Html->image('f.png',array('alt'=>'logo','data-id'=>'' ,'data-rel'=>'','class'=>'placeMainImage'));
									
													
													?></li>
                                                </ul>
                                            </div>
                                    </div>
                                    </div>
                        	</div>
                            
                           <div class="popular-travel-post">
                           		<ul id="placesList">
                                <?php
								if(!empty($places)){ 
								foreach($places as $data){
								?>	
                                    <li>
                                    	<div class="thumb">
                                         <?php
										$controller = $this->Html->url(array("controller" => "places", "action" => "detail"));
										$controller2 = $this->Html->url(array("controller" => "places", "action" => "detail",$data['Place']['slug']));
										 if(isset($data['PlaceImage'][0]['image'])){
										 echo $this->Html->image('uploads/places/490/'.$data['PlaceImage'][0]['image'],array('alt'=>'logo','data-id'=>$controller2 ,'data-rel'=>$controller,'class'=>'placeMainImage'));
										 }else{
											echo $this->Html->image("image_placeholder_300x300.png",array('alt'=>'Image Placeholder', 'class'=>'placeholder' )); 
										 }
										 
										 ?>
                                        <div class="thubm-hover-link">
                                        	<?php
										
										$data['Place']['url'];
										$pos = strpos($data['Place']['url'],'http');
										
										if($pos < 0){
											$pos = 'http//'.$pos;
										}else{
											$pos = $data['Place']['url'];	
										}
										
										
										?>
                                            <ul>
                                        <!--	<li class="yello-button"><a href="">Save</a></li>-->
                                            <li  class="blue-button"><a class="sendMail" data-rel="http://<?php echo $_SERVER['HTTP_HOST']; echo Router::url(array('controller'=>'places','action'=>'details',$data['Place']['slug']));?>" data-id="<?php echo $data['Place']['title'] ?>"><?php echo $this->Html->image('email_big.png',array('alt'=>'logo' )) ;?> Email</a></li>
                                            <?php
if( $data['Place']['is_hotel']!='none' && $data['Place']['is_hotel']!=''){

$urlData = '';

if( $data['Place']['code_priority']=='1'){
	//$urlName = $data['Place']['code_widget'];
					$urlName = $data['Place']['url'];
}else{
		$urlName = $data['Place']['url'];
}
if(!strpos($urlName,'ttp')>0){
					$urlName = 'http://'.$urlName;
				}
?>
<li  class="blue-button">
    <a href="<?php echo $urlName;?>" target="_blank">
        <?php
		 if( $data['Place']['is_hotel']=='hotel'){
			 echo $this->Html->image('book.png',array('alt'=>'logo')).' Book';
		 }else{
			echo $this->Html->image('find.png',array('alt'=>'logo')).' Find'; 
		 }
		 ?>
    </a>
</li>
<?php
}
?>
                                            </ul>
                                            
                                        </div>
                                        </div>
                                        <div class="content">
                                        <div class="small-title">
                                        <span class="small-thumb"><?php echo $this->Html->image('places_small_thumb.jpg',array('alt'=>''));?></span>
                                        <div class="small-title-content">
                                        <span><?php echo $adminTitle['Settings']['value'];?></span>
                                        
                                        <?php //echo $this->Html->link($data['Place']['title'],array('controller'=>'places','action'=>'detail',$data['Place']['slug']));?>
                                        
                                         </div>
                                         
                                         
                                        </div>
                                        <div class="clearBoth"></div>
                                        <div class="mainTitle">
                                        <a data-id="<?php echo $controller2;?>" data-rel="<?php echo $controller;?>" class="placeMainImage" ><?php echo $data['Place']['title'];?></a>
                                        </div>
                                       
                                       <?php /*?> <div class="tripideas">
                                        <span>Places</span> 
                                        <div class="arrow_box">
                                        <span>1,087</span>
                                        </div>
                                        </div><?php */?>
                                        <p><?php echo $data['Place']['short_description'];?></p>
										
                                         <div class="social-links"> 
                                                    <span class="facebookicone"><a href=""><i class="fa fa-facebook"></i> </a></span>
                                                    <span class="twittericone"><a href=""><i class="fa fa-twitter"></i> </a></span>
                                                    <span class="emailicone"><a href=""><i class="fa fa-envelope"></i> </a></span>
                                                    <span class="emailtext"><a class="sendMail"  data-rel="http://<?php echo $_SERVER['HTTP_HOST']; echo Router::url(array('controller'=>'places','action'=>'details',$data['Place']['slug']));?>" data-id="<?php echo $data['Place']['title'] ?>">Email</a></span>
                                                   <?php								
if( $data['Place']['is_hotel']!='none' && $data['Place']['is_hotel']!=''){
	?>
                                                    <span class="blue-button book-button place-book-button"> <a href="<?php echo $urlName;?>" target="_blank">
        <?php
		 if( $data['Place']['is_hotel']=='hotel'){
			 echo $this->Html->image('s-book.png',array('alt'=>'logo')).' Book';
		 }else{
			echo $this->Html->image('s-find.png',array('alt'=>'logo')).' Find'; 
		 }
		 ?>
    </a></span>
     <?php 
   }
	?> 
                                            </div>
                                       
                                        </div>
                            		</li>
                                <?php
								}
								}else{
							echo '<p style="color:#F00;">No record found !!!<p>';	
							}	
								?>    
                                  
                                </ul>
                           </div>
							
						   
                        <div class="pagination">
                        <ul>
                        <?php
							//echo $paging;
						?>
                        </ul>
                        </div>
						
                        </article>
               </section>
                
             </div>
    </div>
  </div>
  
  </div>
</section> 
<div class="clear-both"></div>

<?php

if(isset($this->params['pass'][0])){
	$paramOne = $this->params['pass'][0].'/';	
}else{
	$paramOne = 'index/';
}
if (!$isAjax){ ?>

<?php

$maxPage = $this->Paginator->counter('%pages%');

if($maxPage>1){
?>
<div id="lastPostsLoader" class="hide_placeloader_loader">
   <?php echo $this->Html->image('ajax-loader1.gif',array('alt'=>'loader'));?>
</div>
<?php
}
?>

<script type="text/javascript">
var lastX = 0;
var currentX = 0;
var page = 1;

$(window).scroll(function () {
	if (page < <?php echo $maxPage; ?>) {
		currentX = $(window).scrollTop(); 
		
		if ((currentX - lastX) > (2000 * page)) {
			$('#lastPostsLoader').removeClass('hidetripidealoader');
			$('#lastPostsLoader').addClass('showtripidealoader');
			lastX = currentX;
			page++;
			$.get('<?php echo Router::url(array('controller'=>'places'));?>/<?php echo $paramOne;?>page:' + page, function(data) {
			$('#placesList').append(data);
			$('#lastPostsLoader').removeClass('showtripidealoader');
			$('#lastPostsLoader').addClass('hidetripidealoader');			
			});
			
		}
	}
});
</script>
<?php
}
?>