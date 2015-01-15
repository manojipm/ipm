<div class="control-group">
    <label for="textfield" class="control-label">Agency Name <span>*</span></label>
    <div class="controls">
        <?php 
        echo $this->Form->input('UserProfile.id', array('type' => 'hidden'));
        ?>
        <?php echo $this->Form->input('UserProfile.first_name', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Email <span>*</span></label>
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
    <label for="textfield" class="control-label">Contact Person <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.contact_person', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>
<div class="control-group">
    <label for="AgencyContactPerson" class="control-label">Contact No <span>*</span></label>
    <div class="controls">
        <?php
        echo $this->Form->input('UserProfile.phone', array(
            'type' => 'text',
            'label' => false,
            'div' => false,
            'required' => true,
            'class' => 'input-xlarge mask_phone'
                )
        );
        ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">Address <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.address', array('label' => false,'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
    </div>
</div>


<div class="control-group">
    <label for="textfield" class="control-label">Country   <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.country_id', array('options' => $this->Common->getCountryList(),'selected'=> COUNTRY_CODE , 'empty' => 'Select country','required' => true, 'onchange' => 'selectCity(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label"> State   <span>*</span></label>
    <div class="controls">
        <?php
            echo $this->Form->input('UserProfile.state_id', array('options' => $this->Common->getStateList(), 'empty' => 'Select state', 'id' => 'state_dropdown', 'onchange' => 'selectState(this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me'));
        ?>
        <span id="state_loader"></span>
    </div>
</div>
<div class="control-group">
    <label for="textfield" class="control-label">City   <span>*</span></label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.city_id', array('type' => 'text','label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        <?php //echo $this->Form->input('UserProfile.city_id', array('options' => $this->Common->getCityList(), 'empty' => 'Select city', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
        <span id="city_loader"></span>
    </div>
</div>


<div class="control-group">
    <label for="textfield" class="control-label">Agency License</label>
    <div class="controls">
        <?php echo $this->Form->input('UserProfile.agency_license', array('type' => 'file', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        
        <?php
        if(isset($this->request->data['UserProfile']['agency_license']) && !is_array($this->request->data['UserProfile']['agency_license'])){
            if (isset($this->request->data['UserProfile']['agency_license']) && !empty($this->request->data['UserProfile']['agency_license']) && $this->request->data['UserProfile']['agency_license'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'agency_license' . DS . $this->request->data['UserProfile']['agency_license'])) { 	
                echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ;
                echo $this->Html->link('Agency License :' . $this->request->data['UserProfile']['agency_license'], array('controller' => 'users',
                    'action' => 'downloadfile',
                    $this->request->data['UserProfile']['agency_license'],
                    'agency_license'
                        )
                );
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














