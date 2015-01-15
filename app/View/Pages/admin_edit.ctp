<script type="text/javascript" src="<?php echo SITEURL;?>js/plugins/ckeditor/plugins/ckeditor_wiris/core/display.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>js/plugins/ckeditor/ckeditor.js"></script>
<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/pages">Pages</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Page</a>
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
                        <h3><i class="icon-th-list"></i> Pages - Edit Page</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Page', array('type' => 'file', 'class' => 'form-horizontal form-bordered form-wysiwyg')); ?>
                        
                        <div class="control-group">
                            <label for="textfield" class="control-label">Page Name <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('name', array('label' => false,'div'=>false,'readonly'=>'readonly', 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Title <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('meta_title', array('label' => false,'div'=>false,'maxlength'=>65,'class' => 'input-xlarge', 'required'=>true)); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Meta Keywords</label>
                            <div class="controls">
                                <?php echo $this->Form->input('meta_keywords', array('label' => false,'div'=>false,'maxlength'=>160, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Meta Description</label>
                            <div class="controls">
                                <?php echo $this->Form->input('meta_description', array('type' => 'textarea','label' => false,'div'=>false,'maxlength'=>256, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="textfield" class="control-label">Page Content</label>
                            <div class="controls">
                                <div class="box">
                                    <textarea id="ckeditor" name="data[Page][content]" cols="50" rows="15">
                                        <?php echo $this->request->data['Page']['content'];?>
                                    </textarea>
                                    
                                </div>
                                
                            </div>
                        </div>
						<?php if(isset($this->data['Page']['image']) && !empty($this->data['Page']['image'])){ ?>
						<div class="control-group">
                            <label for="textfield" class="control-label">Image</label>
                            <div class="controls">
                                <?php echo $this->Form->input('Page.image', array('type' => 'file', 'multiple' => false, 'label' => false, 'required' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
								<?php 
								if(isset($this->request->data['Page']['image']) && !is_array($this->request->data['Page']['image'])){
									
									if (!empty($this->request->data['Page']['image'])  && file_exists(WWW_ROOT . 'uploads' . DS . 'page_images' . DS . $this->request->data['Page']['image'])) { ?>	
										<div class="catepic" style="float:none; width:200px;">
											<?php
											echo $this->Html->Image('../uploads/page_images/' . $this->request->data['Page']['image'], array('height' => 100, 'width' => 100));
											?>
										</div>
								<?php 

									} 
								}
								?>
                            </div>
                        </div>
						<?php } ?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/pages'" class="btn">
Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('ckeditor', {
                 skin: 'kama',
                 //language: lang,
         }); 
 </script>