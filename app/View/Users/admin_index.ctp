<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">Users</a>
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
                            Users - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding" >
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <div class="table-holder">
                                <table id="DataTables_Table_0" class="table table-hover table-nomargin dataTable table-bordered" >
                                    <thead>
                                       <tr>
                                            <td colspan="8">
                                                <?php echo $this->Form->create('User'); ?>
                                                <?php
                                                $man = '';
                                                if (isset($role_ids['User'][0]['role_id']) && $role_ids['User'][0]['role_id'] == 3) $man = 'checked="checked"';
                                                ?>
                                                <?php
                                                $woman = '';
                                                if (isset($role_ids['User'][1]['role_id']) && $role_ids['User'][1]['role_id'] == 4) $woman = 'checked="checked"';
                                                ?>
                                                <?php
                                                $agency = '';
                                                if (isset($role_ids['User'][2]['role_id']) && $role_ids['User'][2]['role_id'] == 2) $agency = 'checked="checked"';
                                                ?>
												<div class="filter">
                                                <span style="width: 70px; float: left;"> Filter By :</span> 
                                                        <div id="ckbx-1">
                                                            <input type="checkbox" <?php echo $man;?> name="data[User][0][role_id]"  class='filtering' id="man" value="3" /><span class="filter-span" style="width: 50px; float: left;">Man</span>
                                                        </div>
                                                        <div id="ckbx-2">
                                                            <input type="checkbox" <?php echo $woman;?> name="data[User][1][role_id]"  class='filtering' id="woman" value="4" ><span class="filter-span" style="width: 60px; float: left;">Woman</span> 
                                                        </div>
                                                        <div id="ckbx-3">
                                                            <input type="checkbox" <?php echo $agency;?> name="data[User][2][role_id]" class='filtering' id="agency" value="2" ><span class="filter-span" style="width: 60px; float: left;">Agency</span>  
                                                        </div>
                                                        <div id="ckbx-4">
                                                            <input type="submit" class="btn btn-primary" name="submit" class='' id="" value="Filter" style="margin-left: 25px;" >
                                                        </div>
                                                 </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Joined In Date</th>
                                            <th>Contact#</th>
                                            <th>Email Id</th>
                                            <th>Status</th>
                                            <th class="actions">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="midd-ajax">
                                        <?php
                                        if (!empty($users)) {
                                            $num = 1;
                                            foreach ($users as $user) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $num ?></td>
                                                    <td><?php echo $user['UserProfile']['first_name'].' '.$user['UserProfile']['last_name']; ?></td>
                                                    <td><?php echo $this->Common->getRoles($user['User']['role_id']); ?></td>
                                                    <td> <?php echo $user['User']['created']; ?>&nbsp;</td>
													<td><?php echo $user['UserProfile']['phone'] ?></td>
                                                    <td><?php echo $user['User']['email']; ?></td>
                                                    <td class="status"><?php
                                                        $controller = $this->Html->url(array("controller" => "users", "action" => "update_status", "admin" => true));
                                                        if ($user['User']['status'] == 1) {
                                                            echo $this->Html->image("active.png", array("id" => $user['User']['id'], "title" => "Active", "class" => "act", "escape" => false, "onClick" => "active('" . $controller . "','" . $user['User']['id'] . "')"));
                                                        } else {
                                                            echo $this->Html->image("inactive.png", array("id" => $user['User']['id'], "title" => "InActive", "escape" => false, "class" => "act", "onClick" => "active('" . $controller . "','" . $user['User']['id'] . "')"));
                                                        }
                                                        ?></td>
                                                    
                                                    <td class="actions">
                                                        <?php
                                                        echo $this->Html->link($this->Html->Image('changepass.png'), array('action' => 'admin_reset_password', $user['User']['id']), array('escape' => false, 'alt' => 'Change Password', 'title' => 'Change Password'));
                                                        echo $this->Html->link($this->Html->Image('view.png'), array('action' => 'view', 'type' => $user['User']['role_id'], $user['User']['id']), array('escape' => false, 'alt' => 'View', 'title' => 'View'));
                                                        echo $this->Html->link($this->Html->Image('editin.png'), array('action' => 'edit', 'type' => $user['User']['role_id'], $user['User']['id']), array('escape' => false, 'alt' => 'Edit', 'title' => 'Edit'));
                                                        echo $this->Form->postLink($this->Html->Image('delete.png'), array('action' => 'delete', $user['User']['id']), array('escape' => false, 'alt' => 'Delete', 'title' => 'Delete'), __(Configure::read('delete_assoc_record'), $user['User']['id']));
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $num++;
                                            }//end foreach
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No Data Found</td>

                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>


                                </table>
                                <?php //echo $this->element('pagination');  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!isset($role_ids['User'])) {
    ?>
    <script>
        $('.filtering').attr('checked','checked');
    </script>
    <?php
}
?>


<script>
    $(document).ready(function () {
        $("#DataTables_Table_0").dataTable( {
            //"bPaginate": false,
            "bFilter": true,
            //"bInfo": false,
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 6,7 ] }
              ] ,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bLengthChange": true,
            "bProcessing": true,
            "bJQueryUI": true
        });
        
    });
</script>








