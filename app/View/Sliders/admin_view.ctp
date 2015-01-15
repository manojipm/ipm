<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/sliders">Slider</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">View Slider</a>
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
                        <h3><i class="icon-th-list"></i> Sliders - View Slider</h3> 
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Slider Title</label>
                            <div class="controls">
                                <?php echo $slider['Slider']['title']; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Description</label>
                            <div class="controls">
                                <?php echo $slider['Slider']['description']; ?>
                            </div>
                        </div>



                        <div class="control-group">
                            <label for="textfield" class="control-label">Image</label>
                            <div class="controls">
                                
                                <?php if (isset($slider['Slider']['slider_image']) && $slider['Slider']['slider_image'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'slider_images' . DS . $slider['Slider']['slider_image'])) { ?>	
                                        <?php
                                        echo $this->Html->Image('../uploads/slider_images/' . $slider['Slider']['slider_image'], array('height' => 100, 'width' => 100));
                                        ?>
                                <?php } ?>

                            </div>
                        </div>
                        

                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls"><?php echo ($slider['Slider']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>