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
                    <a href="javascript:void(0);">Edit City</a>
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
                        <h3><i class="icon-th-list"></i> City - Edit City</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('City', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('City.id', array('type' => 'hidden')); ?>
                        

                        
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
                                        'checked' => isset($this->request->data['City']['status']) && $this->request->data['City']['status'] == 1 ? 'checked' : false,
                                        'hiddenField' => false,
                                    ));
                                    ?> 
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



















