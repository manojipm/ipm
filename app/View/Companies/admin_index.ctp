<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Company</a>
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
                            Company - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                   	<th><?php echo $this->Paginator->sort('company_name',__("Name"));?></th>
                                    <th>SIC Code</th>
                                    <th>ORG Chart</th>
                                    <th>Location</th>
                                    <th>Phone</th>
                                    <th>Ownership</th>
                                    <th>Structure</th>
                                    <th>Industry Classification</th>
                                    <th>Revenue</th>
                                   	<th>Created on</th>
                                    <th>Status</th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($companies)) {
                                    $num = 1;
                                    foreach ($companies as $company) {
                                        ?>
                                        <tr>
											<td><?php echo $num ?></td>
											<td><?php echo $company['Company']['company_name'];?></td>
											<td> <?php echo $company['Company']['sic_code'];?></td>
											<td> <?php echo $company['Company']['org_chart'];?></td>
											
											<td> <?php echo $company['Company']['street'];?>
											 <?php echo $company['Company']['city_id'];?>
											<?php echo $company['Company']['state_id'];?>
											 <?php echo $company['Company']['country_id'];?>
											 <?php echo $company['Company']['zip'];?></td>
											
											<td> <?php echo $company['Company']['phone'];?></td>
											<td> <?php echo $company['Company']['ownership'];?></td>
											<td> <?php echo $company['Company']['structure_id'];?></td>
											<td> <?php echo $company['Company']['revenue'];?></td>
											<td> <?php echo $company['Company']['industry_classification_id'];?></td>
											<td> <?php echo $company['Company']['created'];?></td>
                                                  
                                            <td class="status">
                                            <?php
                                                $controller = $this->Html->url(array("controller" => "companies", "action" => "update_status", "admin" => true));
                                                if ($company['Company']['status'] == 1) {
                                                    echo $this->Html->image("active.png", array("id" => $company['Company']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$company['Company']['id']."', 'Company')"));
                                                } else {
                                                    echo $this->Html->image("inactive.png", array("id" => $company['Company']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $company['Company']['id'] . "', 'Company')"));
                                                }
                                            ?>
                                            </td>
                                            <td class="actions">
                                            <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'division_view', $company['Company']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'division_edit', $company['Company']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'division_delete', $company['Company']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $company['Company']['id']));

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