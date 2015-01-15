<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/penalty">Penalties</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">View Penalty</a>
                </li>
            </ul>
            <!--<div class="close-bread">
                    <a href="#"><i class="icon-remove"></i></a>
            </div>-->
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="icon-th-list"></i> Penalties - View Penalty</h3>
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Agency Name</label>
                            <div class="controls">
                                <?php echo $this->Common->getUserName($penalty['Penalty']['agency_id']); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Girl's Nickname</label>
                            <div class="controls">
                                <?php echo $this->Common->getGirlNickname($penalty['Penalty']['user_id']); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Penalty Reason</label>
                            <div class="controls">
                                <?php echo $penalty['Penalty']['reason']; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Penalty Summary</label>
                            <div class="controls">
                                <?php echo $penalty['Penalty']['summary']; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Penalty Amount</label>
                            <div class="controls">
                                <?php echo CURRENCY .$penalty['Penalty']['amount']; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Attachment</label>
                            <div class="controls">
                          
                                
                                <?php 
                                if(isset($penalty['Penalty']['attachment']) && !is_array($penalty['Penalty']['attachment'])){
                                    if (isset($penalty['Penalty']['attachment']) && !empty($penalty['Penalty']['attachment']) && $penalty['Penalty']['attachment'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'penalty_attachments' . DS . $penalty['Penalty']['attachment'])) { 	
                                        echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ;
                                        echo $this->Html->link('penalty Attachment :' . $penalty['Penalty']['attachment'], array('controller' => 'penalty',
                                            'action' => 'downloadfile',
                                            $penalty['Penalty']['attachment'],
                                            'penalty_attachments'
                                                )
                                        );
                                    }
                                }
                                ?>   

                            </div>
                        </div>
                        

<!--                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls"><?php echo ($penalty['Penalty']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
                        </div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>