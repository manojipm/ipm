<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/projects/category">Project Category</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">View Project Category</a>
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
                        <h3><i class="icon-th-list"></i> Category - View Category</h3>
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'category'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Projects_category', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('Projects_category.id', array('type' => 'hidden', )); ?>
                        
                          
                            <div class="control-group">
                                <label for="textfield" class="control-label">Title</label>
                                <div class="controls"><?php echo $categories['Projects_category']['category']; ?></div>
                            </div>                            
  							<div class="control-group">
                                <label for="textfield" class="control-label">Created</label>
                                <div class="controls"><?php echo $categories['Projects_category']['created'];?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Status</label>
                                <div class="controls"><?php echo ($categories['Projects_category']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
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



