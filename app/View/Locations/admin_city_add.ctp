<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/locations/city">City</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Add City</a>
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
                        <h3><i class="icon-th-list"></i> City - Add City</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('City', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Name <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('City.city', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                                <?php
                                echo $this->Form->checkbox('City.status', array(
                                    'value' => '1',
                                    'checked' => 'checked',
                                    'hiddenField' => false,
                                ));
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/locations'" class="btn">Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>