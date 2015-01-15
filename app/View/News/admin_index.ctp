<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">News</a>
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
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3>
                            <i class="icon-th-list"></i>
                            News - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <div class="table-holder">
                            <table class="table table-hover table-nomargin dataTable table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Published on</th>
                                        <th>Created on</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									
                                    if (!empty($news)) {
                                        $num = 1;
                                        foreach ($news as $new) {
                                            ?>
                                            <tr>
                                                <td><?php echo $num ?></td>
                                                <td><?php echo $new['News']['title'] ?></td>
                                                <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "news", "action" => "update_status", "admin" => true));
                                                    if ($new['News']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $new['News']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "','" . $new['News']['id'] . "')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $new['News']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $new['News']['id'] . "')"));
                                                    }
                                                    ?></td>

                                                <td> <?php echo CakeTime::format(ADMIN_DATE_FORMAT,$new['News']['published'],null,TIME_ZONE) ; ?>&nbsp;</td>
                                                <td> <?php echo $new['News']['created']; ?>&nbsp;</td>
                                                <td class="actions">
                                                    <?php
                                                    //    echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'view', $new['News']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                    $currDate = date('m/d/Y');
                                                    $published = isset($new['News']['published']) && !empty($new['News']['published']) ? strtotime($new['News']['published']) : $new['News']['created'];
                                                    
                                                    if(trim($published) >= time()){
                                                      echo $this->Html->link($this->Html->Image('editin.png'), array('action' => 'edit', $new['News']['id']), array('escape' => false, 'alt' => 'Edit', 'title' => 'Edit'));
                                                    }
                                                    
                                                    
                                                    echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'delete', $new['News']['id']), array('escape' => false, 'alt' => 'Delete', 'title' => 'Delete'), __(Configure::read('delete_assoc_record'), $new['News']['id']));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $num++;
                                        }//end foreach
                                    } else {
                                        ?>
                                        <tr>
                                            <td align="center" colspan="7">No Record Found !!!</td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <?php //echo $this->element('pagination');  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


