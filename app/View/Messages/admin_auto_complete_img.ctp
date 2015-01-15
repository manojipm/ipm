<?php
    //pr($users);
    if(isset($users) && !empty($users)){
        foreach($users as $val){
            //echo $val['UserProfile']['first_name']."\n";
            $username=$val['UserProfile']['first_name'];
            $email=$val['User']['email'];
            $media=$val['UserImage']['image_name'];
            $country=$this->Common->getCountry($val['UserProfile']['country_id']);
            $b_username='<b>'.$q.'</b>';
            $b_email='<b>'.$q.'</b>';
            $final_username = str_ireplace($q, $b_username, $username);
            $final_email = str_ireplace($q, $b_email, $email);
            ?>
            <div class="display_box"   align="left">
                <?php
                    echo empty($media) ? $this->Html->Image(SITEURL.'img/no_image.jpg', array('style' => "width:50px; height:50px; float:left; margin-right:6px;")) : $this->Html->Image(SITEURL.'uploads/user_images/' . $media, array('style' => "width:50px; height:50px; float:left; margin-right:6px;"));
                ?>
                <span class="name" id="<?php echo $val['User']['id'];?>"  ><?php echo $final_username; ?></span>
                &nbsp;<br/>
                <?php echo $final_email; ?><br/>
                <span style="font-size:9px; color:#999999"><?php echo $country; ?></span>
            </div>
<?php 
}
    }else{
       echo 'No match' ;
    }
?>