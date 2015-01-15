<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Category</a>
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
                            Category - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th><?php echo $this->Paginator->sort('category',__("Category"));?></th>
                                    <th>Created on</th>
                                    <th><?php echo 'Status';?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                
                                if (!empty($categories)) {
                                    $num = 1;
                                    foreach ($categories as $category) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $category['Projects_category']['category'] ?></td>
                                            <td> <?php echo $category['Projects_category']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "projects", "action" => "update_status", "admin" => true));
                                                    if ($category['Projects_category']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $category['Projects_category']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "', '".$category['Projects_category']['id']."', 'Projects_category')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $category['Projects_category']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $category['Projects_category']['id'] . "', 'Projects_category')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'category_view', $category['Projects_category']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'category_edit', $category['Projects_category']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'category_delete', $category['Projects_category']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $category['Projects_category']['id']));

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














