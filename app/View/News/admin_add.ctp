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
                    <a href="<?php echo SITEURL; ?>admin/news">News</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Add News</a>
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
                        <h3><i class="icon-th-list"></i> News - Add News</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('New', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">News Title  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('News.title', array('label' => false, 'div' => false,  'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">News Description <span>*</span></label>
                            <div class="controls">
                                <textarea id="ckeditor" name="data[News][description]" cols="50" rows="15">
                                        <?php //echo $this->request->data['News']['description'];?>
                                </textarea>
                                <?php //echo $this->Form->input('News.description', array('label' => false, 'type' => 'textarea', 'div' => false, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">News For <span>*</span></label>
                            <div class="controls">
                                
                            <?php echo $this->Form->input('News.role_id', array('options'=> $roles,'label' => false, 'div' => false, 'class' => 'select2-me input-xlarge')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Published  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('News.published', array('label' => false, 'div' => false,  'required' => true, 'class' => 'input-xlarge datepickpub','value'=>date('m/d/Y'),'readonly')); ?>
                            </div>
                        </div>
                        
			 <div class="control-group">
                            <label for="textfield" class="control-label">Image  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('News.news_image', array('type'=>'file','label' => false, 'div' => false,  'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>			
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                               <?php
                                echo $this->Form->checkbox('News.status', array(
                                        'checked' => 'checked',
                                        'hiddenField' => false,
                                )); ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/news'" class="btn">Cancel</button>
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