<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins/ckeditor/plugins/ckeditor_wiris/core/display.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins/ckeditor/ckeditor.js"></script>
<!--<div class="box-title">
    <h3><i class="icon-th-list"></i> Compose Message</h3>
    <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                        </h3>
</div>-->
<!--<div class="box-content nopadding">-->

    <?php echo $this->Form->create('Message', array('url'=>array('action'=>'send'),'type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="control-group">
        <label for="textfield" class="control-label">To  <span>*</span></label>
        <div class="controls">
            <div class="contentArea">
                <?php echo $this->Form->input('MessageUser.0.receiver_id', array('options'=> $this->Common->getUserWomanMan(), 'empty' => 'Select User','label' => false,'required' => true, 'div' => false, 'class' => 'select2-me input-xlarge')); ?>

                <?php
                //echo $this->Form->input('Message.to_texbox', array('size' => '30',"autocomplete"=>"off", 'id' => 'inputSearch','style'=>'width:350px;', 'label' => false, 'div' => false, 'class' => 'input-xlarge search'));
                echo $this->Form->input('Message.sender_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.Admin.id')));
                echo $this->Form->input('Message.message_folder_id',array('type'=>'hidden','value'=>SENT_ITEM));
                
                //echo $this->Form->input('MessageUser.message_id',array('type'=>'hidden'));
                //echo $this->Form->input('MessageUser.0.receiver_id',array('type'=>'hidden'));
                echo $this->Form->input('MessageUser.0.message_folder_id',array('type'=>'hidden','value'=>INBOX));
                ?>
                <div id="divResult">
                </div>
            </div>
        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Subject  </label>
        <div class="controls">
                <?php echo $this->Form->input('Message.subject', array('label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Description  </label>
        <div class="controls">
            <textarea id="ckeditor" name="data[Message][description]" cols="50" rows="15">
                    
            </textarea>

        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Attachment</label>
        <div class="controls">
            <div id="mulitplefileuploader">Upload</div>
            <div id="status"></div>
            <?php //echo $this->Form->input('MessageAttachment.name', array('type' => 'file', 'label' => false, 'div' => false, 'class' => '')); ?>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit</button>
<!--        <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/messages/'" class="btn">Cancel</button>-->

    </div>

</form>
<!--</div>-->
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>css/jquery.autocomplete.css" />
<script type="text/javascript" src="<?php echo SITEURL; ?>js/jquery.autocomplete.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#autoComplete").autocomplete("<?php echo Router::url(array('controller' => 'messages', 'action' => 'auto_complete')); ?>", {
            selectFirst: true,
            width: 252,
            matchContains: true,
        });


    });


</script>

<script>
    $("input").focus(function () {
        $(this).select();
    });

    CKEDITOR.replace('ckeditor', {
        toolbarGroups: [
            {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']},
            {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
            {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
            {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
            '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
            {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
            {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
            '/',
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
            {name: 'colors', items: ['TextColor', 'BGColor']},
            {name: 'tools', items: ['Maximize', 'ShowBlocks']},
            {name: 'others', items: ['-']},
            {name: 'about', items: ['About']}
        ],
    });

//    CKEDITOR.replace('ckeditor', {
//                 skin: 'kama',
//                 //language: lang,
//         }); 

    $(function () {
        $(".search").keyup(function ()
        {
            var inputSearch = $(this).val();
            var dataString = 'searchword=' + inputSearch;
            if (inputSearch != '')
            {   
                if(inputSearch != ''){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo Router::url(array('controller' => 'messages', 'action' => 'auto_complete_img')); ?>",
                        data: dataString,
                        beforeSend: function() {
                            // setting a timeout
                            $('#inputSearch').addClass('ac_loading');
                        },
                        cache: false,
                        success: function (html)
                        {
                            $("#divResult").html(html).show();
                        },
                        complete: function() {
                            $('#inputSearch').removeClass('ac_loading');
                        },
                    });
                }
            }
            return false;
        });

        jQuery("#divResult").live("click", function (e) {
            var $clicked = $(e.target);
            var $name = $clicked.find('.name').html();
            var decoded = $("<div/>").html($name).text();
            var id = $clicked.find('.name').attr('id');
            
            $('#MessageUser0ReceiverId').val(id);
            $('#inputSearch').val(decoded);
        });
        jQuery(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search")) {
                jQuery("#divResult").fadeOut();
            }
        });
        $('#inputSearch').click(function () {
            jQuery("#divResult").fadeIn();
        });
    });
</script>

<style type="text/css">
    #divResult
    {
        position:absolute;
        z-index: 3;
        width:361px;
        display:none;
        margin-top:-1px;
        border:solid 1px #dedede;
        border-top:0px;
        overflow:hidden;
        border-bottom-right-radius: 6px;
        border-bottom-left-radius: 6px;
        -moz-border-bottom-right-radius: 6px;
        -moz-border-bottom-left-radius: 6px;
        box-shadow: 0px 0px 5px #999;
        border-width: 3px 1px 1px;
        border-style: solid;
        border-color: #333 #DEDEDE #DEDEDE;
        background-color: white;
    }
    .display_box
    {
        padding:4px; 
        border-top:solid 1px #dedede; 
        font-size:12px; 
        height:58px;
    }
    .display_box:hover
    {
        background:#3bb998;
        color:#FFFFFF;
        cursor:pointer;
    }
</style>








