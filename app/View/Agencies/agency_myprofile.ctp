<div class="row">
<div class="col-sm-12">
  <h1>Agency Information </h1>
  <div class="login-cell">
	<?php 
		echo $this->Form->create('User', array('type' => 'file', 'class' => 'row agency-register'));
		echo $this->Form->input('User.id', array('type' => 'hidden')); 
		echo $this->Form->input('User.role_id', array('type' => 'hidden','value'=>AGENCY_ID)); 
		echo $this->Form->input('UserProfile.role_id', array('type' => 'hidden','value'=>AGENCY_ID)); 
		echo $this->Form->input('User.status', array('type' => 'hidden')); 
	?>
	  <div class="form-group col-sm-6 col-lg-6">
		<label class="control-label" for="email">Agency Name <span>*</span></label>
		<div class="controls">
		 <?php echo $this->Form->input('UserProfile.first_name', array('label' => false,'disabled' => true, 'readonly' => true, 'div' => false, 'class' => 'form-control')); ?>
		</div>
	  </div>
	  
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">Contact Person <span>*</span></label>
		<div class="controls">
		 <?php echo $this->Form->input('UserProfile.contact_person', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
		</div>
	  </div>
	  
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">Address <span>*</span></label>
		<div class="controls">
		  <?php echo $this->Form->input('UserProfile.address', array('label' => false,'required' => true, 'div' => false, 'class' => 'form-control')); ?>
		</div>
	  </div>
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">Phone No <span>*</span></label>
		<div class="controls">
		<?php
			echo $this->Form->input('UserProfile.phone', array(
				'type' => 'text',
				'label' => false,
				'length' => '12',
				'div' => false,
				'required' => true,
				'class' => 'form-control mask_phone'
					)
			);
			?>
	  </div>
	  </div>
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">Country   <span>*</span> </label>
		<div class="controls">
		  <div class="">
			 <?php echo $this->Form->input('UserProfile.country_id', array('options' => $this->Common->getCountryList() , 'empty' => 'Select country','required' => true, 'onchange' => 'selectCity(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'form-control select2-me')); ?>
		  </div>
		</div>
	  </div>
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">State   <span>*</span> </label>
		<div class="controls">
		  <div class="">
		   <?php //pr($this->data);
				$country_id = 0;
				if(isset($this->data['UserProfile']['country_id']))
				$country_id = $this->data['UserProfile']['country_id'];
				echo $this->Form->input('UserProfile.state_id', array('options' => $this->Common->getStateList($country_id), 'empty' => 'Select state', 'id' => 'state_dropdown', 'onchange' => 'selectState(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'form-control select2-me'));
			?>
			<span id="state_loader"></span>
		  </div>
		</div>
	  </div>
	  <div class="form-group  col-sm-6  col-lg-6">
		<label class="control-label" for="password">City   <span>*</span> </label>
		<div class="controls">
		  <div class="">
			<?php echo $this->Form->input('UserProfile.city_id', array('type' => 'text','label' => false, 'div' => false, 'class' => 'form-control')); ?>
			<span id="city_loader"></span>
		  </div>
		</div>
	  </div>
	  
	   <div class="form-group col-sm-12">
		<div class="form-actions">
		  <button class="btn btn-primary pull-right" type="submit">Update</button>
		</div>
	  </div>
	</form>
  </div>
</div>
</div>
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