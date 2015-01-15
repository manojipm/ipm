<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Messages</a>
                </li>
            </ul>
            <div class="close-bread">
                <a href="#">
                    <i class="icon-remove"></i>
                </a>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-bordered box-color">
                    <div class="box-title">
                        <h3>
                            <i class="icon-envelope"></i>
                            Message Center
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <ul class="tabs tabs-inline tabs-left">
                            <?php include 'leftbar.ctp'; ?>
                        </ul>
                        <div class="tab-content tab-content-inline">
                            <div class="tab-pane active" id="inbox">
                                <?php include 'read_message.ctp'; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="<?php echo SITEURL; ?>js/plugins/fileupload/jquery.uploadfile.min.js"></script>
<link href="<?php echo SITEURL; ?>css/uploadfile.css" rel="stylesheet">
<script>
    $(document).ready(function ()
    {
        var settings = {
            url: "<?php echo Router::url(array('controller' => 'messages', 'action' => 'upload')); ?>",
            dragDrop: true,
            fileName: "attachment",
            allowedTypes: "jpg,png,gif,doc,pdf,zip",
            returnType: "json",
            //formData: {"name":"Ravi","age":31},
            maxFileSize:1024*100,
            dragDrop: true,
            dragDropStr: "<span><b></b></span>",
            onSuccess: function (files, data, xhr)
            {
                // alert((data));
            },
            showDelete: true,
            deleteCallback: function (data, pd)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $.post("<?php echo Router::url(array('controller' => 'messages', 'action' => 'upload_file_delete')); ?>", {op: "delete", name: data[i]},
                    function (resp, textStatus, jqXHR)
                    {
                        //Show Message  
                        $("#status").append("<div>File Deleted</div>");
                    });
                }
                pd.statusbar.hide(); //You choice to hide/not.

            }

        }
        var uploadObj = $("#mulitplefileuploader").uploadFile(settings);


    });
</script>

