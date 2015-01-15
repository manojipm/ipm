<?php 
	if(isset($this->data['User']['type'])){
		$email = 0;
		$password = 0;
		if($this->data['User']['type'] == 'email'){
			$email = 1;
		}else if($this->data['User']['type'] == 'password'){
			$password = 1;
		}
	} 
?>

<section class="main">
	<div class="container">
	  <div class="row">
		<div class="col-sm-12">
		  	<div class=" panel panel-primary noborder no-box-shadow">
				<div class="panel-heading">
					<h3  class="panel-title pull-left">My Account </h3>
				</div>
				
				<div class="panel-body nopadding table-acroller">
					<ul class="nav nav-tabs">
						<li id="password_tab" class="active"  ><a onclick="window.location.hash = 'password'" data-toggle="tab" href="#change_password">Change Password</a></li>
						<li id="email_tab" <?php // ?> class="acstive" <?php //} ?> ><a onclick="window.location.hash = 'email'" data-toggle="tab" href="#change_email">Change Email</a></li> 
					</ul>
					<div class="tab-content">
						<div id="change_password" class="tab-pane fade in active">
							<h3>Password Change</h3>
							<div class="login-cell">
							<?php 
								echo $this->Form->create('User', array('type' => 'file', 'class' => 'row man-register'));
								echo $this->Form->input('User.role_id', array('type' => 'hidden','value'=>AGENCY_ID)); 
								echo $this->Form->input('User.id', array('type' => 'hidden')); 
								echo $this->Form->input('User.type', array('type' => 'hidden','value'=>'password')); 
							?>
							  <div class="form-group col-sm-12  col-lg-8">
								<label for="email" class="control-label">Current Password<span>*</span></label>
								<div class="controls">
									<?php echo $this->Form->input('current_password', array('type' => 'password','label' => false,'required' => true, 'value' => '', 'div' => false, 'maxlength' => 20, 'class' => 'form-control')); ?>					
								</div>
							  </div>
							  
							  <div class="form-group col-sm-12  col-lg-8">
								<label for="email" class="control-label">New Password <span>*</span></label>
								<div class="controls">
									<?php echo $this->Form->input('password', array('label' => false,'required' => true, 'value' => '', 'div' => false, 'maxlength' => 20, 'class' => 'form-control')); ?>					
								</div>
							  </div>
							  
							  <div class="form-group col-sm-12  col-lg-8">
								<label for="email" class="control-label">Confirm Password <span>*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input('cpassword', array('type' => 'password','required' => true, 'value' => '', 'label' => false, 'div' => false, 'maxlength' => 20, 'class' => 'form-control')); ?>
								</div>
							  </div>
								
								<div class="form-group col-sm-12">
								<div class="form-actions">
								  <button class="btn btn-primary pull-right" type="submit">Submit</button>
								</div>
							  </div>
							</form>
						  </div>
						</div>
						<div id="change_email" class="tab-pane fade">
							<h3>Email Change</h3>
							<div class="login-cell">
							<?php 
								echo $this->Form->create('User', array('type' => 'file', 'class' => 'row man-register'));
								echo $this->Form->input('User.role_id', array('type' => 'hidden','value'=>AGENCY_ID)); 
								echo $this->Form->input('User.id', array('type' => 'hidden')); 
								echo $this->Form->input('User.type', array('type' => 'hidden','value'=>'email')); 
							?>
							  <div class="form-group col-sm-12  col-lg-8">
								<label for="email" class="control-label">Current Email</label>
								<div class="controls">
									<?php echo $this->Session->read('Auth.User.email'); ?>
								</div>
							  </div>
							  
							  <div class="form-group col-sm-12  col-lg-8">
								<label for="email" class="control-label">New Email <span>*</span></label>
								<div class="controls">
									<?php echo $this->Form->input('User.email', array('label' => false,'required' => true, 'value' => '', 'div' => false, 'class' => 'form-control')); ?>					
								</div>
							  </div>
							  
								<div class="form-group col-sm-12">
								<div class="form-actions">
								  <button class="btn btn-primary pull-right" type="submit">Submit</button>
								</div>
							  </div>
							</form>
						  </div>
						</div>
						
					</div>
				</div>
			</div>
					
	  </div>
	</div>
</section>
<script>
$(document).ready(function(){
		active_tab = window.location.hash; 
		<?php
			if(!empty($email)){
		?>
			active_tab = '#email';
		<?php }else if(!empty($password)){ ?>
			active_tab = '#password';
		<?php } ?> 
		$(active_tab+'_tab a').trigger('click');
	});
</script>