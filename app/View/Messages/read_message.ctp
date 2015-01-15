<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins/ckeditor/plugins/ckeditor_wiris/core/display.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins/ckeditor/ckeditor.js"></script>
<!--<div class="box-title">
    <h3><i class="icon-th-list"></i> Read Message</h3>
    <h3 style="float: right; margin-right: 10px; font-size: 13px;">
        <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
    </h3>
</div>-->
<!--<div class="box-content nopadding">-->
    <?php echo $this->Form->create('Message', array('url'=>array('action'=>'send'),'type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="control-group">
        <label for="textfield" class="control-label">To  </label>
        <div class="controls">
            <div class="contentArea">
                <?php echo $this->Common->getUserName($message['Message']['sender_id']);?>
            </div>
        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Subject  </label>
        <div class="controls">
                <?php echo $message['Message']['subject'];?>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Description  </label>
        <div class="controls">
            <?php echo $message['Message']['description'];?>

        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Attachment</label>
        <div class="controls">
            <?php //pr($message);
                                if(isset($message['MessageAttachment']) && !empty($message['MessageAttachment'])){
                                    foreach($message['MessageAttachment'] as $filesN){ ?>
                                        
                                        
                                                <div class="contentArea">
                                                    <?php
                                                     echo $this->Html->link(
                                                             'Attachment :' . $filesN['name'], 
                                                             array(
                                                                    'controller' => 'messages',
                                                                    'action' => 'downloadfile',
                                                                    'folder'=>'message_files',
                                                                    'id'=>$message['Message']['id'],
                                                                    'name'=>$filesN['name'],
                                                            )
                                                    );?>
                                        </div>
                                        
                                       
                                <?php    }
                                }else{
                                echo 'No attachments found!';

                                }
                                ?>
        
        
        </div>
    </div>
    

</form>
<!--</div>-->





