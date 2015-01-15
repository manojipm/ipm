<?php 
echo $this->Form->input('UserProfile.id', array('type' => 'hidden'));
?>
<div class="control-group">
    <label  for="textfield" class="control-label">First Name <span>*</span></label>
    <div class="controls">
        
        <?php echo $this->Form->input('UserProfile.first_name', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label   for="textfield" class="control-label">Last Name  <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.last_name', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label  for="textfield" class="control-label">Nickname <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.nickname', array('label' => false,'required' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label  for="textfield" class="control-label" >Email  <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('User.email', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<?php if (isset($this->params->params['action']) && $this->params->params['action'] == 'admin_add') { ?>
    <div class="control-group">
        <label   for="textfield" class="control-label">Password<span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('User.password', array('label' => false,'required' => true, 'value' => '', 'div' => false, 'maxlength' => 20, 'class' => 'input-xlarge')); ?>
        </div>

    </div>
    <div class="control-group">
        <label  for="textfield" class="control-label">Confirm Password <span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('User.cpassword', array('type' => 'password','required' => true, 'value' => '', 'label' => false, 'div' => false, 'maxlength' => 20, 'class' => 'input-xlarge')); ?>
        </div>
    </div>

<?php } ?>


<div class="control-group">
    <label for="textfield" class="control-label">Date of Birth </label>
    <div class="controls">
        <?php
		$date = date('m/d/Y');
		if(isset($this->data['UserProfile']['age'])){
			$date = $this->data['UserProfile']['age'];
		}
        echo $this->Form->input('UserProfile.age', array(
                    'type' => 'text', 
                    'label' => false, 
                    'div' => false, 
                    'class' => 'input-xlarge datepick',
                    'value'=> $date,'readonly',
                    )
                 );
        ?>
    </div>
</div>
<?php
$w_kg = array();
for ($i = 10; $i < 200; $i++) {
    $w_kg[$i] = $i ;
}


?>

<div class="control-group">
<label class="control-label" for="appendedtext">Height</label>
<div class="controls">
  <div class="input-append">
  
	<?php echo $this->Form->input('UserProfile.height_feet', array('id'=>'height_feet','type' => 'text', 'label' => false, 'div' => false, 'class' => 'input-small')); ?>
	<span class="add-on">FT</span> </div>
  <div class="input-append">
	<?php echo $this->Form->input('UserProfile.height_inches', array('id'=>'height_inches','type' => 'text', 'label' => false, 'div' => false, 'class' => 'input-small')); ?>
	<span class="add-on">Inches</span> </div>
</div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Weight </label>
    <div class="controls">
        <div id="kg-lbs">
            <?php echo $this->Form->input('UserProfile.weight', array('options' => $w_kg, 'empty' => 'Select weight', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
        </div>
        <div id="type-kg-lbs" style="float: right;margin-right: 500px;margin-top: -28px;">
           <?php echo $this->Form->input('UserProfile.weight_type', array('options' => array('kg'=>'KG','lbs'=>'LBS'), 'label' => false, 'div' => false, 'class' => 'input-small select2-me')); ?>
        </div>
        </div>
</div>


<div class="control-group">
    <label for="textfield" class="control-label">Eyes </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.eyes', array('options' => unserialize(EYES), 'empty' => 'Select eyes', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Hair  </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.hair', array('options' => unserialize(HEIR), 'empty' => 'Select heir', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me' )); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Religion  </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.relegion', array('options' => unserialize(RELEGION), 'empty' => 'Select religion', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Marital Status  <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.marital_status', array('options' => unserialize(MARITALSTATUS), 'empty' => 'Select marital status','required' => true, 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Children  </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.children', array('options' => unserialize(CHILDREN), 'empty' => 'Select children', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Languages  <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('Language.Language', array('options' => $this->Common->getLanguageList(), 'multiple' => true,'required' => true, 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Occupation </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.occupation', array('type' => 'textarea', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Country   <span>*</span></label>
    <div class="controls">
        <?php 
		$country_id = COUNTRY_CODE;
		if(isset($this->data['UserProfile']['country_id']))
		$country_id = $this->data['UserProfile']['country_id'];
		
		echo $this->Form->input('UserProfile.country_id', array('options' => $this->Common->getCountryList(),'selected'=> $country_id, 'empty' => 'Select country','required' => true, 'onchange' => 'selectCity(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label"> State  <span>*</span> </label>
    <div class="controls">
        <?php
            echo $this->Form->input('UserProfile.state_id', array('options' => $this->Common->getStateList($country_id), 'empty' => 'Select state', 'id' => 'state_dropdown', 'onchange' => 'selectState(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me'));
        ?>
        <span id="state_loader"></span>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">City   <span>*</span> </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.city_id', array('type' => 'text','label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        
        <?php //echo $this->Form->input('UserProfile.city_id', array('options' => $this->Common->getCityList(), 'empty' => 'Select city', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
        <span id="city_loader"></span>
    </div>
</div>



<div class="control-group">
    <label for="textfield" class="control-label">About Me  </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.about', array('type' => 'textarea', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">My Ideal Woman   </label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.ideal', array('type' => 'textarea', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>

<div class="control-group">
    <label for="textfield" class="control-label">Profile Image </label>
    
        
        <div class="controls">
        <?php 
        //echo $this->Form->input('UserImage.0.is_profile_pic', array('type' => 'hidden','value'=>'1'));
        //echo $this->Form->input('UserImage.0.id', array('type' => 'hidden'));
        //echo $this->Form->input('UserImage.0.image_name', array('type' => 'file', 'multiple' => false, 'label' => false, 'div' => false, 'class' => 'input-xlarge')); 
        echo $this->Form->input('UserImage.is_profile_pic', array('type' => 'hidden','value'=>'1'));
        echo $this->Form->input('UserImage.id', array('type' => 'hidden'));
        echo $this->Form->input('UserImage.image_name', array('type' => 'file', 'multiple' => false, 'label' => false, 'div' => false, 'class' => 'input-xlarge')); 
        
        
        ?>
        <?php
        if (isset($this->request->data['UserImage']['image_name']) && !is_array($this->request->data['UserImage']['image_name']) && $this->request->data['UserImage']['image_name'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $this->request->data['UserImage']['image_name'])) { ?>	
            <div class="catepic" style="float:none; width:200px;">
                <?php
                echo $this->Html->Image('../uploads/user_images/' . $this->request->data['UserImage']['image_name'], array('height' => 100, 'width' => 100));
                ?>
            </div>
        <?php
        } 
        ?>
        <?php 
            if(isset($this->request->data['UserImage']) && is_array($this->request->data['UserImage']) && !empty($this->request->data['UserImage'])){
                foreach($this->request->data['UserImage'] as $img){
                    if (isset($img['image_name']) && $img['is_profile_pic'] == true && $img['image_name'] != '' && file_exists(WWW_ROOT . USER_PIC_PATH . DS . $img['image_name'])) {	
        ?>
            <div class="catepic" style="float:none; width:200px;">
                <?php
                //echo $this->Html->Image(SITEURL.USER_PIC_PATH . '/' .  $img['image_name'], array('height' => 100, 'width' => 100));
                ?>
            </div>
        <?php 
                    }
                }
            }
        ?>
    </div>
</div>


<div class="control-group">
    <label for="textfield" class="control-label">Status</label>
    <div class="controls">
        <?php
        echo $this->Form->checkbox('User.status', array(
            'hiddenField' => false,
        ));
        ?>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><?php if(isset($this->request->data['User']['id'])){ echo 'Update'; }else { echo  'Register';}?></button>
    <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/users'" class="btn">Cancel</button>
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
            url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'get_state_city')); ?>",
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
