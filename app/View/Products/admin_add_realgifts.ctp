<?php 
	$category_id = '';
	if(isset($this->data['Product']['category_id'])){
		$category_id = $this->data['Product']['category_id'];
?>
<div id="main">
<?php } ?>
<div class="box-title">
    <h3><i class="icon-th-list"></i> Add Real Gift</h3>
</div>
<div class="box-content nopadding">
    <?php echo $this->Form->create('Product', array('action' => 'admin_add_realgifts','type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="control-group">
        <label for="textfield" class="control-label"> Name on Tool Tip <span>*</span></label>
        <div class="controls">
            <?php
            echo $this->Form->input('Product.type', array('label' => false,'value' => 'real','type' => 'hidden', 'div' => false,'class' => 'input-xlarge'));
            echo $this->Form->input('Product.name', array('label' => false, 'div' => false,'class' => 'input-xlarge'));
            ?>
        </div>
    </div>
	
	<div class="control-group">
		<label for="textfield" class="control-label">Category <span>*</span></label>
		<div class="controls">
			<?php echo $this->Form->input('Product.category_id', array('options' => $categories, 'default'=>$category_id, 'empty' => 'Select Category', 'label' => false, 'div' => false, 'class' => 'input-xlarge select2-me','required' => true)); ?>
		</div>
	</div>
	
	<div class="control-group">
        <label for="textfield" class="control-label">Quantity <span>*</span></label>
        <div class="controls">
            <?php
            echo $this->Form->input('Product.quantity', array("min"=>"0",  "step"=>"1",'label' => false, 'div' => false,'class' => 'input-xlarge'));
            ?>
        </div>
    </div>
	
	<div class="control-group">
        <label for="textfield" class="control-label">Amount($)  <span>*</span></label>
        <div class="controls">
            <?php
            echo $this->Form->input('Product.amount', array("min"=>"0", "step"=>"1",'label' => false, 'div' => false,'class' => 'input-xlarge'));
            ?>
        </div>
    </div>
	
	<div class="control-group">
        <label for="textfield" class="control-label">Credits</label>
        <div class="controls">
            <?php
            echo $this->Form->input('Product.credits', array("min"=>"0", "step"=>"1",'label' => false, 'div' => false,'class' => 'input-xlarge'));
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
        <button type="button" onclick="if($('#cboxLoadedContent').length > 0){ $.colorbox.close();}else{ window.location.href='<?php echo SITEURL; ?>admin/products#real' }" class="btn">Cancel</button>
    </div>

</form>
</div>
</div>