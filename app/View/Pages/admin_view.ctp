<div id="main">
	<div class="container-fluid">
		<div class="breadcrumbs">
			<ul>
				<li>
					<a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
					<i class="icon-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo SITEURL; ?>admin/pages">Page</a>
					<i class="icon-angle-right"></i>
				</li>
				<li>
					<a href="#">View Page</a>
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
						<h3><i class="icon-th-list"></i> Pages - View Page</h3>
                                                <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                                                    <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                                                </h3>
					</div>
					<div class="box-content nopadding">
					<?php echo $this->Form->create('User', array('type' => 'file', 'class'=>'form-horizontal form-bordered')); ?>
						<div class="control-group">
								<label for="textfield" class="control-label">Page Name</label>
								<div class="controls">
									<?php echo $page['Page']['name'];?>
								</div>
							</div>
							<div class="control-group">
								<label for="textfield" class="control-label">Title</label>
								<div class="controls">
									<?php echo $page['Page']['meta_title'];?>
								</div>
							</div>
							
							<div class="control-group">
								<label for="textfield" class="control-label">Meta Keywords</label>
								<div class="controls">
									<?php echo $page['Page']['meta_keywords'];?>
								</div>
							</div>
							
							<div class="control-group">
								<label for="textfield" class="control-label">Meta Description</label>
								<div class="controls">
									<?php echo $page['Page']['meta_description'];?>
								</div>
							</div>
							
							<div class="control-group">
								<label for="textfield" class="control-label">Page Content</label>
								<div class="controls">
									 <?php echo $page['Page']['content'];?>
								</div>
							</div>
												
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>