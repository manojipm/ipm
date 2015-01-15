<?php if(isset($errors) && !empty($errors)){ ?>
	<div id="main" >
<?php } ?>
<div id='inline_content' style='padding:10px; background:#fff;'>
	<div class="box-title">
		<h3><i class="icon-th-list"></i> Edit Romance Card</h3>
	</div>
	<div class="box-content nopadding">
		<?php echo $this->Form->create('Product', array('action' => 'admin_edit_romance','type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
		<div class="control-group">
			<label for="textfield" class="control-label"> Name on Tool Tip <span>*</span></label>
			<div class="controls">
				<?php
				echo $this->Form->input('Product.type', array('label' => false,'type' => 'hidden', 'div' => false,'class' => 'input-xlarge'));
				echo $this->Form->input('Product.id', array('label' => false,'type' => 'hidden', 'div' => false,'class' => 'input-xlarge'));
				echo $this->Form->input('Product.name', array('label' => false, 'div' => false,'class' => 'input-xlarge'));
				?>
			</div>
		</div>

		<div class="control-group">
			<label for="textfield" class="control-label">Upload Image </label>
			<div class="controls">
				<?php echo $this->Form->input('Product.image_file', array('type' => 'file', 'label' => false, 'div' => false, 'class' => 'input-xlarge')); 
				if(empty($errors)){
				?>
				<img src="<?php echo SITEURL. ROMANCEPRODUCT_THUMB_FILE_PATH; ?><?php echo '/'.$this->data['Product']['image_file']; ?>" width="90" height="65" alt="">
				<?php } ?>
			</div>
		</div>
		
		<div class="control-group">
			<label for="textfield" class="control-label">Status</label>
			<div class="controls">
			   <?php
				echo $this->Form->checkbox('Product.status', array(
						'hiddenField' => false,
				)); ?>
			</div>
		</div>
		
							
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Update</button>
			<button type="button" onclick="if($('#cboxLoadedContent').length > 0){ $.colorbox.close();}else{ window.location.href='<?php echo SITEURL; ?>admin/products#romance' }" class="btn">Cancel</button>
		</div>

	</form>
	</div>
</div>


