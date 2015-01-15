<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Structure</a>
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
                            Structure - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th><?php echo $this->Paginator->sort('structure',__("Structure"));?></th>
                                    <th>Created on</th>
                                    <th><?php echo 'Status';?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($structures)) {
                                    $num = 1;
                                    foreach ($structures as $structure) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $structure['Company_structures']['structure'] ?></td>
                                            <td> <?php echo $structure['Company_structures']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "companies", "action" => "update_status", "admin" => true));
                                                    if ($structure['Company_structures']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $structure['Company_structures']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$structure['Company_structures']['id']."', 'Company_structures')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $structure['Company_structures']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $structure['Company_structures']['id'] . "', 'Company_structures')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'structure_view', $structure['Company_structures']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'structure_edit', $structure['Company_structures']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'structure_delete', $structure['Company_structures']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $structure['Company_structures']['id']));

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














