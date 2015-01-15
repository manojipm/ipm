<div class="box-title">
    <h3><i class="icon-th-list"></i> Impose Penalty</h3>
</div>
<div class="box-content nopadding">
    <?php echo $this->Form->create('Penalty', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
    <?php echo $this->Form->input('Penalty.agency_id',array('type'=>'hidden','value'=>$this->params['pass'][0])); ?>
    <div class="control-group">
        <label for="textfield" class="control-label">Agency Name  </label>
        <div class="controls">
            <?php
                echo $this->Form->input('Penalty.agency_id', array(
                            'options' => array($this->params['pass'][0]=>$this->Common->getUserName($this->params['pass'][0])), 
                            'disabled' => 'disabled', 
                            'label' => false, 
                            'div' => false, 
                            'class' => 'input-xlarge select2-me'
                            )
                        );
            ?>
        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Girl's Nickname   <span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('Penalty.user_id', array('options' => $this->Common->getWomanUnderAgencyList($this->params['pass'][0]), 'empty' => 'Select Girl\'s Nickname', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
            <span id="woman_loader"></span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Penalty Reason   <span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('Penalty.reason', array('options' => unserialize(PENALTY_REASON), 'empty' => 'Select Penalty Reason', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Penalty Summary <span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('Penalty.summary', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
            <label for="textfield" class="control-label">Penalty Amount <span>*</span></label>
            <div class="controls">
                    <div class="input-append input-prepend">
                            <span class="add-on">$</span>
                            <?php echo $this->Form->input('Penalty.amount', array("min"=>"0", "step"=>"1",'label' => false, 'div' => false, 'class' => 'input-small')); ?>
                            <span class="add-on">.00</span>
                    </div>
            </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Attachment</label>
        <div class="controls">
            <?php echo $this->Form->input('Penalty.attachment', array('type' => 'file', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/users/view/<?php echo $this->params['pass'][0];?>/type:<?php echo $this->params['named']['type'];?>'" class="btn">Cancel</button>
   
    </div>

</form>
</div>



<script type="text/javascript">
    function selectChange(loadType, loadId) {
        //alert(loadType+'sfsfsd'+loadId);
        var dataString = 'loadType=' + loadType + '&loadId=' + loadId;
        $("#" + loadType + "_loader").show();
        $("#" + loadType + "_loader").fadeIn(400).html('Please wait... <?php echo $this->Html->image('loading1.gif'); ?>');
        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'penalty', 'action' => 'get_agency_woman')); ?>",
            data: dataString,
            cache: false,
            success: function (result) {
                $("#" + loadType + "_loader").hide();
                $("#PenaltyUserId").html("<option>Select " + loadType + "</option>");
                $("#PenaltyUserId").append(result);
            }
        });
    }
</script>














