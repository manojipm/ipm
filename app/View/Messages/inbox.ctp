
        <div class="highlight-toolbar">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <div class="btn-group visible-480">
                        <a href="" class="btn btn-danger">New</a>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'index')); ?>" class="btn" rel="tooltip" data-placement="bottom" title="Refresh results">
                            <i class="icon-refresh"></i>
                        </a>
                    </div>
                    <div class="btn-group hidden-768">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="btn" data-toggle="dropdown" rel="tooltip" data-placement="bottom" title="Mark elements">
                                <i class="icon-check-empty"></i>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);" class='read-unread sel-read' itemid="inbox" id="Read">Read</a></li>
                                <li><a href="javascript:void(0);" class='read-unread sel-unread' itemid="inbox"  id="Unread">Unread</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class='btn delete-in-trash' rel="tooltip"   id="Delete" itemid="inbox" data-placement="bottom" title="Delete"><i class="icon-trash"></i></a>
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
                        <input type="checkbox" id='selectall'>
                    </th>
                    <th class='table-icon hidden-480'></th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th class='table-icon hidden-480'></th>
                    <th class='table-date hidden-480'>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($inboxes)) {
                    $num = 1;
                    foreach ($inboxes as $inbox) {
                        ?>
                        <?php
                        $class = ($inbox['MessageUser']['read_flag'] == 0) ? 'warning' : 'read';
                        //pr($inbox);
                        ?>
                        <tr class="<?php echo $class; ?>" id="tr-<?php echo $inbox['MessageUser']['id'];?>">
                            <td class='table-checkbox hidden-480'>
                                <?php echo $this->Form->input('MessageUser.id', array("value" => $inbox['MessageUser']['id'], "id" => $inbox['MessageUser']['id'], "div" => false, "label" => false, "type" => "checkbox", "class" => "selectable")); ?>
                            </td>
                           <td class='table-icon hidden-480'>
                                <a href="javascript:void(0);" id="<?php echo $inbox['Message']['id'];?>" itemid="<?php echo $inbox['Message']['star_flag'];?>" 
                                   class="sel-star <?php echo isset($inbox['Message']['star_flag']) && $inbox['Message']['star_flag'] == 1 ? 'active' : '' ?>">
                                    <i class="icon-star"></i>
                                </a>
                            </td>
                            <td class='table-fixed-medium'>
                                <?php
                                echo $this->Html->link($this->Common->getUserName($inbox['MessageUser']['receiver_id']), array('action' => 'read', $inbox['MessageUser']['message_id'],'inbox'));
                                ?>
                            </td>
                            <td>
                                <?php echo $inbox['Message']['subject']; ?>
                            </td>
                            <td class='table-icon hidden-480'>
                                <?php if(isset($inbox['Message']['MessageAttachment']) && !empty($inbox['Message']['MessageAttachment'])){?>
                                <a class='write_message' href="#attachment_list-<?php echo $inbox['Message']['id']; ?>"><i class="icon-paper-clip"></i></a>
                                <?php } ?>
                                
                                <div style='display:none'>
                                    <div id='attachment_list-<?php echo $inbox['Message']['id']; ?>' style='padding:10px; background:#fff;'>
                                        <div class="box box-bordered box-color">
                                            <div class="box-title">
                                                <h3><i class="icon-th-list"></i> Attachment List</h3>
                                            </div>
                                            <div class="box-content nopadding">
                                                <?php
                                                
                                                if (isset($inbox['Message']['MessageAttachment'])) {
                                                    
                                                    echo $this->Form->create('Message', array('class' => 'form-horizontal form-bordered'));
                                                    foreach ($inbox['Message']['MessageAttachment'] as $filesN) {
                                                        ?>

                                                        <div class="control-group">
                                                            <label for="textfield" class="control-label">Attachment : </label>
                                                            <div class="controls">
                                                                <div class="contentArea">
                                                            <?php
                                                            if(is_file(WWW_ROOT . MESSAGE_FILE_PATH . DS .$inbox['Message']['id'].DS .'attachment'.DS.$filesN['name'])){
                                                               echo $this->Html->link(
                                                                        'Attachment :' . $filesN['name'], array(
                                                                            'controller' => 'messages',
                                                                            'action' => 'downloadfile',
                                                                            'folder'=>'message_files',
                                                                            'id'=>$inbox['Message']['id'],
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
                                <?php echo $inbox['Message']['created']; ?>
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


<script type="text/javascript">
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
        
        
        
        
        
        
        
        
        $('.read-unread').click(function () {
            var allVals = [];
            $(".selectable:input[type=\"checkbox\"]").each(function () {
                if ($(this).attr("checked")) {
                    allVals.push($(this).val());
                }
            });
            if (allVals != '') {
                var type = $(this).attr("id");
                var formUrl = '<?php echo Router::url(array('controller' => 'messages', 'action' => 'read_unread')); ?>';
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
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
                        
                        //$("#selectall").prop( "checked", false ).parent().removeClass('checked');
                        //$(".selectable").prop( "checked", false ).parent().removeClass('checked');
                        if(data.count != 0)
                            $("#inboxCount").text('(' + data.count + ')');
                        else
                           $("#inboxCount").text('');
                       
                        $("#ajaxSuccessFlashMsg .box-body p").text(data.message);
                        $("#ajaxSuccessFlashMsg").addClass("bg-green").fadeIn();
                        $.each(allVals, function( index, value ) {
                            if(type == 'Read'){
                                $("#tr-"+value).removeClass("warning").addClass('read');  
                            }
                            if(type == 'Unread'){
                                $("#tr-"+value).removeClass("read").addClass('warning');   
                            }
                        });
                        setTimeout(function () {
                            $("#ajaxSuccessFlashMsg").fadeOut('slow');
                        }, 2000)
                    },
                    complete: function () {
                        $(".loading").hide();
                    },
                    error: function (xhr, textStatus, error) {
                        $("#ajaxSuccessFlashMsg .box-body p").text(data.message);
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

        $('.delete-in-trash').click(function () {
            var allVals = [];
            $(".selectable:input[type=\"checkbox\"]").each(function () {
                if ($(this).attr("checked")) {
                    allVals.push($(this).val());
                }
            });
            
            if (allVals != '') {
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
                        $("#inbox").html(data);
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
                        if($(this).attr("itemid") == 'inbox'){
                            $.post( "<?php echo Router::url(array('controller' => 'messages', 'action' => 'count_unread')); ?>", function( data ) {
                                if(data != 0)
                                    $("#inboxCount").text('('+data+')');
                                else
                                   $("#inboxCount").text(''); 
        
                                
                            });
                        }
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
        
    });
</script>


<script>
    $(document).ready(function () {
        $('#selectall').change(function () {
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


<script>
    $(document).ready(function () {
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
                        $("#inbox").html(data);
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
