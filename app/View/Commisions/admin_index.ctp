<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Commisions</a>
                </li>
            </ul>
            <!--<div class="close-bread">
                    <a href="#"><i class="icon-remove"></i></a>
            </div>-->
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered commisions">
                    <div class="box-title">
                        <h3><i class="icon-th-list"></i> Commisions - Commission to Agencies </h3>
						<a href="<?php echo SITEURL; ?>admin/commisions/edit" ><img class="editicon" src="<?php echo SITEURL; ?>img/edit.png" alt="edit" title="Edit Commisions" /></a>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Commision', array('type' => 'file', 'class' => 'form-horizontal form-bordered ')); ?>
						
						<?php if(isset($activities) && !empty($activities)){ 
								$commision_id = '';
								$commision = '';
								foreach($activities as $activity){
									$id = $activity['Activity']['id'];
									if(isset($activity['Commision']['id']))
									$commision_id = $activity['Commision']['id'];
									if(isset($activity['Commision']['commision'])){
										$commision = $activity['Commision']['commision'];
										if($id != GIFT_DELIVERY){ // Calcuation not for gift delivery case.
											if($commision >= 100){
												$commision = '$'.number_format(($commision/100),2);
											}else{
												$commision = $commision.' cents';
											}
										}else{
											$commision = $commision.'% of Actual Price';
										}
									}
						?>
						<div class="control-group">
                            <label for="textfield" class="control-label"><?php echo ucfirst($activity['Activity']['title']); ?></label>
                            <div class="controls">
                               <?php echo $commision; ?>
                            </div>
                        </div>
						<?php } ?>
                        
						<?php }else{ ?>
						<div class="control-group">
                            <label for="textfield" class="control-label">&nbsp;</label>
                            <div class="controls">
                               No records founds!!!
                            </div>
                        </div>
						<?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>