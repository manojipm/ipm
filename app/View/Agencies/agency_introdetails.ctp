	<?php 
		$unique_id = '';
		$age = '';
		$name = '';
		if(isset($introletter['User']['UserProfile']['first_name'])){
			$name = '-'.$introletter['User']['UserProfile']['first_name'];
		}	
		if(isset($introletter['User']['UserProfile']['last_name']) && !empty($introletter['User']['UserProfile']['last_name'])){
			$name .= ' '.$introletter['User']['UserProfile']['last_name'];
		}
		if(isset($introletter['User']['UserProfile']['unique_id'])){
			$unique_id = '#'.$introletter['User']['UserProfile']['unique_id'];
		}	
		
		if(isset($introletter['User']['UserProfile']['age'])){
			$age = ' ('.$this->Common->birthday($introletter['User']['UserProfile']['age']).' Years) ';
		}	
		
		
	?>
      <div class="row">
        <div class="col-sm-12">
			<h1>Introduction Letter <?php echo $name.$age.$unique_id; ?>
				<div class="pull-right">
					<a href="<?php echo SITEURL; ?>agency/introletters" class="btn btn-warning btn-xs" >Back to Introletters </a>
				</div>
			</h1>
			<?php if(isset($introletter) && !empty($introletter)){ //pr($introletter); ?>
          <div class="login-cell login-introcell">
				<div class="form-group col-sm-12 col-lg-12" style="width:90%;">
					<label class="control-label" for="email">Title</label>
					<div class="controls">
					<?php echo $introletter['Introletter']['title']; ?>
						
					</div>
				</div>
				<div class="pull-right">
					<?php
						$image_name = $this->Common->profilePic($introletter['User']['id']);
						if (isset($image_name) && $image_name != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $image_name)) { ?>	
							<div class="catepic">
								<?php
								echo $this->Html->Image('../uploads/user_images/' . $image_name, array('height' => 50, 'width' => 80));
								?>
							</div>
					<?php
						} 
					?>
				</div>
				<div class="form-group  col-sm-12 col-lg-12">
					<label class="control-label" for="password">Description</label>
					<div class="controls">
					<?php echo $introletter['Introletter']['description']; ?>
					</div>
				</div>
			  
			  <?php }else{ ?>
					<div class="form-group  col-sm-12 col-lg-12">
						No Detail found !!!
					</div>
            </form>
          </div>
			  <?php } ?>
        </div>
      </div>