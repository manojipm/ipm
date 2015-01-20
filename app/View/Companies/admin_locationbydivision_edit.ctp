<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/companies/locationbydivision">Location By Division</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Add Location By Division</a>
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
                        <h3><i class="icon-th-list"></i> Location By Division - Add Location By Division</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('LocationDivision', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Company <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.company_id', array('options' => $this->Common->getCompanyList(),  'empty' => 'Select company', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Division <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.division', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Location ID <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.location', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Type <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.locations_by_division_id', array('options' => $this->Common->getLocationsByDivisionList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Street <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.street', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">City <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.city_id', array('options' => $this->Common->getCityList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">State <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.state_id', array('options' => $this->Common->getStateList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Country <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.country_id', array('options' => $this->Common->getCountryList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Zip <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.zip', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                       
                        <div class="control-group">
                            <label for="textfield" class="control-label">Phone</label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.phone', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Census Tract </label>
                            <div class="controls">
                               <?php echo $this->Form->input('LocationDivision.census_tract', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                                <?php
                                echo $this->Form->checkbox('LocationDivision.status', array(
                                    'value' => '1',
                                    'checked' => 'checked',
                                    'hiddenField' => false,
                                ));
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/companies/locationbydivision'" class="btn">Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>