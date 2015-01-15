<?php
$controller = $this->params['controller'];
$action = $this->params['action'];
$inbox = '';
$sent = '';
$trash = '';
if ($controller == 'messages' && ($action == 'admin_index'  || (isset($read) && $read == 'inbox') )) {
    $inbox = ' active';
}
if ($controller == 'messages' && ($action == 'admin_sentbox' || (isset($read) && $read == 'sent' ))) {
    $sent = ' active';
}
if ($controller == 'messages' && ($action == 'admin_trashbox'  || (isset($read) && $read == 'trash' ))) {
    $trash = ' active';
}
?>
<li class='write hidden-480'>
<!--    <a href="#">Write message</a>-->
<?php echo $this->Html->link('Write Message',array('action'=>'send'));?>
<!--    <a class='write_message' href="#write_message">Write message</a>-->
</li>
<li class='<?php echo $inbox;?>'>
    <a href="<?php echo SITEURL;?>admin/messages">
        <i class="icon-inbox"></i> 
        Inbox <strong id="inboxCount"><?php echo ($this->Common->getUnread($this->Session->read('Auth.Admin.id')) == 0 ) ? '' : '('.$this->Common->getUnread($this->Session->read('Auth.Admin.id')).')';?></strong>
    </a>
</li>
<li class='<?php echo $sent;?>' >
    <a href="<?php echo SITEURL;?>admin/messages/sentbox" ><i class="icon-share-alt"></i> Sent items</a>
</li>
<li class='<?php echo $trash;?>'>
    <a href="<?php echo SITEURL;?>admin/messages/trashbox" ><i class="icon-trash"></i> Trash</a>
</li>
<!--<li>
    <a href="#draft" data-toggle="tab"><i class="icon-share-alt"></i> Draft</a>
</li>-->
<script>
    jQuery(document).ready(function () {
        $(".write_message").colorbox({inline:true, width:"50%"});
    });
</script>