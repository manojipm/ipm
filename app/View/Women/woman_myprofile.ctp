
      <div class="row">
        <div class="col-sm-12">
		  <h1>Personal Information </h1>
          <div class="login-cell">
            <?php 
				echo $this->Form->create('User', array('type' => 'file', 'class' => 'row man-register'));
				echo $this->Form->input('UserProfile.id', array('type' => 'hidden','id'=>'profileid')); 
			?>
              <div class="form-group col-sm-6 col-lg-4">
                <label class="control-label" for="email">First Name</label>
                <div class="controls">
                  <?php if(isset($this->data['UserProfile']['first_name'])) echo $this->data['UserProfile']['first_name']; ?>
                </div>
              </div>
              <div class="form-group  col-sm-6 col-lg-4">
                <label class="control-label" for="password">Last Name</label>
                <div class="controls">
				<?php if(isset($this->data['UserProfile']['last_name'])) echo $this->data['UserProfile']['last_name']; ?>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Nickname</label>
                <div class="controls">
				<span id="nicknametext">
					<span class="nickname">
					<?php if(isset($this->data['UserProfile']['nickname'])) echo $this->data['UserProfile']['nickname']; ?>
					</span>
				<a href="javascript:void(0)" id="editnickname" class="btn btn-danger btn-xs"  style="float: right;" >Edit</a>	
				</span>
				<span id="nicknameinput" style="display:none;">
				<?php echo $this->Form->input('UserProfile.nickname', array('label' => false,'id' => 'UserProfileNickname','required' => false,  'style' => "width: 200px; float: left;", 'div' => false, 'class' => 'form-control')); ?>
				<a href="javascript:void(0)"  id="cancelnickname" class="btn btn-danger btn-xs"  style="float: right;" >Cancel</a>
				<a href="javascript:void(0)"  id="savenickname" class="btn btn-success btn-xs"  style="float: right; margin: 0px 10px 0px 0px;" >Save</a>
				</span>
				
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Age </label>
                <div class="controls">
               	<?php $date = date('m/d/Y');
					if(isset($this->data['UserProfile']['age'])){
						echo $date = date('d F Y', strtotime($this->data['UserProfile']['age']));
					}else{
							echo '-';
						}
					?>
              </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Weight </label>
                <div class="controls row">
                  <div class="col-xs-8">
				  <?php if(isset($this->data['UserProfile']['weight']) && isset($this->data['UserProfile']['weight_type'])){
							echo $this->data['UserProfile']['weight'].' '.$this->data['UserProfile']['weight_type'];
						}else{
							echo '-';
						}
					 ?>
				  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="appendedtext">Height</label>
                <div class="row">
                  <div class="input-group col-xs-6">
					<?php if(isset($this->data['UserProfile']['height_feet']) && isset($this->data['UserProfile']['height_inches'])){
							echo $this->data['UserProfile']['height_feet'].' Feet '.$this->data['UserProfile']['height_inches'].' Inches';
						}else{
							echo '-';
						}
					 ?>
              </div>
              </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Eyes </label>
                <div class="controls">
                  <div class="">
					<?php if(isset($this->data['UserProfile']['eyes']) && !empty($this->data['UserProfile']['eyes'])){ echo $this->data['UserProfile']['eyes'];}else{ echo '-'; } ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Hair </label>
                <div class="controls">
                  <div class="">
					<?php if(isset($this->data['UserProfile']['hair']) && !empty($this->data['UserProfile']['hair'])){ echo $this->data['UserProfile']['hair']; }else{ echo '-';  } ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Religion </label>
                <div class="controls">
                  <div class="">
					<?php if(isset($this->data['UserProfile']['relegion']) && !empty($this->data['UserProfile']['relegion'])){ echo $this->data['UserProfile']['relegion']; }else{ echo '-';  } ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password"> Marital Status </label>
                <div class="controls">
                  <div class="">
				  <?php if(isset($this->data['UserProfile']['marital_status']) && !empty($this->data['UserProfile']['marital_status'])){ echo $this->data['UserProfile']['marital_status']; }else{ echo '-';  } ?>
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Children</label>
                <div class="controls">
					  <?php if(isset($this->data['UserProfile']['children']) && !empty($this->data['UserProfile']['children'])){ echo $this->data['UserProfile']['children']; }else{ echo '-';  } ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Languages</label>
                <div class="controls">
					<?php 
					if(isset($this->data['Language']) && !empty($this->data['Language'])){ 
						$language = '';
						foreach($this->data['Language'] as $lang){
							$language .= $lang['name'].', ';
						}
						echo substr($language ,'0',-2);
					}else{ echo '-';  } ?>
                </div>
              </div>
			  
			  
			  <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Phone(Confidential)  </label>
                <div class="controls">
					 <?php if(isset($this->data['UserProfile']['phone']) && !empty($this->data['UserProfile']['phone'])){ echo $this->data['UserProfile']['phone']; }else{ echo '-';  } ?>
                </div>
              </div>

			  <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Passport Number(Confidential)  </label>
                <div class="controls">
					 <?php if(isset($this->data['UserProfile']['passport_number']) && !empty($this->data['UserProfile']['passport_number'])){ echo $this->data['UserProfile']['passport_number']; }else{ echo '-';  } ?>
                </div>
              </div>
			  
			  <div class="form-group col-sm-6  col-lg-4">
				<label for="email" class="control-label"> Passport Scan Copy(Confidential)  </label>
					<div class="controls">
					 <?php if (isset($this->request->data['UserProfile']['passport_scan_copy']) && !is_array($this->request->data['UserProfile']['passport_scan_copy']) && $this->request->data['UserProfile']['passport_scan_copy'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'passport_scan_copy' . DS . $this->request->data['UserProfile']['passport_scan_copy'])) { ?>	
						<div class="catepic">
							<?php
							echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ;
							echo $this->Html->link('Passport Scan Copy :' . $this->request->data['UserProfile']['passport_scan_copy'], array('controller' => 'women',
								'action' => 'downloadfile',
								$this->request->data['UserProfile']['passport_scan_copy'],
								'passport_scan_copy'
									)
							);
							?>    

						</div>
					<?php } ?>
		
		
					</div>
			</div>
			  
			
			  
              
              <div class="form-group  col-sm-6  col-lg-4">
                <label for="password" class="control-label"> Country </label>
                <div class="controls">
                  <div class="">
					 <?php if(isset($this->data['UserProfile']['country_id']) && !empty($this->data['UserProfile']['country_id'])){ 
					 
					 echo $this->Common->getCountry($this->data['UserProfile']['country_id']);

					 }else{ echo '-';  } ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label for="password" class="control-label">City</label>
                <div class="controls">
                  <div class="">
					<?php if(isset($this->data['UserProfile']['city_id']) && !empty($this->data['UserProfile']['city_id'])){ echo $this->data['UserProfile']['city_id']; }else{ echo '-';  } ?>
                  </div>
                </div>
              </div>
			  
			  <!--<div class="clearfix"></div>-->
              <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="textarea">Occupation</label>
                <div class="controls">
					<?php if(isset($this->data['UserProfile']['occupation']) && !empty($this->data['UserProfile']['occupation'])){ echo $this->data['UserProfile']['occupation']; }else{ echo '-';  } ?>
                </div>
              </div>
			   <div class="form-group col-sm-6  col-lg-4">
                <label for="email" class="control-label">Email Id</label>
                <div class="controls">
				<?php if(isset($this->data['User']['email']) && !empty($this->data['User']['email'])){ echo $this->data['User']['email']; }else{ echo '-';  } ?>
                </div>
              </div>
			  
              <!--<div class="clearfix"></div>-->
              <div class="form-group col-sm-6  col-lg-4">
                <label for="textarea" class="control-label">About Me </label>
                <div class="controls">
					<?php if(isset($this->data['UserProfile']['about']) && !empty($this->data['UserProfile']['about'])){ echo $this->data['UserProfile']['about']; }else{ echo '-';  } ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label for="textarea" class="control-label">My Ideal Man </label>
                <div class="controls">
					<?php if(isset($this->data['UserProfile']['ideal']) && !empty($this->data['UserProfile']['ideal'])){ echo $this->data['UserProfile']['ideal']; }else{ echo '-';  } ?>
                </div>
              </div>
             
              
			  <div class="form-group col-sm-6  col-lg-4">
				<label for="email" class="control-label"> Profile Video  </label>
					<div class="controls">
					<?php if (isset($this->request->data['UserVideo']['profile_vedio']) && !is_array($this->request->data['UserVideo']['profile_vedio']) && $this->request->data['UserVideo']['profile_vedio'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'profile_vedio' . DS . $this->request->data['UserVideo']['profile_vedio'])) { ?>	
						<div class="catepic">
							
							<?php
							echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ;
							echo $this->Html->link('Profile Vedio :' . $this->request->data['UserVideo']['profile_vedio'], array('controller' => 'women',
								'action' => 'downloadfile',
								$this->request->data['UserVideo']['profile_vedio'],
								'profile_vedio'
									)
							);
							?>    

						</div>
					<?php } ?>
					
					</div>
			</div>  
			  

			<div class="form-group col-sm-6  col-lg-4">
				<label for="email" class="control-label">Profile Image</label>
				<div class="controls">
						<div data-provides="fileupload" class="fileupload fileupload-exists"><input type="hidden" value="" name="">
							<div style="width: 150px; height: 100px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/150x95/EFEFEF/AAAAAA&amp;text=no+image"></div>
							<div style="max-width: 150px; max-height: 100px; line-height: 10px;" class="fileupload-preview fileupload-exists thumbnail">
							 <?php if (isset($this->request->data['UserImage']['image_name']) && !is_array($this->request->data['UserImage']['image_name']) && $this->request->data['UserImage']['image_name'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $this->request->data['UserImage']['image_name'])) { ?>	
							<div class="catepic">
							<img style="max-height: 100px;" src="<?php echo SITEURL; ?>uploads/user_images/<?php echo $this->request->data['UserImage']['image_name']; ?>"></div>
							</div>
						<?php } ?>
						
						</div>
					</div>
				</div>
				
            </form>
          </div>
        </div>
      </div>
	  
	  <script>
		$(document).on('click', '#editnickname', function(){
			$('#nicknametext').hide();
			$('#nicknameinput').show();
		});
		
		$(document).on('click', '#cancelnickname', function(){
			$('#nicknameinput').hide();
			$('#nicknametext').show();
		});
		
		/* $(document).on('blur', '#nicknameinput', function(){
			$('#nicknameinput').hide();
			$('#nicknametext').show();
		}); */
		
		$(document).on('click', '#savenickname', function(){
			// input box text
			val = $('#UserProfileNickname').val();
			id = $('#profileid').val();
			if(val != '' && id != ''){
				$.ajax({
					url:siteurl+"women/savenicname",
					data: 'id='+id+'&val='+val,
					type:'POST',
					success:function(result){
						if(result){
							$('#nicknameinput').hide();
							$('.nickname').text(val);
							$('#nicknametext').show();
						}else{
							$('#nicknameinput').hide();
							$('#nicknametext').show();
						}
					}
				});
			}else{
				alert('invalid value!!!');
				return false;
			}
		});
		
		
		
		
	  </script>