
<ul class="tabs tabs-inline tabs-left">
<?php
$controller = $this->params['controller'];
$action = $this->params['action'];
$inbox = '';
$sent = '';
$trash = '';
if ($controller == 'messages' && $action == 'admin_index') {
    $inbox = ' active';
}
if ($controller == 'messages' && $action == 'admin_sentbox') {
    $sent = ' active';
}
if ($controller == 'messages' && $action == 'admin_trashbox') {
    $trash = ' active';
}
?>
<li class='write hidden-480'>
<!--    <a href="#">Write message</a>-->
<?php echo $this->Html->link('Write Message',array('action'=>'send'));?>
<!--    <a class='write_message' href="#write_message">Write message</a>-->
</li>
<li class='<?php echo $inbox;?>'>
    <a href="<?php echo SITEURL;?>admin/messages">
        <i class="icon-inbox"></i> 
        Inbox <strong id="inboxCount">(<?php echo $this->Common->getUnread($this->Session->read('Auth.Admin.id'));?>)</strong>
    </a>
</li>
<li class='<?php echo $sent;?>' >
    <a href="<?php echo SITEURL;?>admin/messages/sentbox" ><i class="icon-share-alt"></i> Sent items</a>
</li>
<li class='<?php echo $trash;?>'>
    <a href="<?php echo SITEURL;?>admin/messages/trashbox" ><i class="icon-trash"></i> Trash</a>
</li>
<!--<li>
    <a href="#draft" data-toggle="tab"><i class="icon-share-alt"></i> Draft</a>
</li>-->
<script>
    jQuery(document).ready(function () {
        $(".write_message").colorbox({inline:true, width:"50%"});
    });
</script>
</ul>
<div class="tab-content tab-content-inline">
    <div class="tab-pane active" id="inbox">

        <div class="highlight-toolbar">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <div class="btn-group visible-480">
                        <a href="" class="btn btn-danger">New</a>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo SITEURL; ?>admin/messages/" class="btn" rel="tooltip" data-placement="bottom" title="Refresh results">
                            <i class="icon-refresh"></i>
                        </a>
                    </div>
                    <div class="btn-group hidden-768">
                        <div class="dropdown">
                            <a href="#" class="btn" data-toggle="dropdown" rel="tooltip" data-placement="bottom" title="Mark elements"><i class="icon-check-empty"></i><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);" class='read-unread sel-read' itemid="inbox" id="Read">Read</a></li>
                                <li><a href="javascript:void(0);" class='read-unread sel-unread' itemid="inbox"  id="Unread">Unread</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class='btn delete-in-trash' rel="tooltip"   id="Delete" itemid="inbox" data-placement="bottom" title="Delete"><i class="icon-trash"></i></a>
                    </div>
                    <div class="btn-group hidden-768">
                        <div class="dropdown">
                            <a href="#" class="btn" data-toggle="dropdown" rel="tooltip" data-placement="bottom" title="Move to folder"><i class="icon-folder-close"></i><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Some folder</a></li>
                                <li><a href="#">Another folder</a></li>
                            </ul>
                        </div>
                    </div>
                </div></div>
            <div class="pull-right">
                <div class="btn-toolbar">
                    <div class="loading btn-group text" style="display: none; width:100px !important; text-decoration-color: #000 !important;">
                        <?php echo $this->Html->Image('loading.gif'); ?> <a style="text-decoration:none;">Loading...</a>
                    </div>
                    <?php echo $this->element('pagination_message'); ?>

                    <div class="btn-group hidden-768">
                        <div class="dropdown">
                            <a href="#" class="btn" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Account settings</a></li>
                                <li><a href="#">Email settings</a></li>
                                <li><a href="#">Themes</a></li>
                                <li><a href="#">Help &amp; FAQ</a></li>
                            </ul>
                        </div>
                    </div>
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
                        $class = ($inbox['MessageUser']['read_flag'] == 0) ? 'unread warning' : 'read';
                        //pr($inbox);
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <td class='table-checkbox hidden-480'>
                                <?php echo $this->Form->input('MessageUser.id', array("value" => $inbox['MessageUser']['id'], "id" => $inbox['MessageUser']['id'], "div" => false, "label" => false, "type" => "checkbox", "class" => "selectable")); ?>
                            </td>
                            <td class='table-icon hidden-480'>
                                <a href="#" class="sel-star <?php echo isset($inbox['Message']['star_flag']) && $inbox['Message']['star_flag'] == 1 ? 'active' : '' ?>"><i class="icon-star"></i></a>
                            </td>
                            <td class='table-fixed-medium'>
                                <?php
                                echo $this->Html->link($this->Common->getUserName($inbox['Message']['sender_id']), array('action' => 'read', $inbox['Message']['id']));
                                ?>
                            </td>
                            <td>
                                <?php echo $inbox['Message']['subject']; ?>
                            </td>
                            <td class='table-icon hidden-480'>
                                <a class='write_message' href="#attachment_list-<?php echo $inbox['Message']['id']; ?>"><i class="icon-paper-clip"></i></a>
                                <div style='display:none'>
                                    <div id='attachment_list-<?php echo $inbox['Message']['id']; ?>' style='padding:10px; background:#fff;'>
                                        <div class="box box-bordered box-color">
                                            <div class="box-title">
                                                <h3><i class="icon-th-list"></i> Attachment List</h3>
                                            </div>
                                            <div class="box-content nopadding">
                                                <?php
                                                if (isset($inbox['MessageAttachment'])) {
                                                    echo $this->Form->create('Message', array('class' => 'form-horizontal form-bordered'));
                                                    foreach ($inbox['MessageAttachment'] as $filesN) {
                                                        ?>

                                                        <div class="control-group">
                                                            <label for="textfield" class="control-label">Attachment : </label>
                                                            <div class="controls">
                                                                <div class="contentArea">
                                                                    <?php
                                                                    echo $this->Html->link(
                                                                            'Attachment :' . $filesN['name'], array(
                                                                        'controller' => 'messages',
                                                                        'action' => 'downloadfile',
                                                                        'message_files',
                                                                        $inbox['Message']['id'],
                                                                        $filesN['name'],
                                                                            )
                                                                    );
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
    </div>
</div>      


<style>
    .write_message,.btn a{text-decoration: none !important;}
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $('.read-unread').click(function () {
            var allVals = [];
            $(".selectable:input[type=\"checkbox\"]").each(function () {
                if ($(this).attr("checked")) {
                    allVals.push($(this).val());
                }
            });
            if (allVals != '') {
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
                    success: function (data, textStatus, xhr) {
                        $("#inboxCount").text('(' + data.count + ')');
                        $("#ajaxSuccessFlashMsg .box-body p").text(data.message);
                        $("#ajaxSuccessFlashMsg").addClass("bg-green").fadeIn();
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
            }
        });

        $('.delete-in-trash').click(function () {
            var allVals = [];
            $(".selectable:input[type=\"checkbox\"]").each(function () {
                if ($(this).attr("checked")) {
                    allVals.push($(this).val());
                }
            });
            if (allVals) {
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
                        var cnt = <?php echo $this->Common->getUnread($this->Session->read('Auth.Admin.id')); ?>;
                        alert(cnt);
                        $("#inboxCount").text('<?php echo $this->Common->getUnread($this->Session->read('Auth.Admin.id')); ?>');
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
