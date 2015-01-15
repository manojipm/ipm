
<div class="highlight-toolbar">
    <div class="pull-left"><div class="btn-toolbar">
            <div class="btn-group">
                <div class="dropdown hidden-768">

                </div>
            </div>
            <div class="btn-group">
                <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'sentbox')); ?>" class="btn" rel="tooltip" data-placement="bottom" title="Refresh results">
                    <i class="icon-refresh"></i>
                </a>
            </div>
            <div class="btn-group">
                <a href="javascript:void(0);" class='btn delete-in-trash' rel="tooltip"  id="Delete" itemid="sent" data-placement="bottom" title="Delete"><i class="icon-trash"></i></a>
            </div>

        </div></div>
    <div class="pull-right">
        <div class="btn-toolbar">
            <div class="loading btn-group text" style="display: none; width:100px !important; text-decoration-color: #000 !important;">
                <?php echo $this->Html->Image('loading.gif'); ?> <a style="text-decoration:none;">Loading...</a>
            </div>
            <?php echo $this->element('pagination_message'); ?>

        </div>
    </div>
</div>
<table class="table table-striped table-nomargin table-mail">
    <thead>
        <tr>
            <th class='table-checkbox'>
                <input type="checkbox" id='selectall-sent'>
            </th>
            <th class='table-icon hidden-480'></th>
            <th>Receiver</th>
            <th>Subject</th>
            <th class='table-icon hidden-480'></th>
            <th class='table-date hidden-480'>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //pr($sents);							
        if (!empty($sents)) {
            $num = 1;
            foreach ($sents as $sent) {
                //pr($sent);
                ?>
                <?php
                $class = ($sent['Message']['star_flag'] == 0) ? 'unread' : '';
                ?>
                <tr class="<?php echo $class; ?>">
                    <td class='table-checkbox hidden-480'>
                        <?php echo $this->Form->input('Message.id', array("value" => $sent['Message']['id'], "id" => $sent['Message']['id'], "div" => false, "label" => false, "type" => "checkbox", "class" => "selectable")); ?>
                    </td>
                    <td class='table-icon hidden-480'>
                        <a href="javascript:void(0);" id="<?php echo $sent['Message']['id'];?>" itemid="<?php echo $sent['Message']['star_flag'];?>" 
                           class="sel-star <?php echo isset($sent['Message']['star_flag']) && $sent['Message']['star_flag'] == 1 ? 'active' : '' ?>">
                            <i class="icon-star"></i>
                        </a>
                    </td>
                    <td class='table-fixed-medium'>
                        <?php
                        echo $this->Html->link($this->Common->getUserName($sent['Message']['sender_id']), array('action' => 'read', $sent['Message']['id'],'sent'));
                        ?>
                    </td>
                    <td>
                        <?php echo $sent['Message']['subject']; ?>
                    </td>
                    <td class='table-icon hidden-480'>
                        
                        <?php if(isset($sent['MessageAttachment']) && !empty($sent['MessageAttachment'])){?>
                        <a class='write_message' href="#attachment_list-<?php echo $sent['Message']['id']; ?>"><i class="icon-paper-clip"></i></a>
                        <?php } ?>
                        <div style='display:none'>
                            <div id='attachment_list-<?php echo $sent['Message']['id']; ?>' style='padding:10px; background:#fff; '>
                                <div class="box box-bordered box-color">
                                    <div class="box-title">
                                        <h3><i class="icon-th-list"></i> Attachment List</h3>
                                    </div>
                                    <div class="box-content nopadding">
                                        <?php
                                        if (isset($sent['MessageAttachment']) && !empty($sent['MessageAttachment'])) {
                                            echo $this->Form->create('Message', array('class' => 'form-horizontal form-bordered'));
                                            foreach ($sent['MessageAttachment'] as $filesN) {
                                                ?>

                                                <div class="control-group">
                                                    <label for="textfield" class="control-label">Attachment : </label>
                                                    <div class="controls">
                                                        <div class="contentArea">
                                                            <?php
                                                            if(is_file(WWW_ROOT . MESSAGE_FILE_PATH . DS .$sent['Message']['id'].DS .'attachment'.DS.$filesN['name'])){
                                                               echo $this->Html->link(
                                                                        'Attachment :' . $filesN['name'], array(
                                                                            'controller' => 'messages',
                                                                            'action' => 'downloadfile',
                                                                            'folder'=>'message_files',
                                                                            'id'=>$sent['Message']['id'],
                                                                            'name'=>$filesN['name'],
                                                                    )
                                                                );
                                                            }else{
                                                                echo 'Not avialable file.';
                                                            }
                                                            
                                                            ?>  
                                                            
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php
                                            }
                                            echo $this->Form->end();
                                        } else { ?>
                                            <div class="control-group">
                                                <label for="textfield" class="control-label"></label>
                                                <div class="controls">
                                                    <div class="contentArea" style="margin-left: 200px;margin-top: -6px;font-size: 20px;">
                                                        <?php
                                                        echo 'No attachments found!';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='table-date hidden-480'>
                        <?php echo $sent['Message']['created']; ?>
                    </td>
                </tr>

                <?php
                $num++;
            }//end foreach
        } else {
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" >No Record Found !!!</td>
                <td></td>
                <td></td>

            </tr>
            <?php
        }
        ?>

    </tbody>
</table>


<style>
    .write_message,.btn a{text-decoration: none !important;}
</style>
<script>
    $(document).ready(function () {
        $('#selectall-sent').change(function () {
            var isSelected = $(this).is(':checked');
            if (isSelected) {
                $('.selectable').parents().addClass('checked');
                $('.selectable').prop('checked', true);
            } else {
                $('.selectable').parents().removeClass('checked');
                $('.selectable').prop('checked', false);
            }
        });

        $(".message_file_list").colorbox({inline: true, width:30, });
    });

</script>
<script>
    $(document).ready(function () {
        $('.sel-star').click(function () {
                var formUrl = '<?php echo Router::url(array('controller' => 'messages', 'action' => 'star_flag')); ?>';
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: formUrl,
                    data: {
                        'data[Message][id]': $(this).attr('id'),
                        'data[Message][star_flag]': $(this).attr("itemid"),
                    },
                    beforeSend: function (xhr) {
                        $(".loading").show();
                    },
                    success: function (data) {
                        //alert(data);
                        //$("#sent").html(data);
                        
                    },
                    complete: function () {
                        $(".loading").hide();
                    },
                    error: function (xhr, textStatus, error) {
                        $("#ajaxSuccessFlashMsg .box-body p").text('There are some error occurs while star flag mail(s).');
                        $("#ajaxSuccessFlashMsg").addClass("bg-red").fadeIn();
                        setTimeout(function () {
                            $("#ajaxSuccessFlashMsg").fadeOut('slow');
                        }, 2000)
                    }
                });
                return false;
        });
        
        
        
        
        $('.delete-in-trash').click(function () {
            var allVals = [];
            $(".selectable:input[type=\"checkbox\"]").each(function () {
                if ($(this).attr("checked")) {
                    allVals.push($(this).val());
                }
            });
            if (allVals !='') {
                var formUrl = '<?php echo Router::url(array('controller' => 'messages', 'action' => 'delete_in_trash')); ?>';
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: formUrl,
                    data: {
                        'data[MessageUser][id]': allVals,
                        'data[MessageUser][read_flag]': $(this).attr("id"),
                        'data[MessageUser][type]': $(this).attr("itemid")
                    },
                    beforeSend: function (xhr) {
                        $(".loading").show();
                    },
                    success: function (data) {
                        $("#sent").html(data);
                        $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal'
                        });
                        $("#ajaxSuccessFlashMsg .box-body p").text('There are some mail(s) Deleted.');
                        $("#ajaxSuccessFlashMsg").addClass("bg-green").fadeIn();
                        setTimeout(function () {
                            $("#ajaxSuccessFlashMsg").fadeOut('slow');
                        }, 2000)
                    },
                    complete: function () {
                        $(".loading").hide();
                    },
                    error: function (xhr, textStatus, error) {
                        $("#ajaxSuccessFlashMsg .box-body p").text('There are some error occurs while deleteing mail(s).');
                        $("#ajaxSuccessFlashMsg").addClass("bg-red").fadeIn();
                        setTimeout(function () {
                            $("#ajaxSuccessFlashMsg").fadeOut('slow');
                        }, 2000)
                    }
                });
                return false;
            }else{
                $("#ajaxSuccessFlashMsg .box-body p").text('Please select atleast one item.');
                $("#ajaxSuccessFlashMsg").addClass("bg-red").fadeIn();
                setTimeout(function () {
                    $("#ajaxSuccessFlashMsg").fadeOut('slow');
                }, 2000)
            }
        });






        $(".ajax-pagination a").click(function () {
            var hrf = this.href;
            if (hrf) {
                $.ajax({
                    url: this.href,
                    type: "POST",
                    dataType: 'html',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                        $(".loading").show();
                    },
                    success: function (data) {
                        $("#sent").html(data);
                        $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal'
                        });
                    },
                    complete: function () {
                        $(".loading").hide();
                    }
                });

                return false;
            }

        })

    });
</script>
<?php echo $this->Js->writeBuffer(); ?>