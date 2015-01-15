<div role="navigation" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="<?php echo SITEURL; ?>">Home</a></li>
			<li><a href="#about">About Us</a></li>
			<li><a href="#contact">Contact Us</a></li>
			<li class="red-active"><a href="#">Services</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<?php 
		if ($this->Session->read('Auth.User')) {
			$role_id = $this->Session->read('Auth.User.role_id');
            // Check login user's role and redirected to their dashboard page
            if ($role_id == MAN_ID) {
                $dashboard = SITEURL.'man';
            } else if ($role_id == WOMAN_ID) {
                $dashboard = SITEURL.'woman';
            } else if ($role_id == AGENCY_ID) {
                $dashboard = SITEURL.'agency';
            }
			?>
			<?php if(!isset($this->params['prefix'])){  ?>
			<li class="red-active"><a href="<?php echo $dashboard; ?>">My Account</a></li>
			<?php } ?>
		<?php }else{ ?>
			<li><a href="<?php echo SITEURL; ?>login">Login</a></li>
			<li class="red-active"><a href="<?php echo SITEURL; ?>registration">Free Registration</a></li>
		<?php } ?>
			
		</ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
  </div>