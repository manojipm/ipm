<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Commisions</a>
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
                        <h3><i class="icon-th-list"></i> Commisions - Edit Commisions</h3>
						<span class="commision_message">All amount fill in cents.</span>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Commision', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
						
						<?php if(isset($activities) && !empty($activities)){ 
								$commision_id = '';
								$commision = '';
								foreach($activities as $activity){
									$id = $activity['Activity']['id'];
									if(isset($activity['Commision']['id']))
									$commision_id = $activity['Commision']['id'];
									if(isset($activity['Commision']['commision'])){
										$commision = $activity['Commision']['commision'];
									}
									
						?>
						 <?php echo $this->Form->input('Commision.'.$id.'][commision_id]', array('label' => false, 'div' => false,  'type' => 'hidden', 'value' => $commision_id)); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label"><?php 
								if($id != GIFT_DELIVERY){
									echo ucfirst($activity['Activity']['title']); 
								}else{
									echo ucfirst($activity['Activity']['title']).'(%)'; 
								}
									?></label>
                            <div class="controls">
							
							<?php echo $this->Form->input('Commision.'.$id.'][commision]', array('label' => false, 'div' => false,  'required' => true, 'value' => $commision, 'data-zeros'=>"true" , 'class' => 'input-xlarge digits', 'maxlength'=>'5', 'id' => 'PlanActivity'.$id)); ?>
                            </div>
                        </div>
						<?php } ?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/commisions'" class="btn">Cancel</button>
                        </div>
						<?php }else{ ?>
						<div class="control-group">
                            <label for="textfield" class="control-label">&nbsp;</label>
                            <div class="controls">
                               Nothing to edit!!!
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