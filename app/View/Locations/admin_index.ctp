<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Testimonials</a>
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
                            Testimonials - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>S.No.<?php //echo $this->Paginator->sort('id',__("S.No."));?></th>
                                    <th>Title<?php //echo $this->Paginator->sort('title',__("Title"));?></th>
                                    <th>Description<?php //echo $this->Paginator->sort('description',__("Description"));?></th>
                                    <th>Created on<?php //echo $this->Paginator->sort('created',__("Created on"));?></th>
                                    <th><?php echo 'Status';?></th>
                                    
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if (!empty($testimonials)) {
                                    $num = 1;
                                    foreach ($testimonials as $testimonial) {
                                        ?>
                                        <tr>
                                            <td><?php echo $num ?></td>
                                            <td><?php echo $testimonial['Testimonial']['title'] ?></td>
                                            <td>
                                                <?php 
                                                    echo $this->Text->truncate($testimonial['Testimonial']['description'],  70,  array('ellipsis' => '...',  'exact' => false));
                                                ?>
                                            </td>
                                            <td> <?php echo $testimonial['Testimonial']['created']; ?>&nbsp;</td>
                                            <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "testimonials", "action" => "update_status", "admin" => true));
                                                    if ($testimonial['Testimonial']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $testimonial['Testimonial']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "','" . $testimonial['Testimonial']['id'] . "')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $testimonial['Testimonial']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $testimonial['Testimonial']['id'] . "')"));
                                                    }
                                                    ?>
                                            </td>
                                            <td class="actions">
                                                <?php
                                                //echo $this->Html->link($this->Html->Image('changepass.png'),array('action' => 'admin_reset_password', $testimonial['User']['id']),array('escape'=>false,'alt' => 'Change Password','title' => 'Change Password'));
                                                echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'view', $testimonial['Testimonial']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
                                                echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'edit', $testimonial['Testimonial']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
                                                echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'delete', $testimonial['Testimonial']['id']),array('escape'=>false,'alt' => 'Delete','title' => 'Delete'), __(Configure::read('delete_assoc_record'), $testimonial['Testimonial']['id']));

                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $num++;
                                    }//end foreach
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">No Data Found</td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            
                        </table>
                            
                        </div><?php echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>














