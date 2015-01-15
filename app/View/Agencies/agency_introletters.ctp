 <div class="row">
		<div class="col-sm-12">
		  	<div class=" panel panel-primary noborder no-box-shadow">
							<div class="panel-heading">
								<h3  class="panel-title pull-left">Intro Letters</h3>
								<div class="pull-right">
									<a href="<?php echo SITEURL; ?>agency" class="btn btn-warning btn-xs" >Back to Profile </a>
								</div>
							</div>
							
							<div class="panel-body nopadding table-acroller">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<tbody>
									<?php 
									if(isset($womens) && !empty($womens)){
										foreach($womens as $val){
											if(isset($val['Introletter']['description']) && !empty($val['Introletter']['description'])){
												$unique_id = '';
												$age = '0';
												$name = '';
												if(isset($val['UserProfile']['first_name'])){
													$name = $val['UserProfile']['first_name'];
												}	
												
												if(isset($val['UserProfile']['unique_id'])){
													$unique_id = $val['UserProfile']['unique_id'];
												}	
												
												if(isset($val['UserProfile']['age'])){
													$age = $this->Common->birthday($val['UserProfile']['age']);
												}	
												
												if(isset($val['User']['id'])){
													$key = $val['User']['id'];
												}											
												if(isset($val['UserProfile']['last_name']) && !empty($val['UserProfile']['last_name'])){
													$name .= ' '.$val['UserProfile']['last_name'];
												}						
										?>
										<tr>
											<td class='hidden-240 introletter'>
												<?php
													$image_name = $this->Common->profilePic($val['User']['id']);
													if (isset($image_name) && $image_name != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $image_name)) { ?>	
														<div class="catepic">
															<?php
															echo $this->Html->Image('../uploads/user_images/' . $image_name, array('height' => 50, 'width' => 80));
															?>
														</div>
													<?php
													} 
													?>
													<span><b><?php echo $name; ?></b></span>
													<span>Age: <?php echo $age; ?> Years</span>
													<span>ID: <?php echo $unique_id; ?></span>
											</td>
											<td class='hidden-180' align="center">
												<a href="<?php echo SITEURL; ?>agency/introdetails/<?php echo $val['Introletter']['id']; ?>">
												<?php 
													if(isset($val['Introletter']['title'])){
														echo $val['Introletter']['title'];
													}else{
														echo '-';
													}
												?>
												</a>
											</td>
											<td class='hidden-650'>
												<?php 
													if(isset($val['Introletter']['description'])){
														if(strlen($val['Introletter']['description']) > 450){
															echo substr($val['Introletter']['description'],0,450).'...';
														}else{
															echo $val['Introletter']['description'];
														}
													}else{
														echo '-';
													}
												?>
											</td>
											<td align="center" class='hidden-135'>
												<?php if(isset($val['Introletter']['status']) && !empty($val['Introletter']['status'])){ ?>
													<a href="javascript:void()" onclick="if(confirm('Are you sure, you would like to disconnect this introletter with profile?')){ window.location.href='<?php echo SITEURL; ?>agency/disconnecttoprofile/<?php echo $val['Introletter']['id']; ?>' }">
													Disconnect Profile
													</a>
												<?php }else{ ?>
													<a href="javascript:void()" onclick="if(confirm('Are you sure, you would like to connect this introletter with profile?')){ window.location.href='<?php echo SITEURL; ?>agency/connecttoprofile/<?php echo $val['Introletter']['id']; ?>' }">
													Connect to Profile
												</a>
												<?php } ?>
												</td>
											
										</tr>
									<?php
											} 
										}
									}else{ ?>
										<tr>
											<td align="center" colspan="4"> No records founds !!!</td>
										</tr>
									<?php }	?>
									</tbody>
								</table>
							</div>
						</div>
					
	  </div>
	</div>
<div id="disbaleEntirePage"></div>

<script>
$('#deleteGirls').on('click', function(){
	if($(".green_auto:checked").length > 0 ){
		if(confirm('Are you sure you would like to delete this girl(s)?')){
			$('#disbaleEntirePage').trigger('click');
			checkedVal = '';
			 $(".green_auto:checked").each(function () {
				sThisVal = (this.checked ? $(this).val() : "");
				if(sThisVal != ''){ 
					checkedVal += ','+sThisVal;
				}
					
			 });
			checkedVal = checkedVal.substring(1, checkedVal.length);
			console.log(checkedVal);
			if(checkedVal != ''){
				$.ajax({
					type: "POST",
					data: "timestamp="+Math.random()+'&checkedVal='+checkedVal,
					url: siteurl +"agency/agencies/delete_girls",
					success : function(response){ 
						if($.trim(response) == 'success'){  
							location.reload();							
						}else{
							alert('There seems to be problem. Please try again later.');
							return false;
						}
					}
				});
			}
		}
	}else{
		// Please select atleast one product
		alert('Please select atleast ONE product');
		return false;
	}
	
	
});

$('#blockedGirls').on('click', function(){
	if($(".green_auto:checked").length > 0 ){
		if(confirm('Are you sure you would like to block this girl(s)?')){
			$('#disbaleEntirePage').trigger('click');
			checkedVal = '';
			 $(".green_auto:checked").each(function () {
				sThisVal = (this.checked ? $(this).val() : "");
				if(sThisVal != ''){ 
					checkedVal += ','+sThisVal;
				}
					
			 });
			checkedVal = checkedVal.substring(1, checkedVal.length);
			console.log(checkedVal);
			if(checkedVal != ''){
				$.ajax({
					type: "POST",
					data: "timestamp="+Math.random()+'&checkedVal='+checkedVal,
					url: siteurl +"agency/agencies/block_girls",
					success : function(response){ 
						if($.trim(response) == 'success'){  
							location.reload();							
						}else{
							alert('There seems to be problem. Please try again later.');
							return false;
						}
					}
				});
			}
		}
	}else{
		// Please select atleast one product
		alert('Please select atleast ONE product');
		return false;
	}
	
	
});
</script>
