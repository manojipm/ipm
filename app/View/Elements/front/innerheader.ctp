<section class="main">
    <div class="container">
		<div class="row">
			<div class="col-sm-12">
			  <div class="well girls-online">
				<div class="row">
				  <div class="col-md-8 col-sm-7">
					<ul class="girls-inner">
					  <?php 
						if(isset($this->params['prefix']) && $this->params['prefix'] == 'woman'){  
							echo $this->element('front/men_online');
						}else if(isset($this->params['prefix']) && $this->params['prefix'] == 'man'){  
							echo $this->element('front/girls_online');
						}						
					?>
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
					<?php 
						$panel = '';
						$role_id = $this->Session->read('Auth.User.role_id');						
						if($role_id == AGENCY_ID){
							$panel = 'agency/';
						}else if($role_id == MAN_ID){
							$panel = 'man/';
						}else if($role_id == WOMAN_ID){
							$panel = 'woman/';
						}
					?>
					  <li> <a href="#"> My Account </a> </li>
					  <li> <a href="<?php echo SITEURL; ?><?php echo $panel; ?>myprofile"> My Profile </a> </li>
					</ul>
					<?php if(isset($this->params['prefix']) && $this->params['prefix'] == 'man'){   ?>
					<ul class="link">
					  <li> Balance   2952 Credits </li>
					  <li> <a href="<?php echo SITEURL; ?>man/buycredits"> Buy Credits!</a> </li>
					</ul>
					<?php } ?>
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
            <li class="active"> <a href="<?php echo $dashboard; ?>">Dashboard</a> </li>
            <li> <a href="#"> Search </a> </li>
            <li> <a href="#">Chat</a> </li>
            <li> <a href="#">Messages </a> </li>
            <li> <a href="#">Favorites</a> </li>
            <li> <a href="#">Payment History </a> </li>
            <li> <a href="#">Notifications</a> </li>
            <li> <a href="#">News </a> </li>
            <li> <a href="#">Leave Review </a> </li>
            <li> <a href="<?php echo SITEURL; ?>logout">Logout </a> </li>
          </ul>
        </div>
            
        </div>
        