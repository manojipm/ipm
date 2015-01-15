<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Zone</a>
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
                            Zone - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th><?php echo $this->Paginator->sort('zone',__("Zone"));?></th>
                                    <th>Created on</th>
                                    <th><?php echo 'Status';?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($zones)) {
                                    $num = 1;
                                    foreach ($zones as $zone) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $zone['Zone']['zone'] ?></td>
                                            <td> <?php echo $zone['Zone']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "locations", "action" => "update_status", "admin" => true));
                                                    if ($zone['Zone']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $zone['Zone']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$zone['Zone']['id']."', 'Zone')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $zone['Zone']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $zone['Zone']['id'] . "', 'Zone')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'zone_view', $zone['Zone']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'zone_edit', $zone['Zone']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'zone_delete', $zone['Zone']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $zone['Zone']['id']));

                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $num++;
                                    }//end foreach
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5" style="color:RED;">No Data Found</td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            
                        </table>
                            
                        </div><?php //echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>














