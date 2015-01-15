<div class="wrapper">
		<h1 style="margin-top: 85px;"><a href="<?php echo SITEURL.'admin'; ?>"><img src="img/logo.png" alt="" class='retina-ready' width="59" height="49">Admin</a></h1>
		<div class="login-body">
			<h2>SIGN IN</h2>
			<?php echo $this->Form->create('User',array('id' => 'test', 'class'=>'form-validate')); ?>
			<?php echo $this->Session->flash(); ?>
			
			<?php 
				// Check Remeber username and password
				if(isset($_COOKIE["username"]) && !empty($_COOKIE["username"]) && isset($_COOKIE["password"]) && !empty($_COOKIE["password"])){
					$this->request->data['User']['email'] = $_COOKIE["username"];
					$this->request->data['User']['password'] = $_COOKIE["password"];
					$this->request->data['User']['remember'] = 1;
				}
			?>
				
				<div class="control-group">
					<div class="email controls">
						 <?php echo $this->Form->input('email',array('type'=>'email','class'=>'input-block-level', 'placeholder'=>'Username (Your Email)',  "data-rule-required" => true , "data-rule-email" => true));?>
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						 <?php echo $this->Form->input('password',array('class'=>'input-block-level', 'placeholder'=>'Password', "data-rule-required" => true));?>
					</div>
				</div>
				<div class="submit">
					<div class="remember">
						 <?php echo $this->Form->input('remember',array('class'=>'icheck-me', 'type'=>'checkbox','data-skin'=>'square', 'data-color'=>'blue', "id" => 'remember','label'=>false, 'div'=>false, 'style'=>'float:left'));?><label for="remember">Remember me</label>
					<!--	<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>-->
					</div>
					<?php 
						$options = array(
							'label' => 'Sign me in',
							'class' => 'btn btn-primary',
							'div'=>false,
							'id'=>'adminLogin'
						);
						echo $this->Form->end($options);
					 ?>
				</div>
			</form>
			<div class="forget"> &nbsp;
				<?php	echo $this->Html->link('Forgot password?',array('controller'=>'users', 'action'=>'forgotpassword','admin'=>true),array('type' => 'button','class' => 'button', 'title' => 'Forgot Password','div'=>false));?>
			</div>
		</div>
	</div> 
<?php echo $this->Html->script(array('jquery-min-2.0.2','bootstrap.min'));?>        
<script>
$(function() {
	setTimeout(function(){
		$("#successFlashMsg").fadeOut('slow');
	},2000)
});
</script>