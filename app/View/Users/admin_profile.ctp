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
                    <a href="javascript:void(0);">Edit Admin</a>
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
                        <h3><i class="icon-th-list"></i> Update Admin Profile</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.Admin.id'))); ?>
                        <?php echo $this->Form->input('User.role_id', array('type' => 'hidden', 'value' => 1)); ?>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Email(username)<span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('User.email', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">First Name<span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('UserProfile.first_name', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Last Name<span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('UserProfile.last_name', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Password</label>
                            <div class="controls">
                                <?php echo $this->Form->input('User.password', array('type' => 'password', 'label' => false, 'div' => false, 'class' => 'form-control', 'value' => '')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Profile Images </label>
                            <div class="controls">
                                <?php echo $this->Form->input('UserImage.image_name', array('type' => 'file', 'multiple' => false, 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                                <?php
                                if (isset($this->request->data['UserImage']['image_name']) && !is_array($this->request->data['UserImage']['image_name'])) {

                                    if (!empty($this->request->data['UserImage']['image_name']) && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $this->request->data['UserImage']['image_name'])) {
                                        ?>	
                                        <div class="catepic" style="float:none; width:200px;">
                                            <?php
                                            echo $this->Html->Image('../uploads/user_images/' . $this->request->data['UserImage']['image_name'], array('height' => 100, 'width' => 100));
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>			
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/dashboards'" class="btn">Cancel</button>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
