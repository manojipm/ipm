<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Reviews</a>
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
                            Reviews - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            
                            <div class="table-holder">
                            <table class="table table-hover table-nomargin dataTable table-bordered">
                                
                                <thead>
<!--                                    <tr>
                                        <td colspan="7">
                                           <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                    <span>From : </span>
                                    <input class="input-small datepick" type="text" aria-controls="DataTables_Table_0"> 
                                </label>
                            </div> 
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                    <span>To : </span>
                                    <input class="input-small datepick" type="text" id="to"> 
                                </label>
                            </div>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                     <?php echo $this->Form->month('Review.posted', array( 'empty' => 'By Months', 'label' => false, 'div' => false, 'class' => 'input-small select2-me')); ?>
                                </label>
                            </div>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                      <?php echo $this->Form->input('Review.posted', array('options' => $this->Common->getRoleLists(), 'empty' => 'Posted By', 'label' => false, 'div' => false, 'class' => 'input-small select2-me')); ?>
                                </label>
                            </div> 
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Posted By</th>
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
                                                <td><?php echo $slider['Review']['title'] ?></td>
                                                <td><?php echo $slider['Review']['description'] ?></td>
                                                <td><?php echo $this->Common->getUserName($slider['Review']['user_id']) ?></td>
                                                <td class="status"><?php
                                                    $controller = $this->Html->url(array("controller" => "reviews", "action" => "update_status", "admin" => true));
                                                    if ($slider['Review']['status'] == 1) {
                                                        echo $this->Html->image("active.png", array("id" => $slider['Review']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "','" . $slider['Review']['id'] . "')"));
                                                    } else {
                                                        echo $this->Html->image("inactive.png", array("id" => $slider['Review']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $slider['Review']['id'] . "')"));
                                                    }
                                                    ?>
                                                </td>

                                                <td> <?php echo $slider['Review']['created']; //$this->time->niceShort($slider['Review']['created']); ?>&nbsp;</td>
                                                <td class="actions">
                                                    <?php
                                                    echo $this->Html->link($this->Html->Image('view.png'), array('action' => 'view', $slider['Review']['id']), array('escape' => false, 'alt' => 'View', 'title' => 'View'));

                                                    //echo $this->Html->link($this->Html->Image('editin.png'), array('action' => 'edit', $slider['Review']['id']), array('escape' => false, 'alt' => 'Edit', 'title' => 'Edit'));

                                                    echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'delete', $slider['Review']['id']), array('escape' => false, 'alt' => 'Delete', 'title' => 'Delete'), __(Configure::read('delete_assoc_record'), $slider['Review']['id']));
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
