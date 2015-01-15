<div class="wrapper">
		<h1 style="margin-top: 22%;"><a href="<?php echo SITEURL.'admin'; ?>"><img src="<?php echo SITEURL; ?>img/logo.png" alt="" class='retina-ready' width="59" height="49">Admin</a></h1>
		<div class="login-body">
			<h2>Admin Forgot Password</h2>
			<?php echo $this->Form->create('User',array('id' => 'forgotpassword', 'class'=>'form-validate')); ?>
			<?php echo $this->Session->flash(); ?>
			
				<div class="control-group">
					<div class="email controls">
						 <?php echo $this->Form->input('email',array('type'=>'email','class'=>'input-block-level', 'placeholder'=>'Username (Your Email)',  "data-rule-required" => true , "data-rule-email" => true));?>
					</div>
				</div>
				
				<div class="submit">
					<?php 
						$options = array(
							'label' => 'Get Password',
							'class' => 'btn btn-primary',
							'div'=>false,
							'id'=>'adminLogin'
						);
						echo $this->Form->end($options);
					 ?>
                                    <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/users'" class="btn">Cancel</button>
				</div>

                        
			</form>
			<div class="forget"> &nbsp;
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