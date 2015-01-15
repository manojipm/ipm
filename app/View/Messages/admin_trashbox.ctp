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
                            <div class="tab-pane active" id="trash">                     
                                <?php include 'trash.ctp'; ?>
                            </div>

                        </div>  
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
