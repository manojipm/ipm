<div id='inline_content' style='padding:10px; background:#fff; height:90%'>
<div class="box-title">
    <h3><i class="icon-th-list"></i> 
	Listen Love Melody 
	<?php if(isset($this->request->data['Product']['name']) && !empty($this->request->data['Product']['name'])){ ?>
		<?php echo '- '.$this->request->data['Product']['name']; ?>
	<?php } ?>
	</h3>
</div>
<div class="box-content">
	<div class="control-group" style="text-align:center;padding: 25px; ">
	<?php if(isset($this->request->data['Product']['image_file']) && !empty($this->request->data['Product']['image_file'])){ ?>
    <audio controls>
	  <source src="http://192.168.4.32/dating-cakephp/uploads/products/love/<?php echo $this->request->data['Product']['image_file']; ?>" type="audio/mpeg">
	</audio> 
	<?php }else{ ?>
		<span>No Melody Found!!!</span>
	<?php } ?>
	</div>
</div>
</div>


