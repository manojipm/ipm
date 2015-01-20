<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Location By Division</a>
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
                                    <th><?php echo $this->Paginator->sort('company',__("Company"));?></th>
                                    <th><?php echo $this->Paginator->sort('division',__("Division"));?></th>
                                    <th><?php echo $this->Paginator->sort('location',__("Location ID"));?></th>
                                    <th><?php echo $this->Paginator->sort('type',__("Type"));?></th>
                                    <th><?php echo $this->Paginator->sort('address',__("Address"));?></th>
                                    <th><?php echo $this->Paginator->sort('phone',__("Phone"));?></th>
                                    <th><?php echo $this->Paginator->sort('census',__("Census Tract"));?></th>
                                    <th>Created on</th>
                                    <th><?php echo 'Status';?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($ldivisions)) {
                                    $num = 1;
                                    foreach ($ldivisions as $ldivision) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $ldivision['Company']['company_name'] ?></td>
                                            <td><?php echo $ldivision['LocationDivision']['division'] ?></td>
                                            <td><?php echo $ldivision['LocationDivision']['location'] ?></td>
                                            <td><?php echo $ldivision['LocationsByDivision']['division_type'] ?></td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>Street</td> <td><?php echo $ldivision['LocationDivision']['street'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td> <td><?php echo $ldivision['City']['city'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td> <td><?php echo $ldivision['State']['state'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zip</td> <td><?php echo $ldivision['LocationDivision']['zip'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Country</td> <td><?php echo $ldivision['Country']['country'] ?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </td>
                                            <td><?php echo $ldivision['LocationDivision']['phone'] ?></td>
                                            <td><?php echo $ldivision['LocationDivision']['census_tract'] ?></td>
                                            <td> <?php echo $ldivision['LocationDivision']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "companies", "action" => "update_status", "admin" => true));
                                                    if ($ldivision['LocationDivision']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $ldivision['LocationDivision']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$ldivision['LocationDivision']['id']."', 'LocationDivision')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $ldivision['LocationDivision']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $ldivision['LocationDivision']['id'] . "', 'LocationDivision')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'locationbydivision_view', $ldivision['LocationDivision']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'locationbydivision_edit', $ldivision['LocationDivision']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'locationbydivision_delete', $ldivision['LocationDivision']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $ldivision['LocationDivision']['id']));

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