 <div class="row">
		<div class="col-sm-12">
		  	<div class=" panel panel-primary noborder no-box-shadow">
							<div class="panel-heading">
								<h3  class="panel-title pull-left">Girl Listing </h3>
								<div class="pull-right">
									<a href="<?php echo SITEURL; ?>agency/introletters"  class="btn btn-success btn-xs">Intro-Letters </a>
									<a href="javascript:void(0)" id="deleteGirls" class="btn btn-danger btn-xs">Delete </a>
									<a href="javascript:void(0)" id="blockedGirls" class="btn btn-warning btn-xs">Block </a>
									<a href="<?php echo SITEURL; ?>profileadd" class="btn btn-success btn-xs" >Add Profile </a>
								</div>
							</div>
							
							<div class="panel-body nopadding table-acroller">
								<table class="table table-hover table-nomargin dataTable table-bordered">
									<thead>
										<tr class="info">
											<th>
												<input type="checkbox" name="green_check" id="green_check" class="css-checkbox green_check"  />
												<label for="green_check" class="css-label"></label>
											</th>
											<th>Name</th>
											<th  class='hidden-250'>Profile Picture</th>
											<th class='hidden-350'>Id</th>
											<th class='hidden-1024'>Nick Name</th>
											<th class='hidden-480'>Age</th>
											<th class='hidden-480'>Country</th>
											<th class='hidden-480'>City</th>
											<th class='hidden-480'>Email</th>
											<th class='hidden-480'>Phone</th>
											<th class='hidden-480'>Status</th>
											<th class='hidden-480'>Added On</th>
											<th class='hidden-480'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(isset($womens) && !empty($womens)){
											foreach($womens as $val){
											$name = '';
											if(isset($val['UserProfile']['first_name'])){
												$name = $val['UserProfile']['first_name'];
											}	
											
											if(isset($val['User']['id'])){
												$key = $val['User']['id'];
											}											
											if(isset($val['UserProfile']['last_name']) && !empty($val['UserProfile']['last_name'])){
												$name .= ' '.$val['UserProfile']['last_name'];
											}
																					
										?>
										<tr>
											<td>
												<input type="checkbox" name="green_auto[<?php echo $key; ?>]" id="green_auto<?php echo $key; ?>" class="css-checkbox green_auto" value="<?php echo $key; ?>" />
												<label for="green_auto<?php echo $key; ?>" class="css-label"></label>
											</td>
											<td><?php echo $name; ?></td>
											<td align="center">
												<?php
													$image_name = $this->Common->profilePic($val['User']['id']);
													if (isset($image_name) && $image_name != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'user_images' . DS . $image_name)) { ?>	
														<div class="catepic">
															<?php
															echo $this->Html->Image('../uploads/user_images/' . $image_name, array('height' => 50, 'width' => 50));
															?>
														</div>
													<?php
													} 
													?>
											</td>
											<td class='hidden-350'>
												<?php 
													if(isset($val['UserProfile']['unique_id'])){
														echo $val['UserProfile']['unique_id'];
													}
												?>
											</td>
											<td class='hidden-1024'>
												<?php 
													if(isset($val['UserProfile']['nickname'])){
														echo $val['UserProfile']['nickname'];
													}
												?>
											</td>
											<td class='hidden-480'>
											<?php 
												if(isset($val['UserProfile']['age'])){ 
													echo $this->Common->birthday($val['UserProfile']['age']);
												}
											?>
											</td>
											<td class='hidden-480'>
												<?php 
													if(isset($val['UserProfile']['country_id'])){ 
														echo $this->Common->getCountry($val['UserProfile']['country_id']); 
													}
												?>
											</td>
											<td class='hidden-480'>
												<?php 
													if(isset($val['UserProfile']['city_id'])){ 
														echo $val['UserProfile']['city_id'];//$this->common->getCity($val['UserProfile']['city_id']); 
													}
												?>
											</td>
											<td class='hidden-480'>
												<?php 
													if(isset($val['User']['email'])){ 
														echo $val['User']['email'];
													}
												?>
											</td>
											<td class='hidden-480'>
												<?php 
													if(isset($val['UserProfile']['phone'])){ 
														echo $val['UserProfile']['phone'];
													}
												?>
											</td>
											
											<td class='hidden-480'>
												<?php 
													if(isset($val['User']['status']) && !empty($val['User']['status'])){
														echo 'Active';
													}else{
														echo 'Blocked';
													}
												?>
											</td>
											<td class='hidden-480'>
												<?php 
													if(isset($val['User']['created'])){ 
														echo $val['User']['created'];
													}
												?>
											</td>
											<td class='hidden-480'>
												<a href="<?php echo SITEURL; ?>profileview/<?php echo $val['User']['id']; ?>" ><i class="fa fa-edit"></i></a>
												<a href="javascript:void(0)" onclick="if(confirm('Are you sure you would like to delete this girl(s)?')){ window.location.href='<?php echo SITEURL; ?>profiledelete/<?php echo $key; ?>' }" ><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php } ?> 
										
										<tr>
											<td align="right" colspan="13">
												<?php echo $this->Paginator->prev('« Previous', array('class' => 'btn btn-warning btn-xs'), null, array('class' => 'disabled btn btn-warning btn-xs')); ?>
												<?php echo $this->Paginator->numbers(array('currentClass' => 'btn btn-success btn-xs', 'Class' => 'btn btn-warning btn-xs')); ?>
												<?php echo $this->Paginator->next('Next »',  array('class' => 'btn btn-warning btn-xs'), null, array('class' => 'disabled btn btn-warning btn-xs')); ?>
											</td>
										</tr>
									
									
									<?php	}else{
									?>	
									<tr><td align="center" colspan="13"> No Records Founds!!! </td></tr>
									<?php } ?>
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
