<script>
    jQuery(document).ready(function () {
		 <!--------- Popup box of all photo gallary  ----------->
		$(".colorbox-image").length>0&&$(".colorbox-image").colorbox({maxWidth:"90%",maxHeight:"90%",rel:$(this).attr("rel")});
       
	   <!--------- Popup box of Add Gifts and love melody  ----------->
	   $(".virtualgift").colorbox({inline:true, width:"50%"});
        <!--------- Edit Virtual Gift  ----------->
		$(".inline_edit_content").colorbox({inline:false, width:"50%"});
		<!--------- Edit Love Melody  ----------->
        $(".inline_edit_melody").colorbox({inline:false, width:"50%"});
		<!---------  Edit Romance Card  ----------->
        $(".inline_edit_romance").colorbox({inline:false, width:"50%"});
		<!--------- View Love Melody ----------->
        $(".inline_view_melody").colorbox({inline:false, height:"40%", width:"50%"});
		<!---------  Edit Real Gifts  ----------->
        $(".inline_edit_real").colorbox({inline:false, width:"50%"});
    });
	$(document).ready(function(){
		active_tab = window.location.hash;
		$(active_tab+'_tab a').trigger('click');
	});
	
</script>
<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Products</a>
                </li>
            </ul>
            <div class="close-bread">
                <a href="#">
                    <i class="icon-remove"></i>
                </a>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3>
                            <i class="icon-th-list"></i>
                            Products - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
						<div class="box-content nopadding">
							<ul class="tabs tabs-inline tabs-top">
								<li class='active' id="virtual_tab">
									<a href="#virtualtab" onclick="window.location.hash = 'virtual';" data-toggle='tab'><i class="fa fa-gift"></i> Virtual Gifts</a>
								</li>
								<li  id="real_tab" >
									<a href="#realgiftstab" onclick="window.location.hash = 'real';" data-toggle='tab'><i class="fa fa-gift"></i> Real Gifts</a>
								</li>
								<li  id="love_tab">
									<a href="#melodystab" onclick="window.location.hash = 'love';" data-toggle='tab'><i class="fa fa-gift"></i>Love Melodies</a>
								</li>
								<li  id="romance_tab">
									<a href="#romancetab" onclick="window.location.hash = 'romance';" data-toggle='tab'><i class="fa fa-gift"></i> Romance Cards</a>
								</li>
							</ul>
							<div class="tab-content padding tab-content-inline tab-content-bottom">
								<div class="tab-pane active" id="virtualtab">
									<div class="nopadding" id="products">
										<div class="highlight-toolbar">
											<div class="pull-left">
												
											</div>
											<div class="pull-right">
												<div class="btn-toolbar">
													<div class="btn-group">
														<a href="#inline_content" class="btn btn-danger virtualgift" rel="virtualadd" ><i class="icon-cloud-upload"></i> Add Virtual Gift</a>
													</div>
												</div>
											</div>
										</div>
										<ul class="gallery">
										<?php if(isset($virtualGifts) && !empty($virtualGifts)){ 
											foreach($virtualGifts as $gifts){
										?>
											<li>
												<a href="#">
													<img src="<?php echo SITEURL. VIRPRODUCT_THUMB_FILE_PATH; ?><?php echo '/'.$gifts['Product']['image_file']; ?>" width="188" height="145" alt="">
												</a>
												<div class="extras" rel="tooltip" title="<?php echo $gifts['Product']['name']; ?>">
													<div class="extras-inner">
														<a href="<?php echo SITEURL. VIRPRODUCT_FILE_PATH; ?><?php echo '/'.$gifts['Product']['image_file']; ?>" class='colorbox-image' rel="virtual"><i class="icon-search"></i></a>
														<a href="<?php echo SITEURL; ?>admin/products/edit_virtual_gifts/<?php echo $gifts['Product']['id']; ?>" class="inline_edit_content" rel="virtualedit"><i class="icon-pencil"></i></a>
														<a href="javascript:void(0)" onclick="if(confirm('Are you sure, you would like to remove this gift?')){  window.location.href='<?php echo SITEURL; ?>admin/products/delete_virtual_gifts/<?php echo $gifts['Product']['id']; ?>' }" ><i class="icon-trash"></i></a>
													</div>
												</div>
											</li>
										<?php 
											}
										}else{ ?>
											<li>
												<span>No Virtual Gift Founds!!!</span>
											</li>
										<?php } ?>
										</ul>
									</div>
								</div>
								
								<div class="tab-pane" id="realgiftstab">
									<div class="nopadding" id="products">
										<div class="highlight-toolbar">
											<div class="pull-left">
												
											</div>
											<div class="pull-right">
												<div class="btn-toolbar">
													<div class="btn-group">
														<a href="#inline_real" class="btn btn-danger virtualgift" rel="realgift" ><i class="icon-cloud-upload"></i> Add Real Gift</a>
													</div>
												</div>
											</div>
										</div>
										<ul class="gallery">
										<?php if(isset($realGifts) && !empty($realGifts)){ 
											foreach($realGifts as $gift){
										?>
											<li>
												<a href="#">
													<img src="<?php echo SITEURL. REALPRODUCT_THUMB_FILE_PATH; ?><?php echo '/'.$gift['Product']['image_file']; ?>" width="190" height="145" alt="">
												</a>
												<div class="extras" rel="tooltip" title="<?php echo $gift['Product']['name']; ?>">
													<div class="extras-inner">
														<a href="<?php echo SITEURL. REALPRODUCT_FILE_PATH; ?><?php echo '/'.$gift['Product']['image_file']; ?>" class='colorbox-image' rel="real"><i class="icon-search"></i></a>
														<a href="<?php echo SITEURL; ?>admin/products/edit_realgifts/<?php echo $gift['Product']['id']; ?>" class="inline_edit_real" rel="realedit"><i class="icon-pencil"></i></a>
														<a href="javascript:void(0)" onclick="if(confirm('Are you sure, you would like to remove this gift?')){  window.location.href='<?php echo SITEURL; ?>admin/products/delete_realgifts/<?php echo $gift['Product']['id']; ?>' }" ><i class="icon-trash"></i></a>
													</div>
												</div>
											</li>
										<?php 
											}
										}else{ ?>
											<li>
												<span>No Real Gift Founds!!!</span>
											</li>
										<?php } ?>
										</ul>
									</div>
								</div>
								
								<div class="tab-pane" id="melodystab">
									<div class="highlight-toolbar">
											<div class="pull-left">
												
											</div>
											<div class="pull-right">
												<div class="btn-toolbar">
													<div class="btn-group">
														<a href="#inline_melody" class="btn btn-danger virtualgift" rel="love" ><i class="icon-cloud-upload"></i> Add Love Melody</a>
													</div>
												</div>
											</div>
										</div>
										<ul class="gallery">
										<?php if(isset($melodys) && !empty($melodys)){ 
											foreach($melodys as $melody){
										?>
											<li>
												<a href="#" target="_blank">
													<img src="<?php echo SITEURL; ?>img/music_icon.png" width="158" height="125" alt="">
												</a>
												<div class="extras" rel="tooltip" title="<?php echo $melody['Product']['name']; ?>">
													<div class="extras-inner">
														<a href="<?php echo SITEURL; ?>admin/products/view_melody/<?php echo $melody['Product']['id']; ?>" class='inline_view_melody' ><i class="icon-search"></i></a>
														<a href="<?php echo SITEURL; ?>admin/products/edit_melody/<?php echo $melody['Product']['id']; ?>" class="inline_edit_melody" rel="loveedit" ><i class="icon-pencil" ></i></a>
														<a href="javascript:void(0)" onclick="if(confirm('Are you sure, you would like to remove this melody?')){  window.location.href='<?php echo SITEURL; ?>admin/products/delete_melody/<?php echo $melody['Product']['id']; ?>' }" ><i class="icon-trash"></i></a>
													</div>
												</div>
											</li>
										<?php 
											}
										}else{ ?>
											<li>
												<span>No Love Melody Founds!!!</span>
											</li>
										<?php } ?>
										</ul>
								</div>
								
								<div class="tab-pane" id="romancetab">
									<div class="nopadding" id="products">
										<div class="highlight-toolbar">
											<div class="pull-left">
												
											</div>
											<div class="pull-right">
												<div class="btn-toolbar">
													<div class="btn-group">
														<a href="#inline_romance" class="btn btn-danger virtualgift" rel="romanceadd" ><i class="icon-cloud-upload"></i> Add Romance Card</a>
													</div>
												</div>
											</div>
										</div>
										<ul class="gallery">
										<?php if(isset($romances) && !empty($romances)){ 
											foreach($romances as $romance){
										?>
											<li>
												<a href="#">
													<img src="<?php echo SITEURL. ROMANCEPRODUCT_THUMB_FILE_PATH; ?><?php echo '/'.$romance['Product']['image_file']; ?>" width="190" height="145" alt="">
												</a>
												<div class="extras" rel="tooltip" title="<?php echo $romance['Product']['name']; ?>">
													<div class="extras-inner">
														<a href="<?php echo SITEURL. ROMANCEPRODUCT_FILE_PATH; ?><?php echo '/'.$romance['Product']['image_file']; ?>" class='colorbox-image' rel="romance"><i class="icon-search"></i></a>
														<a href="<?php echo SITEURL; ?>admin/products/edit_romance/<?php echo $romance['Product']['id']; ?>" class="inline_edit_romance" rel="romanceedit"><i class="icon-pencil"  ></i></a>
														<a href="javascript:void(0)" onclick="if(confirm('Are you sure, you would like to remove this romance card?')){  window.location.href='<?php echo SITEURL; ?>admin/products/delete_romance/<?php echo $romance['Product']['id']; ?>' }" ><i class="icon-trash"></i></a>
													</div>
												</div>
											</li>
										<?php 
											}
										}else{ ?>
											<li>
												<span>No Romance Card Founds!!!</span>
											</li>
										<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------- Add Virtual Gift  ----------->
<div style='display:none'>
        <div id='inline_content' style='padding:10px; background:#fff;'>
        <?php include 'admin_add_virtual_gifts.ctp';?>
        </div>
</div>
<!--------- Add Virtual Gift  ----------->

<!--------- Add Love Melody  ----------->
<div style='display:none'>
        <div id='inline_melody' style='padding:10px; background:#fff;'>
        <?php include 'admin_add_melody.ctp';?>
        </div>
</div>
<!--------- Add Love Melody  ----------->

<!--------- Add Romance Card  ----------->
<div style='display:none'>
        <div id='inline_romance' style='padding:10px; background:#fff;'>
        <?php include 'admin_add_romance.ctp';?>
        </div>
</div>
<!--------- Add Romance Card  ----------->

<!--------- Add Real Gift  ----------->
<div style='display:none'>
        <div id='inline_real' style='padding:10px; background:#fff;'>
        <?php include 'admin_add_realgifts.ctp';?>
        </div>
</div>
<!--------- Add Real Gift  ----------->
