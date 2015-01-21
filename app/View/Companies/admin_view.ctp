<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/companies">Company</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">View Company</a>
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
                        <h3><i class="icon-th-list"></i> Company - View Company</h3>
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Company', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('Company.id', array('type' => 'hidden', )); ?>
                        
                          
                            <div class="control-group">
                                <label for="textfield" class="control-label">Name</label>
                                <div class="controls"><?php echo $companies['Company']['company_name']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">SIC Code</label>
                                <div class="controls"><?php echo $companies['Company']['sic_code']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">ORG. Chart</label>
                                <div class="controls"><?php echo $companies['Company']['org_chart']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Street</label>
                                <div class="controls"><?php echo $companies['Company']['street']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Country</label>
                                <div class="controls"><?php echo $companies['Country']['country']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">State</label>
                                <div class="controls"><?php echo $companies['State']['state']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">City</label>
                                <div class="controls"><?php echo $companies['City']['city']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Zip</label>
                                <div class="controls"><?php echo $companies['Company']['zip']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Phone</label>
                                <div class="controls"><?php echo $companies['Company']['phone']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Ownership</label>
                                <div class="controls"><?php echo $companies['Company']['ownership']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Structure</label>
                                <div class="controls"><?php echo $companies['Company']['structure_id']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Classification</label>
                                <div class="controls"><?php echo $companies['Company']['industry_classification_id']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Revenue</label>
                                <div class="controls"><?php echo $companies['Company']['revenue']; ?></div>
                            </div>
                            
                            <div class="control-group">
                                <label for="textfield" class="control-label">Created</label>
                                <div class="controls"><?php echo $companies['Company']['created'];?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Status</label>
                                <div class="controls"><?php echo ($companies['Company']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
                            </div>
                            
                          

<!--                           <div class="control-group">
                                <label for="textfield" class="control-label">Image</label>
                                <div class="controls">
                                    <?php echo $testimonials['Testimonial']['image']; ?>
                                    <?php if (isset($testimonials['Testimonial']['image']) && $testimonials['Testimonial']['image'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'testimonial_images' . DS . $testimonials['Testimonial']['image'])) { ?>	
                                        <div class="catepic" style="float:none; width:200px;">
                                            <?php
                                            echo $this->Html->Image('../uploads/testimonial_images/' . $testimonials['Testimonial']['image'], array('height' => 100, 'width' => 100));
                                            ?>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>-->



                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                       					
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




