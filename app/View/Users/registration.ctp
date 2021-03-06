<section class="main">
    <div class="container">

      <div class="row">
        <div class="col-sm-12">
		<div class="well girls-online">
			<ul class="text-center">
				<?php echo $this->element('front/girls_online'); ?>        
			</ul>
		</div>
          <h1>Personal Information </h1>
          <div class="login-cell">
            <?php 
				echo $this->Form->create('User', array('type' => 'file', 'class' => 'row man-register'));
				echo $this->Form->input('User.role_id', array('type' => 'hidden','value'=>MAN_ID)); 
			?>
              <div class="form-group col-sm-6 col-lg-4">
                <label class="control-label" for="email">First Name <span>*</span></label>
                <div class="controls">
                  <?php echo $this->Form->input('UserProfile.first_name', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group  col-sm-6 col-lg-4">
                <label class="control-label" for="password">Last Name <span>*</span></label>
                <div class="controls">
				<?php echo $this->Form->input('UserProfile.last_name', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Nickname <span>*</span></label>
                <div class="controls">
				<?php echo $this->Form->input('UserProfile.nickname', array('label' => false,'required' => false, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Age </label>
                <div class="controls">
               	<?php
					echo $this->Form->input('UserProfile.age', array(
						'type' => 'text', 
						'label' => false, 
						'div' => false, 
						'class' => 'form-control datepick',
						'readonly',
						)
					 );
				?>
              </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Weight </label>
                <div class="controls row">
                  <div class="col-xs-8">
				  <?php echo $this->Form->input('UserProfile.weight', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                  </div>
                  <div class="col-xs-4">
					<?php echo $this->Form->input('UserProfile.weight_type', array('options' => array('kg'=>'KG','lbs'=>'LBS'), 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="appendedtext">Height</label>
                <div class="row">
                  <div class="input-group col-xs-6">
					<?php echo $this->Form->input('UserProfile.height_feet', array('id'=>'height_feet','type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                    <span class="input-group-addon">FT</span> </div>
                  <div class="input-group col-xs-6">
                    <?php echo $this->Form->input('UserProfile.height_inches', array('id'=>'height_inches','type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                    <span class="input-group-addon">Inches</span> </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Eyes </label>
                <div class="controls">
                  <div class="">
					 <?php echo $this->Form->input('UserProfile.eyes', array('options' => unserialize(EYES), 'empty' => 'Select Eyes color', 'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20')); ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Hair </label>
                <div class="controls">
                  <div class="">
				   <?php echo $this->Form->input('UserProfile.hair', array('options' => unserialize(HEIR), 'empty' => 'Select Hair color', 'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20' )); ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password">Religion </label>
                <div class="controls">
                  <div class="">
					<?php echo $this->Form->input('UserProfile.relegion', array('options' => unserialize(RELEGION), 'empty' => 'Select religion', 'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20')); ?>
                  </div>
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label class="control-label" for="password"> Marital Status <span>*</span> </label>
                <div class="controls">
                  <div class="">
				  <?php echo $this->Form->input('UserProfile.marital_status', array('options' => unserialize(MARITALSTATUS), 'empty' => 'Select marital status','required' => true, 'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20')); ?>
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Children</label>
                <div class="controls">
					 <?php echo $this->Form->input('UserProfile.children', array('options' => unserialize(CHILDREN), 'empty' => 'Select children', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="email">Languages <span>*</span></label>
                <div class="controls">
					<?php echo $this->Form->input('Language.Language', array('id'=>'menlang','options' => $this->Common->getLanguageList(), 'multiple' => true,'required' => true, 'label' => false, 'div' => false, 'class' => 'form-control select2-me')); ?>					
                </div>
              </div>
           
			  <div class="form-group  col-sm-6  col-lg-4">
                <label for="password" class="control-label"> Country <span>*</span> </label>
                <div class="controls">
                  <div class="">
					<?php echo $this->Form->input('UserProfile.country_id', array('options' => $this->Common->getCountryList(),'selected'=> COUNTRY_CODE, 'empty' => 'Select country','required' => true, 'onchange' => 'selectCity(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20')); ?>
                  </div>
                </div>
              </div>

			  <div class="form-group  col-sm-6  col-lg-4">
                <label for="password" class="control-label"> State <span>*</span> </label>
                <div class="controls">
                  <div class="">
					<?php
						echo $this->Form->input('UserProfile.state_id', array('options' => $this->Common->getStateList(), 'empty' => 'Select state', 'id' => 'state_dropdown', 'onchange' => 'selectState(this.options[this.selectedIndex].value)', 'required' => true,  'label' => false, 'div' => false, 'class' => 'form-control mr-bt-20'));
					?>
                  </div>
				  <!--<span id="state_loader"></span>-->
                </div>
              </div>
              <div class="form-group  col-sm-6  col-lg-4">
                <label for="password" class="control-label">City <span>*</span></label>
                <div class="controls">
                  <div class="">
					<?php echo $this->Form->input('UserProfile.city_id', array('type' => 'text','label' => false, 'div' => false, 'class' => 'form-control')); ?>
                  </div>
                </div>
              </div>
			  
			   <div class="form-group col-sm-6  col-lg-4">
                <label class="control-label" for="textarea">Occupation</label>
                <div class="controls">
					<?php echo $this->Form->input('UserProfile.occupation', array('type' => 'textarea', 'rows' => '2','label' => false, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
			  
              <div class="form-group col-sm-6  col-lg-4">
                <label for="textarea" class="control-label">About Me </label>
                <div class="controls">
					<?php echo $this->Form->input('UserProfile.about', array('id'=>'textarea','type' => 'textarea', 'rows' => '2', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label for="textarea" class="control-label">My Ideal Woman </label>
                <div class="controls">
					<?php echo $this->Form->input('UserProfile.ideal', array('type' => 'textarea',  'rows' => '2','label' => false, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label for="email" class="control-label">Email Id <span>*</span></label>
                <div class="controls">
                  <?php echo $this->Form->input('User.email', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label for="email" class="control-label">Password <span>*</span></label>
                <div class="controls">
					<?php echo $this->Form->input('User.password', array('label' => false,'required' => true, 'value' => '', 'div' => false, 'maxlength' => 20, 'class' => 'form-control')); ?>					
                </div>
              </div>
              <div class="form-group col-sm-6  col-lg-4">
                <label for="email" class="control-label">Confirm Password <span>*</span></label>
                <div class="controls">
				 <?php echo $this->Form->input('User.cpassword', array('type' => 'password','required' => true, 'value' => '', 'label' => false, 'div' => false, 'maxlength' => 20, 'class' => 'form-control')); ?>
                </div>
              </div>
				
				<div class="form-group col-sm-6  col-lg-4">
					<label for="email" class="control-label">Profile Image</label>
					<div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div style="float: right; margin:0 0 8px 0;">
								<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
								<?php echo $this->Form->input('UserImage.image_name', array('type' => 'file', 'multiple' => false, 'label' => false, 'div' => false)); ?></span>
								<?php echo $this->Form->input('UserImage.is_profile_pic', array('type' => 'hidden', 'value' => '1', 'label' => false, 'div' => false)); ?>
								<a href="#" style="color: inherit;" class="btn btn-file fileupload-exists" data-dismiss="fileupload">Remove</a>
							</div>
							<div class="fileupload-new thumbnail" style="width: 150px; height: 100px;"><img src="http://www.placehold.it/150x95/EFEFEF/AAAAAA&text=no+image" /></div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 10px;"></div>
						</div>
					</div>
				</div>
			   <div class="form-group col-sm-12">
                <div class="form-actions">
                  <button class="btn btn-primary pull-right" type="submit">Register Me</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script type="text/javascript">
    function selectCity(country_id) {
        if (country_id != "-1") {
            loadData('state', country_id);
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        } else {
            $("#state_dropdown").html("<option value='-1'>Select state</option>");
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        }
    }

    function selectState(state_id) {
        if (state_id != "-1") {
            loadData('city', state_id);
        } else {
            $("#city_dropdown").html("<option value='-1'>Select city</option>");
        }
    }

    function loadData(loadType, loadId) {
        var dataString = 'loadType=' + loadType + '&loadId=' + loadId;
        $("#" + loadType + "_loader").show();
        $("#" + loadType + "_loader").fadeIn(400).html('Please wait... <?php echo $this->Html->image('loading1.gif'); ?>');
        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'get_state_city','admin'=>true)); ?>",
            data: dataString,
            cache: false,
            success: function (result) {
                $("#" + loadType + "_loader").hide();
                $("#" + loadType + "_dropdown").html("<option value='-1'>Select " + loadType + "</option>");
                $("#" + loadType + "_dropdown").append(result);
            }
        });
    }
</script>