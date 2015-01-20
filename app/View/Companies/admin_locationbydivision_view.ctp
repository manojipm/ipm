<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/companies/locationbydivision">Location By Division</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0);">View Location By Division</a>
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
                        <h3><i class="icon-th-list"></i> Location By Division - View Location By Division</h3>
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'locationbydivision'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('LocationDivision', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('LocationDivision.id', array('type' => 'hidden', )); ?>
                        
                          
                            <div class="control-group">
                                <label for="textfield" class="control-label">Company</label>
                                <div class="controls"><?php echo $ldivisions['Company']['company_name']; ?></div>
                            </div> 
                            <div class="control-group">
                                <label for="textfield" class="control-label">Division </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['division']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Location ID </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['location']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Type </label>
                                <div class="controls"><?php echo $ldivisions['LocationsByDivision']['division_type']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Street </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['street']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">City </label>
                                <div class="controls"><?php echo $ldivisions['City']['city']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">State </label>
                                <div class="controls"><?php echo $ldivisions['State']['state']; ?></div>
                            </div>
                            
                            <div class="control-group">
                                <label for="textfield" class="control-label">Zip </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['zip']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Country </label>
                                <div class="controls"><?php echo $ldivisions['Country']['country']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Phone </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['phone']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Census Tract  </label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['census_tract']; ?></div>
                            </div>
                            
  							<div class="control-group">
                                <label for="textfield" class="control-label">Created</label>
                                <div class="controls"><?php echo $ldivisions['LocationDivision']['created'];?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Status</label>
                                <div class="controls"><?php echo ($ldivisions['LocationDivision']['status'] == 0) ? 'Deactive' : 'Active'; ?></div>
                            </div>
                            			
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




