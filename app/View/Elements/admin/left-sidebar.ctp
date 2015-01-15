<?php
$controller = $this->params['controller'];
$action 	= $this->params['action']; 

$dashboard	= '';
$page		= '';
$testimonial	= '';
$new		= '';	
$agency		= '';
$user		= '';
$setting	= '';
$slider         = '';
$review         = '';
$plan	= '';
$place		= '';
$penalty		= '';
$commision		= '';
$products   = '';
$messages   = '';
if($controller == 'dashboards' && $action ==('index'||'add'||'edit'||'delete')){
	$dashboard = ' active';
}
if($controller == 'pages' && $action ==('index'||'add'||'edit'||'delete')){
	$page = ' active';
}
if($controller == 'testimonials' && $action ==('index'||'add'||'edit'||'delete')){
	$testimonial = ' active';
}
if($controller == 'news' && $action ==('index'||'add'||'edit'||'delete')){
	$new = ' active';
}

if($controller == 'agency' && $action ==('index'||'add'||'edit'||'delete')){
	$agency = ' active';
}
if($controller == 'users' && $action ==('index'||'add'||'edit'||'delete')){
	$user = ' active';
}
if($controller == 'settings' && $action ==('index'||'add'||'edit'||'delete')){
	$setting = ' active';
}
if($controller == 'sliders' && $action ==('index'||'add'||'edit'||'delete')){
	$slider = ' active';
}
if($controller == 'reviews' && $action ==('index'||'add'||'edit'||'delete')){
	$review = ' active';
}
if($controller == 'plans' && $action ==('index'||'add'||'edit'||'delete')){
	$plan = ' active';
}
if($controller == 'penalty' && $action ==('index'||'add'||'edit'||'delete')){
	$penalty = ' active';
}
if($controller == 'commisions' && $action ==('index'||'add'||'edit'||'delete')){
	$commision = ' active';
}

if($controller == 'products' && $action ==('index'||'add'||'edit'||'delete')){
	$products = ' active';
}
if($controller == 'messages' && $action ==('index'||'add'||'edit'||'delete')){
	$messages = ' active';
}
?>

<div id="left" class="ui-sortable ui-resizable" >
	<form action="search-results.html" method="GET" class='search-form'>
		<!--<div class="search-pane">
			<input type="text" name="search" placeholder="Search here...">
			<button type="submit"><i class="icon-search"></i></button>
		</div>-->
	</form>
	<div class="subnav">
		<div class="subnav-title">
			<a href="javascript:void(0);" class='toggle-subnav'><i class="icon-angle-down"></i><span>Master Manager</span></a>
		</div>
		<ul class="subnav-menu"> 
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Country</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/country">Country</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/country_add">Add Country</a>
					</li>
				</ul>
			</li><li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">State</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/state">State</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/state_add">Add State</a>
					</li>
				</ul>
			</li><li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Zone</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/zone">Zone</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/zone_add">Add Zone</a>
					</li>
				</ul>
			</li>

			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">City</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/city">City</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/city_add">Add City</a>
					</li>
				</ul>
			</li>
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Location By division Type</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/division">Location by division</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/division_add">Add Location by division</a>
					</li>
				</ul>
			</li>
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Industry Classification</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/classification">Industry Classification</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/classification_add">Add Industry Classification</a>
					</li>
				</ul>
			</li>
			
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Company Structure</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/structure">Company Structure</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/structure_add">Add Company Structure</a>
					</li>
				</ul>
			</li>
			
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Project Source</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/source">Project Source</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/source_add">Add Project Source</a>
					</li>
				</ul>
			</li>
			
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Subject Expense Type</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/expense">Subject Expense Type</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/expense_add">Add Subject Expense Type</a>
					</li>
				</ul>
			</li>
			
			
			<li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Project Category</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/category">Project Category</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/projects/category_add">Add Project Category</a>
					</li>
				</ul>
			</li>
                        
                        <li class='dropdown <?php echo $testimonial;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Users</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/users/user">Users</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/users/user_add">Add User</a>
					</li>
				</ul>
			</li>
			
			
		</ul>
		
	</div>
	<div class="subnav">
		<div class="subnav-title">
			<a href="javascript:void(0);" class='toggle-subnav'><i class="icon-angle-down"></i><span>Managers</span></a>
		</div>
		<ul class="subnav-menu">

			<!--<li class='dropdown <?php echo $user;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Users</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/users">Users</a>
					</li>
					<li class='dropdown-submenu'>
						<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>Add User</a>
						<ul class="dropdown-menu">
                                                        <li>
								<a href="<?php echo SITEURL; ?>admin/users/add/type:2">Agency</a>
							</li>
							<li>
								<a href="<?php echo SITEURL; ?>admin/users/add/type:3">Man</a>
							</li>
							<li>
								<a href="<?php echo SITEURL; ?>admin/users/add/type:4">Woman</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			 <li class='dropdown <?php echo $slider;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Sliders</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/sliders">Sliders</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/sliders/add">Add Slider</a>
					</li>
				</ul>
			</li>
			
			<li class='dropdown <?php echo $plan;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Plans</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/plans">Plans</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/plans/add">Add Plan</a>
					</li>
				</ul>
			</li>
            <li class='dropdown <?php echo $penalty;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Penalty</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/penalty">Penalty</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/penalty/add">Add Penalty</a>
					</li>
				</ul>
			</li>
                        <li class="<?php echo $messages;?>">
				<a href="<?php echo SITEURL; ?>admin/messages">Messages</a>
			</li>-->
			
<!--                        <li class="<?php echo $review;?>">
				<a href="<?php echo SITEURL; ?>admin/reviews">Reviews</a>
			</li>-->
<!--                        <li class='dropdown <?php echo $plan;?>'>
				<a href="javascript:void(0);" data-toggle="dropdown">Plans</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/plans">Plans</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/plans/add">Add Plan</a>
					</li>
				</ul>
			</li>-->
			
		</ul>
	</div>
<!--	<div class="subnav">
		<div class="subnav-title">
			<a href="javascript:void(0);" class='toggle-subnav'><i class="icon-angle-down"></i><span>Settings</span></a>
		</div>
		<ul class="subnav-menu">
                    <li class="<?php echo $setting;?>">
				<a href="<?php echo SITEURL; ?>admin/settings/edit">Account settings</a>
			</li>
		</ul>
	</div>-->
</div>