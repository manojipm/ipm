
<div class="highlight-toolbar">
    <div class="pull-left"><div class="btn-toolbar">
            <div class="btn-group">

            </div>
            <div class="btn-group">
                <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'trashbox')); ?>" class="btn" rel="tooltip" data-placement="bottom" title="Refresh results">
                    <i class="icon-refresh"></i>
                </a>
            </div>
            <div class="btn-group">
                <a href="javascript:void(0);" class='btn delete-in-trash' itemid="trash" rel="tooltip" data-placement="bottom" title="Delete">
                    <i class="icon-trash"></i>
                </a>
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
                <input type="checkbox" id='selectall-trash'>
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
        //pr($trashs);							
        if (!empty($trashes)) {
            $num = 1;
            foreach ($trashes as $trash) {
                //pr($trashes);
                ?>
                <?php
                $class = ($trash['MessageUser']['read_flag'] == 0) && ($trash['MessageUser']['message_folder_id'] == 0) ? 'warning' : 'read';
                ?>
                <tr class="<?php echo $class; ?>" id="tr-<?php echo $trash['MessageUser']['id']; ?>">
                    <td class='table-checkbox hidden-480'>
                        <?php 
                        $value = ($trash['MessageUser']['message_folder_id'] == TRASH ) ? $trash['MessageUser']['id'] : $trash['Message']['id'];
                        echo $this->Form->input('Message.id', 
                                array("value" => $value, 
                                    "id" => $trash['Message']['id'],
                                    'itemid'=>$trash['MessageUser']['message_folder_id'], 
                                    "div" => false, "label" => false, 
                                    "type" => "checkbox", 
                                    "class" => "selectable")
                                ); 
                        ?>
                    </td>
                    <td class='table-icon hidden-480'>
                        <a href="javascript:void(0);" id="<?php echo $trash['Message']['id'];?>" itemid="<?php echo $trash['Message']['star_flag'];?>" 
                           class="sel-star <?php echo isset($trash['Message']['star_flag']) && $trash['Message']['star_flag'] == 1 ? 'active' : '' ?>">
                            <i class="icon-star"></i>
                        </a>
                    </td>
                    <td class='table-fixed-medium'>
                        <?php
                        $user = '';
                        if(isset($trash['Message']['message_folder_id']) && $trash['Message']['message_folder_id'] == TRASH){
                            $user = $trash['Message']['sender_id'];
                        }else{
                            $user = $trash['MessageUser']['receiver_id'];
                        }
                        echo $this->Html->link($this->Common->getUserName($user), array('action' => 'read', $trash['Message']['id'],'trash'));
                        ?>
                    </td>
                    <td>
                        <?php echo $trash['Message']['subject']; ?>
                    </td>
                    <td class='table-icon hidden-480'>
                        <?php if (isset($trash['MessageAttachment']) && !empty($trash['MessageAttachment'])) { ?>
                            <a class='write_message' href="#attachment_list-<?php echo $trash['Message']['id']; ?>"><i class="icon-paper-clip"></i></a>
                        <?php } ?>
                        <div style='display:none'>
                            <div id='attachment_list-<?php echo $trash['Message']['id']; ?>' style='padding:10px; background:#fff;'>
                                <div class="box box-bordered box-color">
                                    <div class="box-title">
                                        <h3><i class="icon-th-list"></i> Attachment List</h3>
                                    </div>
                                    <div class="box-content nopadding">
                                        <?php
                                        if (isset($trash['MessageAttachment'])) {
                                            echo $this->Form->create('Message', array('class' => 'form-horizontal form-bordered'));
                                            foreach ($trash['MessageAttachment'] as $filesN) {
                                                ?>

                                                <div class="control-group">
                                                    <label for="textfield" class="control-label">Attachment : </label>
                                                    <div class="controls">
                                                        <div class="contentArea">
                                                            <?php
                                                            if(is_file(WWW_ROOT . MESSAGE_FILE_PATH . DS .$trash['Message']['id'].DS .'attachment'.DS.$filesN['name'])){
                                                               echo $this->Html->link(
                                                                        'Attachment :' . $filesN['name'], array(
                                                                            'controller' => 'messages',
                                                                            'action' => 'downloadfile',
                                                                            'folder'=>'message_files',
                                                                            'id'=>$trash['Message']['id'],
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
                                        } else {


                                            echo 'No attachments found!';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='table-date hidden-480'>
                        <?php echo $trash['Message']['created']; ?>
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



<script>
    $(document).ready(function () {
        $('#selectall-trash').change(function () {
            var isSelected = $(this).is(':checked');
            if (isSelected) {
                $('.selectable').parents().addClass('checked');
                $('.selectable').prop('checked', true);
            } else {
                $('.selectable').parents().removeClass('checked');
                $('.selectable').prop('checked', false);
            }
        });

        $(".message_file_list").colorbox({inline: true, });
    });

</script>
<style>
    .write_message,.btn a{text-decoration: none !important;}
</style>
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
                       // alert(data);
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
                        $("#trash").html(data);
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





    $('.delete-in-trash').click(function () {
        var allVals = [];
        $(".selectable:input[type=\"checkbox\"]:checked").each(function (key , val) {
                itemid = $(this).attr("itemid");
                allVals.push({
                    type: itemid, 
                    id:  $(this).val()
                });
        });

        //console.log(allVals);
        if (allVals != '') {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '<?php echo Router::url(array('controller' => 'messages', 'action' => 'delete_from_trash')); ?>',
                data: {
                    'data[Message][id]': allVals,
                    'data[Message][type]': $(this).attr("itemid"),
                },
                beforeSend: function (xhr) {
                    $(".loading").show();
                },
                success: function (data) {
                   $("#trash").html(data);
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

</script>
<?php echo $this->Js->writeBuffer(); ?>