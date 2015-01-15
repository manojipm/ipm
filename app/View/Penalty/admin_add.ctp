<?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>
<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/penalty">Penalties</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Add Penalty</a>
                </li>
            </ul>
            <!--<div class="close-bread">
                    <a href="#"><i class="icon-remove"></i></a>
            </div>-->
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="icon-th-list"></i> Penalties - Add Penalty</h3>
                    </div>
                     <div class="box-content nopadding">
                        <?php echo $this->Form->create('Penalty', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                         <div class="control-group">
                            <label for="textfield" class="control-label">Agency Name   <span>*</span></label>
                            <div class="controls">
                                <?php
                                    echo $this->Form->input('Penalty.agency_id', array('options' => $this->Common->getAgencyList(), 'empty' => 'Select agency', 'onchange' => 'selectChange("woman",this.options[this.selectedIndex].value)', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me'));
                                ?>
                                <?php //echo $this->Form->input('Penalty.agency_id', array('options' => $this->Common->getAgencyList(), 'empty' => 'Select agency', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Girl's Nickname   <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('Penalty.user_id', array('options' => array(), 'empty' => 'Select Girl\'s Nickname', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me')); ?>
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
                                <?php echo $this->Form->input('Penalty.summary', array('label' => false, 'required' => true, 'div' => false, 'class' => 'input-xlarge')); ?>
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
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/penalty'" class="btn">Cancel</button>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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














