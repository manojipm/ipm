<?php 	//echo $this->Html->script(array('ckeditor/ckeditor'));?>
<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/plans">Plans</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Plan</a>
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
                        <h3><i class="icon-th-list"></i> Plans - Edit Plan</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('Plan', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('Plan.id', array('label' => false,'type' => 'hidden', 'div' => false, 'class' => 'form-control')); ?>
                       <div class="control-group">
                            <label for="textfield" class="control-label">Plan Name  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('Plan.title', array('label' => false, 'div' => false,  'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Credits  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('Plan.credits', array('label' => false, 'id' => 'PlanCreditsID', 'div' => false, 'type'=>'text', 'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Amount(<?php echo CURRENCY; ?>)  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('Plan.amount', array('label' => false,'id' => 'PlanAmountID', 'div' => false, 'type'=>'text', 'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
						<?php 
						if(isset($this->data['Plan']['amount']) && !empty($this->data['Plan']['amount']) && isset($this->data['Plan']['credits']) && !empty($this->data['Plan']['credits'])){
							$division = ($this->data['Plan']['amount']/$this->data['Plan']['credits']);
							$division = number_format($division, 2).' '.CURRENCY.'/credit';
							$this->request->data['Plan']['division'] = $division;
						} ?>
						<div class="control-group">
                            <label for="textfield" class="control-label">Division</label>
                            <div class="controls">
                                <?php echo $this->Form->input('Plan.division', array('label' => false, 'id' => 'PlanDivisionID','div' => false,  'required' => true, 'readonly' => true,  'disabled' => true,  'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Discount(%)  <span>*</span></label>
                            <div class="controls">
                                <?php echo $this->Form->input('Plan.discount', array('label' => false, 'div' => false,  'required' => true, 'class' => 'input-xlarge')); ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Services  <span>*</span></label>
                            
								<div class="controls" id="planservices">
								 <?php if(isset($activities) && !empty($activities)){
										$i =0;
										$j =1;
										foreach($activities as $activity){
											$id = $activity['Activity']['id'];
											$credit_fee = $activity['PlansActivity']['credit_fee'];
											  ?>
													  
											<?php if($i%4 == 0){?>
											<div class="planservices row">
											<?php } ?>
											
												<div class="col-md-6">
													<label><?php echo ucfirst($activity['Activity']['title']); ?></label>
													<?php echo $this->Form->input('Activity.activity_id]['.$id, array('label' => false, 'div' => false,  'required' => true, 'value' => $credit_fee, 'class' => 'input-xlarge', 'id' => 'PlanActivity'.$id)); ?>
												</div>
											
											<?php if($j%4 == 0){ ?>
											</div>
											<?php } ?>
										  <?php $i++; $j++;

										  }
													}
									  ?>	
									</div>
                        </div>
                       
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls">
                               <?php
                                    echo $this->Form->checkbox('Plan.status', array(
                                            'value' => '1',
                                            'checked' => 'checked',
                                            'hiddenField' => false,
                                    )); 
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="window.location.href = '<?php echo SITEURL; ?>admin/plans'" class="btn">Cancel</button>
                        </div>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>