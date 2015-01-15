<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Division</a>
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
                            Division - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th><?php echo $this->Paginator->sort('division',__("Division"));?></th>
                                    <th>Created on</th>
                                    <th><?php echo 'Status';?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($divisions)) {
                                    $num = 1;
                                    foreach ($divisions as $division) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $division['Locations_by_division']['division_type'] ?></td>
                                            <td> <?php echo $division['Locations_by_division']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "companies", "action" => "update_status", "admin" => true));
                                                    if ($division['Locations_by_division']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $division['Locations_by_division']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$division['Locations_by_division']['id']."', 'Locations_by_division')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $division['Locations_by_division']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $division['Locations_by_division']['id'] . "', 'Locations_by_division')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'division_view', $division['Locations_by_division']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'division_edit', $division['Locations_by_division']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'division_delete', $division['Locations_by_division']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $division['Locations_by_division']['id']));

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