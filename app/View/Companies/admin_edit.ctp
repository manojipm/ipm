<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/companies/structure">Company</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Edit Company</a>
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
                        <h3><i class="icon-th-list"></i> Company - Add Company</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Company', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Name <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.company_name', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">SIC Code <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.sic_code', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">ORG Chart <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.org_chart', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Street</label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.street', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div> 
              
                        <div class="control-group">
                            <label for="textfield" class="control-label">Country </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.country_id', array('options' => $this->Common->getCountryList(),  'empty' => 'Select country', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>      
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">State </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.state_id', array('options' => $this->Common->getStateList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">City </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.city_id', array('options' => $this->Common->getCityList(),  'empty' => 'Select state', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Zip </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.zip', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>                        
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Phone </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.phone', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>                       
                        
                         <div class="control-group">
                            <label for="textfield" class="control-label">Ownership <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.ownership', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>                         
                        
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Structure Type </label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.structure_id', array('options' => $this->Common->getCompanyStructure(),  'empty' => 'Select Structure Type',  'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>                       
                        
                         <div class="control-group">
                            <label for="textfield" class="control-label">Industry Classification</label>
                            <div class="controls">
                               <?php echo $this->Form->input('Company.industry_classification_id', array('options' => $this->Common->getIndustryClassification(),  'empty' => 'Select Industry Classification','label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        
                         <div class="control-group">
                            <label for="textfield" class="control-label">Revenue</label>
                            <div class="controls">
                                <?php
                                echo $this->Form->checkbox('Company.revenue', array(
                                    'value' => '1',
                                    'checked' => 'checked',
                                    'hiddenField' => false,
                                ));
                                ?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                                <?php
                                echo $this->Form->checkbox('Company.status', array(
                                    'value' => '1',
                                    'checked' => 'checked',
                                    'hiddenField' => false,
                                ));
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/companies/index'" class="btn">Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>