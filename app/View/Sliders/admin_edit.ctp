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
                    <a href="<?php echo SITEURL; ?>admin/sliders">Sliders</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Sliders</a>
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
                        <h3><i class="icon-th-list"></i> Sliders - Edit Sliders</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Slider', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('Slider.id', array('label' => false,'type' => 'hidden', 'div' => false, 'class' => 'form-control')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Sliders Title <span>*</span></label>
                            <div class="controls">
                               <?php echo $this->Form->input('Slider.title', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Sliders Description <span>*</span></label>
                            <div class="controls">
                                <textarea id="ckeditor" name="data[Slider][description]" cols="50" rows="15">
                                        <?php echo $this->request->data['Slider']['description'];?>
                                </textarea>
                               
                                <?php //echo $this->Form->input('Slider.description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Slider For <span>*</span></label>
                            <div class="controls">
                                
                            <?php echo $this->Form->input('Slider.role_id', array('options'=> $roles,'label' => false, 'div' => false, 'class' => 'select2-me input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Image</label>
                            <div class="controls">
                                <?php echo $this->Form->input('Slider.slider_image', array('type'=>'file','label' => false, 'div' => false,  'required' => false, 'class' => 'input-xlarge')); ?>
                                <?php if (isset($this->request->data['Slider']['slider_image']) && $this->request->data['Slider']['slider_image'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'slider_images' . DS . $this->request->data['Slider']['slider_image'])) { ?>	
                                    <div class="catepic" style="float:none; width:200px;">
                                        <?php
                                        echo $this->Html->Image('../uploads/slider_images/' . $this->request->data['Slider']['slider_image'], array('height' => 100, 'width' => 100));
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                                <?php
                                echo $this->Form->checkbox('Slider.status', array(
                                    'hiddenField' => false,
                                ));
                                ?>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/sliders'" class="btn">Cancel</button>
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