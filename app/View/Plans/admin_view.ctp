<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/plans">Plan</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">View Plan</a>
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
                        <h3><i class="icon-th-list"></i> Plans - View Plan</h3>
						<h3 style="float: right; margin-right: 10px; font-size: 13px;">
							<?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
						</h3>
                    </div>
                    <div class="box-content nopadding" id="viewPlan">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Plan Title</label>
                            <div class="controls">
                                <?php echo $plans['Plan']['title']; ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Amount</label>
                            <div class="controls">
                                <?php echo CURRENCY.''.$plans['Plan']['amount']; ?>
                            </div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Credits</label>
                            <div class="controls">
                                <?php echo $plans['Plan']['credits']; ?>
                            </div>
                        </div>
						
						
						<?php 
						if(isset($plans['Plan']['amount']) && !empty($plans['Plan']['amount']) && isset($plans['Plan']['credits']) && !empty($plans['Plan']['credits'])){
							$division = ($plans['Plan']['amount']/$plans['Plan']['credits']);
							$division = number_format($division, 2).' '.CURRENCY.'/credit';
						} ?>
						
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Division</label>
                            <div class="controls">
                                <?php echo $division; ?>
                            </div>
                        </div>

						<div class="control-group">
                            <label for="textfield" class="control-label">Discount</label>
                            <div class="controls">
                                <?php echo $plans['Plan']['discount'].'%'; ?>
                            </div>
                        </div>
						
                      
                        <div class="control-group">
                            <label for="textfield" class="control-label">Status</label>
                            <div class="controls"><?php echo ($plans['Plan']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
                        </div>
						
						<div class="control-group">
                            <label for="textfield" class="control-label">Services</label>
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
										<label class="plan_view"><?php echo ucfirst($activity['Activity']['title']); ?></label>
										<span  class="plan_viewcr"><?php echo $credit_fee; ?></span>
									</div>
							
							<?php if($j%4 == 0){ ?>
								</div>
							<?php } ?>
							<?php $i++; $j++;
								}
							}
							?>	
							</div>
							<div class="col-md-6">&nbsp;</div>
						</div>
						
						<div class="control-group" style="display:none;">
                            <label for="textfield" class="control-label">Services</label>
                            <div class="controls">
                               
								<div class="row">
									<div class="col-md-6">
									  <table class="table" style="width:auto;">
										<tbody>
										  <?php if(isset($activities) && !empty($activities)){
												foreach($activities as $activity){
													$id = $activity['Activity']['id'];
													$credit_fee = $activity['PlansActivity']['credit_fee'];
										  ?>
												<tr>
													<td><?php echo ucfirst($activity['Activity']['title']); ?></td>
													<td><?php echo $credit_fee; ?></td>
												</tr>
										  <?php }
											}
										  ?>
										</tbody>
									  </table>
									</div>
									<div class="col-md-6">&nbsp;</div>
								  </div>
                            </div>
                        </div>
						
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>