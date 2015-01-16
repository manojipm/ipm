<?php

echo $this->Html->script(array(
    'comman',
    ));
$controller = $this->params['controller'];
$action = $this->params['action'];

$dashboard = '';
$page = '';
$user = '';
$masters = '';
$agency = '';
$banner = '';
$setting = '';
$testimonial = '';
$new = '';
$slider = '';
$review   = '';
$plan   = '';
$penalty   = '';
$commision   = '';
$products   = '';
$messages   = '';
if ($controller == 'dashboards' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $dashboard = ' active';
}
if ($controller == 'locations' || $controller == 'projects' || $controller == 'companies' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $masters = ' active';
}
if ($controller == 'users' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $user = ' active';
}
if ($controller == 'pages' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $page = ' active';
}
if ($controller == 'agency' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $agency = ' active';
}

if ($controller == 'testimonials' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $testimonial = ' active';
}
if ($controller == 'news' && $action == ('index' || 'add' || 'edit' || 'delete')) {
    $new = ' active';
}
if ($controller == 'sliders' && $action == ('index' || 'add' || 'edit' || 'delete')) {
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

<div id="navigation">
    <div class="container-fluid">
        <a href="<?php echo SITEURL; ?>admin" id="brand">ADMIN</a>
        <a href="javascript:void(0);" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation" data-original-title="Toggle navigation">
            <i class="icon-reorder"></i>
        </a>
        <ul class='main-nav'>
            <li class='<?php echo $dashboard; ?>'>
                <a href="<?php echo SITEURL; ?>admin/dashboards">
                    <span>Dashboard</span>
                </a>
            </li>
           


            <li class='<?php echo $masters; ?>'>
                <a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
                    <span>Masters</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/country">Country</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/state">State</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/zone">Zone</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/locations/city">City</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/division">Location By division Type</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/classification">Industry Classification</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>admin/companies/structure">Company Structure</a>
					</li> 
                                        <li>
						<a href="<?php echo SITEURL; ?>admin/projects/source">Project Source</a>
					</li> 
                                        <li>
						<a href="<?php echo SITEURL; ?>admin/projects/expense">Subject Expense Type</a>
					</li> 
                                        <li>
						<a href="<?php echo SITEURL; ?>admin/projects/category">Project Category</a>
					</li> 
                </ul>
            </li>
            
            <li class='<?php echo $user; ?>'>
                <a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
                    <span>Admin Users</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
			<a href="<?php echo SITEURL; ?>admin/users">Users</a>
                    </li>
                </ul>
            </li>

           

			
<!--            <li class='<?php echo $review; ?>'>
                <a href="<?php echo SITEURL; ?>admin/reviews">
                    <span>Reviews</span>
                </a>
            </li>-->
<!--            <li class='<?php echo $plan; ?>'>
                <a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
                    <span>Plans</span>
                    <span class="caret"></span>
                </a>
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
        <div class="user">
            <div class="dropdown">
                <?php 
				//pr($this->Session->read('Auth.Admin'));
				$name = ucfirst($this->Session->read('Auth.Admin.UserProfile.first_name')) . ' ' . ucfirst($this->Session->read('Auth.Admin.UserProfile.last_name')); 
                $name = trim($name);
				$profile = $this->Session->read('Auth.Admin.UserImage.image_name');
				if(empty($profile)){
					$profile = 'avatar.png';
				}else{
					$profile = '../uploads/user_images/'.$profile;
				}
				?>
				<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown"><?php if (!empty($name)) {
                    echo $name;
                } else {
                    echo 'Admin';
                } ?><?php echo $this->Html->image($profile, array('width' => '16px', 'height' => '16px')) ?></a>
                <ul class="dropdown-menu pull-right">
                    <li>
<?php echo $this->Html->link('Edit profile', array('controller' => 'users', 'action' => 'profile', 1)); ?>
                    </li>
                    <!--						<li>
                                                                            <a href="<?php echo SITEURL; ?>admin/settings/edit">Account settings</a>
                                                                    </li>-->
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/users/logout">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

