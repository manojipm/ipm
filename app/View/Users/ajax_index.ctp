<?php
if (!empty($users)) {
    $num = 1;
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <td><?php echo $user['UserProfile']['first_name'] . ' ' . $user['UserProfile']['last_name']; ?></td>
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