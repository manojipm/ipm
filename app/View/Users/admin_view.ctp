<script>
    jQuery(document).ready(function () {
        $(".impose_penalty").colorbox({inline:true, width:"50%"});
    });
</script>
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
                    <a href="#">View User - <?php echo $userType['Role']['role']; ?> </a>
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
                        <h3><i class="icon-th-list"></i> Users - View <?php echo $userType['Role']['role']; ?> </h3>
                        <h3 style="float: right; margin-right: 10px; font-size: 13px;">
                            <?php echo $this->Html->link('Back',array('action'=>'index'),array('style'=>'color:#fff !important;'));?>
                        </h3>
                        
                    </div>
                    <?php  if(isset($userType['Role']['role']) && $userType['Role']['id'] == AGENCY_ID){?>
                    <span style=" float: right; margin-right: 10px;text-decoration: none;">
                        <a class='impose_penalty' href="#inline_content">Impose Penalty</a>
                        <?php //echo $this->Html->link('Impose Penalty',array('controller'=>'users','action'=>'impose_penalty',$users['User']['id'],'type'=>$userType['Role']['id']),array());?>
                    </span>
                    <?php } ?>
                    <div class="box-content nopadding">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal form-bordered')); ?>
                        <?php if ($userType['Role']['id'] == 2) { ?>
                            <div class="control-group"> 
                                <label for="textfield" class="control-label">First Name</label>
                                <div class="controls"><?php echo $users['UserProfile']['first_name']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Email</label>
                                <div class="controls"><?php echo $users['User']['email']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Contact Person</label>
                                <div class="controls"><?php echo $users['UserProfile']['contact_person']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Phone </label>
                                <div class="controls"><?php echo $users['UserProfile']['phone']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Address </label>
                                <div class="controls"><?php echo $users['UserProfile']['address']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Country</label>
                                <div class="controls"><?php echo $this->Common->getCountry($users['UserProfile']['country_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">State</label>
                                <div class="controls"><?php echo $this->Common->getState($users['UserProfile']['state_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">City</label>
                                <div class="controls"><?php echo $users['UserProfile']['city_id'];
								//echo $this->Common->getCity($users['UserProfile']['city_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Agency License</label>
                                <div class="controls">
                                    <?php
                                    if(isset($users['UserProfile']['agency_license']) && !is_array($users['UserProfile']['agency_license'])){
                                        if (isset($users['UserProfile']['agency_license']) && !empty($users['UserProfile']['agency_license']) && $users['UserProfile']['agency_license'] != '' && file_exists(WWW_ROOT . 'uploads' . DS . 'agency_license' . DS . $users['UserProfile']['agency_license'])) { 	
                                            echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ;
                                            echo $this->Html->link('Agency License :' . $users['UserProfile']['agency_license'], array('controller' => 'users',
                                                'action' => 'downloadfile',
                                                $users['UserProfile']['agency_license'],
                                                'agency_license'
                                                    )
                                            );
                                        }
                                    }
                                    ?>   
                                </div>
                            </div>


                        <?php } ?>
                        <?php if ($userType['Role']['id'] == 3) { ?>

                            <div class="control-group"> 
                                <label for="textfield" class="control-label">First Name</label>
                                <div class="controls"><?php echo $users['UserProfile']['first_name']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Last Name</label>
                                <div class="controls"><?php echo $users['UserProfile']['last_name']; ?></div>
                            </div>
                            <div class="control-group">    
                                <label for="textfield" class="control-label">Nickname</label>
                                <div class="controls"><?php echo $users['UserProfile']['nickname']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Email</label>
                                <div class="controls"><?php echo $users['User']['email']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Age</label>
                                <div class="controls"><?php echo $users['UserProfile']['age']; ?></div>
                            </div>
                            <div class="control-group">	    
                                <label for="textfield" class="control-label">Weight</label>
                                <div class="controls"><?php echo $users['UserProfile']['weight']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Eyes</label>
                                <div class="controls"><?php echo $users['UserProfile']['eyes']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Hair</label>
                                <div class="controls"><?php echo $users['UserProfile']['hair']; ?></div>
                            </div>
                            <div class="control-group">	    
                                <label for="textfield" class="control-label">Religion</label>
                                <div class="controls"><?php echo $users['UserProfile']['relegion']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Marital Status</label>
                                <div class="controls"><?php echo $users['UserProfile']['marital_status']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Children</label>
                                <div class="controls"><?php echo $users['UserProfile']['children']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Languages</label>

                                <div class="controls">
                                    <?php
                                    //$lang =  $this->Common->getLanguages($users['UserProfile']['language_id']);
                                    //pr($lang);
                                    if (isset($users['Language']) && !empty($users['Language'])) {
                                        foreach ($users['Language'] as $value) {
                                            //pr($value['name']);
                                            echo $value['name'] . '<br>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Occupation</label>
                                <div class="controls"><?php echo $users['UserProfile']['occupation']; ?></div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Country</label>
                                <div class="controls"><?php echo $this->Common->getCountry($users['UserProfile']['country_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">State</label>
                                <div class="controls"><?php echo $this->Common->getState($users['UserProfile']['state_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">City</label>
                                <div class="controls"><?php //echo $this->Common->getCity($users['UserProfile']['city_id']); 
									echo $users['UserProfile']['city_id'];
								?></div>
                            </div>


                            <div class="control-group">
                                <label for="textfield" class="control-label">About Me</label>
                                <div class="controls"><?php echo $users['UserProfile']['about']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">My Ideal <?php echo $userType['Role']['role']; ?></label>
                                <div class="controls"><?php echo $users['UserProfile']['ideal']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">User Images</label>
                                <div class="controls">
                                    <?php echo isset($users['UserImage']['image_name']) ? $this->Html->Image('../uploads/user_images/' . $users['UserImage']['image_name'], array('height' => 100, 'width' => 100)) : '-'; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($userType['Role']['id'] == 4) { ?>

                            <div class="control-group"> 
                                <label for="textfield" class="control-label">First Name</label>
                                <div class="controls"><?php echo $users['UserProfile']['first_name']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Last Name</label>
                                <div class="controls"><?php echo $users['UserProfile']['last_name']; ?></div>
                            </div>
                            <div class="control-group">    
                                <label for="textfield" class="control-label">Nickname</label>
                                <div class="controls"><?php echo $users['UserProfile']['nickname']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Email</label>
                                <div class="controls"><?php echo $users['User']['email']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Age</label>
                                <div class="controls"><?php echo $users['UserProfile']['age']; ?></div>
                            </div>
                            <div class="control-group">	    
                                <label for="textfield" class="control-label">Weight</label>
                                <div class="controls"><?php echo $users['UserProfile']['weight']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Eyes</label>
                                <div class="controls"><?php echo $users['UserProfile']['eyes']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Hair</label>
                                <div class="controls"><?php echo $users['UserProfile']['hair']; ?></div>
                            </div>
                            <div class="control-group">	    
                                <label for="textfield" class="control-label">Religion</label>
                                <div class="controls"><?php echo $users['UserProfile']['relegion']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Marital Status</label>
                                <div class="controls"><?php echo $users['UserProfile']['marital_status']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Children</label>
                                <div class="controls"><?php echo $users['UserProfile']['children']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Languages</label>

                                <div class="controls">
                                    <?php
                                    //$lang =  $this->Common->getLanguages($users['UserProfile']['language_id']);
                                    //pr($lang);
                                    if (isset($users['Language']) && !empty($users['Language'])) {
                                        foreach ($users['Language'] as $value) {
                                            //pr($value['name']);
                                            echo $value['name'] . '<br>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Occupation</label>
                                <div class="controls"><?php echo $users['UserProfile']['occupation']; ?></div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Country</label>
                                <div class="controls"><?php echo $this->Common->getCountry($users['UserProfile']['country_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">State</label>
                                <div class="controls"><?php echo $this->Common->getState($users['UserProfile']['state_id']); ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">City</label>
                                <div class="controls"><?php
echo $users['UserProfile']['city_id'];
//								echo $this->Common->getCity($users['UserProfile']['city_id']); ?></div>
                            </div>


                            <div class="control-group">
                                <label for="textfield" class="control-label">About Me</label>
                                <div class="controls"><?php echo $users['UserProfile']['about']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">My Ideal <?php echo $userType['Role']['role']; ?></label>
                                <div class="controls"><?php echo $users['UserProfile']['ideal']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">My Phone </label>
                                <div class="controls"><?php echo $users['UserProfile']['phone']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">My Passport Number </label>
                                <div class="controls"><?php echo $users['UserProfile']['passport_number']; ?></div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">User Video</label>
                                <div class="controls">
                                    <?php echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ?>
                                    <?php
                                    echo $this->Html->link('Profile Video :' . $users['UserVideo']['profile_vedio'], array('controller' => 'users',
                                        'action' => 'downloadfile',
                                        $users['UserVideo']['profile_vedio'],
                                        'profile_vedio'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">User Passport Scan Copy</label>
                                <div class="controls">
                                    <?php echo $this->Html->Image('tick.png', array('height' => 14, 'width' => 14)) ?>
                                    <?php
                                    echo $this->Html->link('Passport Scan Copy :' . $users['UserProfile']['passport_scan_copy'], array('controller' => 'users',
                                        'action' => 'downloadfile',
                                        $users['UserProfile']['passport_scan_copy'],
                                        'passport_scan_copy'
                                            )
                                    );
                                    ?>
                                    <?php //echo isset($users['UserProfile']['passport_scan_copy']) ? $this->Html->Image('../uploads/passport_scan_copy/'.$users['UserProfile']['passport_scan_copy'],array('height'=>100,'width'=>100)) : '-' ;?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">User Images</label>
                                <div class="controls">
                                    <?php echo isset($users['UserImage']['image_name']) ? $this->Html->Image('../uploads/user_images/' . $users['UserImage']['image_name'], array('height' => 100, 'width' => 100)) : '-'; ?>
                                </div>
                            </div>
                        <?php } ?>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style='display:none'>
        <div id='inline_content' style='padding:10px; background:#fff;'>
        <?php include 'admin_impose_penalty.ctp';?>
        </div>
</div>























