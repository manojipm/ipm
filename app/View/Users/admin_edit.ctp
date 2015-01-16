<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/users">Admin Users</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Edit User</a>
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
                        <h3><i class="icon-th-list"></i> User - Edit User</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('User.id', array('type' => 'hidden')); 
                              echo $this->Form->input('UserDetail.id', array('type' => 'hidden'));?>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">First Name <span>*</span></label>
                            <div class="controls">
                            <?php echo $this->Form->input('UserDetail.first_name', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Last Name <span>*</span></label>
                            <div class="controls">
                            <?php echo $this->Form->input('UserDetail.last_name', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Email <span>*</span></label>
                            <div class="controls">
                            <?php echo $this->Form->input('User.email', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">                              
                            <label for="textfield" class="control-label">Status</label>
                                <div class="controls">
                                    <?php
                                    echo $this->Form->checkbox('User.status', array(
                                        'checked' => isset($this->request->data['User']['status']) && $this->request->data['User']['status'] == 1 ? 'checked' : false,
                                        'hiddenField' => false,
                                    ));
                                    ?> 
                                </div>
                            </label>
                        </div>
                        <div class="control-group">                              
                            <label for="textfield" class="control-label">Change Password</label>
                                <div class="controls">
                                    <?php
                                    echo $this->Form->checkbox('pass', array(
                                        'checked' => false,
                                        'hiddenField' => false,
                                        'onclick' => '',
                                    ));
                                    ?> 
                                    
                                   <?php echo $this->Form->input('password', array('label' => false,'div'=>false,'maxlength'=>20, 'class' => 'input-xlarge')); ?>
                                </div>
                            </label>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/testimonials'" class="btn">Cancel</button>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>