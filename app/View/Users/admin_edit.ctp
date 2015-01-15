<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/users">Users</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit User - <?php echo $userType['Role']['role'];  ?></a>
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
                        <h3><i class="icon-th-list"></i> Users - Edit User  <?php echo $userType['Role']['role'];  ?></h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php echo $this->Form->input('User.role_id', array('type' => 'hidden', 'value' => $userType['Role']['id'])); ?>
                        <?php echo $this->Form->input('UserProfile.role_id', array('type' => 'hidden','value'=>$userType['Role']['id'])); ?>
                        <?php echo $this->Form->input('User.id', array('type' => 'hidden')); ?>
                        <?php 
                            if($userType['Role']['id'] == 3){
                                include 'man.ctp';
                            }elseif($userType['Role']['id'] == 4){
                                include 'woman.ctp';
                            }elseif($userType['Role']['id'] == 2){
                                include 'agency.ctp';
                            }
                        ?>

                        

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





















