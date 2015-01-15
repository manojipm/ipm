<?php if(isset($this->data['Product'])){ ?>
<div id="main">
<?php } ?>
<div class="box-title">
    <h3><i class="icon-th-list"></i> Add Virtual Gift</h3>
</div>
<div class="box-content nopadding">
    <?php echo $this->Form->create('Product', array('action' => 'admin_add_virtual_gifts','type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="control-group">
        <label for="textfield" class="control-label"> Name on Tool Tip <span>*</span></label>
        <div class="controls">
            <?php
            echo $this->Form->input('Product.type', array('label' => false,'value' => 'virtual','type' => 'hidden', 'div' => false,'class' => 'input-xlarge'));
            echo $this->Form->input('Product.name', array('label' => false, 'div' => false,'class' => 'input-xlarge'));
            ?>
        </div>
    </div>

    <div class="control-group">
        <label for="textfield" class="control-label">Upload Image <span>*</span></label>
        <div class="controls">
            <?php echo $this->Form->input('Product.image_file', array('type' => 'file', 'required' => true,'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
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
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" onclick="if($('#cboxLoadedContent').length > 0){ $.colorbox.close();}else{ window.location.href='<?php echo SITEURL; ?>admin/products#virtual' }" class="btn">Cancel</button>
    </div>

</form>
</div>


