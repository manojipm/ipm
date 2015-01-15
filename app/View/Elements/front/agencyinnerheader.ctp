<section class="main">
    <div class="container">
		<div class="row">
			<div class="col-sm-12">
			  <div class="well girls-online">
				<div class="row">
				  <div class="col-md-8 col-sm-7">
					<ul class="girls-inner">
					  
					</ul>
				  </div>
				  <?php 
						$name = $this->Session->read('Auth.User.UserProfile.nickname');
						if(empty($name))
						$name = $this->Session->read('Auth.User.UserProfile.first_name');						
				  ?>
				  
				  <div class="col-md-4 col-sm-5 abt-profile">
					<p>Welcome <span class="red nickname"><?php echo $name; ?> </span></p>
					<ul class="link black">
					  <li> <a href="<?php echo SITEURL; ?>agency/myaccount"> My Account </a> </li>
					  <li> <a href="<?php echo SITEURL; ?>agency/myprofile"> My Profile </a> </li>
					</ul>
					<ul class="link">
					  <li> Commission:  $278.00 </li>
					</ul>
					<ul class="social">
					  <li> <a href="#"> <i class="fa fa-facebook"></i> </a> </li>
					  <li> <a href="#"> <i class="fa fa-twitter"></i> </a> </li>
					  <li> <a href="#"> <i class="fa fa-google-plus "></i> </a> </li>
					</ul>
				  </div>
				</div>
				<div class="clearfix"></div>
			  </div>
        </div>
        </div>
        <div class="row" id="menu">
        <div class="col-sm-12" >
			<?php 
				$dashboard = '#';
				if ($this->Session->read('Auth.User')) {
					$role_id = $this->Session->read('Auth.User.role_id');
					if ($role_id == MAN_ID) {
						$dashboard = SITEURL.'man';
					} else if ($role_id == WOMAN_ID) {
						$dashboard = SITEURL.'woman';
					} else if ($role_id == AGENCY_ID) {
						$dashboard = SITEURL.'agency';
					}
				}
				?>
		
          <ul class="my-navigation">
            <li> <a href="#">Date Requests</a> </li>
            <li> <a href="#"> Contact Requests </a> </li>
            <li> <a href="#">Gifts Delivery</a> </li>
            <li> <a href="#">Finance </a> </li>
            <li class="active"> <a href="<?php echo SITEURL; ?>agency">Profiles</a> </li>
            <li> <a href="#">Penalty </a> </li>
            <li> <a href="#">News</a> </li>
            <li> <a href="#">Messages </a> </li>
            <li> <a href="#">FAQs </a> </li>
            <li> <a href="<?php echo SITEURL; ?>logout">Logout </a> </li>
          </ul>
        </div>
        </div>
        