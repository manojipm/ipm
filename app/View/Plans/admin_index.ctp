<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Plans</a>
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
                            Plans - Listing
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
                                        <th>Created on</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($sliders)) {
                                        $num = 1;
                                        foreach ($sliders as $slider) {
                                            ?>
                                            <tr>
                                                <td><?php echo $num ?></td>
                                                <td><?php echo $slider['Plan']['title'] ?></td>
                                                <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "plans", "action" => "update_status", "admin" => true));
                                                    if ($slider['Plan']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $slider['Plan']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "','" . $slider['Plan']['id'] . "')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $slider['Plan']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $slider['Plan']['id'] . "')"));
                                                    }
                                                    ?></td>

                                                <td> <?php echo $slider['Plan']['created']; ?>&nbsp;</td>
                                                <td class="actions">
                                                    <?php
                                                    echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'view', $slider['Plan']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));

                                                    echo $this->Html->link($this->Html->Image('editin.png'), array('action' => 'edit', $slider['Plan']['id']), array('escape' => false, 'alt' => 'Edit', 'title' => 'Edit'));

                                                    echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'delete', $slider['Plan']['id']), array('escape' => false, 'alt' => 'Delete', 'title' => 'Delete'), __(Configure::read('delete_assoc_record'), $slider['Plan']['id']));
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



