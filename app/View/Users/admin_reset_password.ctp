<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/users">Users</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Reset Password</a>
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
                        <h3><i class="icon-th-list"></i> Users - Reset Password</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                       
					   <div class="control-group">
                            <label for="textfield" class="control-label">Password <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('password', array('label' => false,'div'=>false,'maxlength'=>20, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Confirm Password <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('cpassword', array('type' => 'password','label' => false,'div'=>false,'maxlength'=>20, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>

                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/users'" class="btn">Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>