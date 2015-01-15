<?php
    //pr($users);
    if(isset($users) && !empty($users)){
        foreach($users as $val){
             echo $val['UserProfile']['first_name']."\n";
        }
    }else{
       echo 'No match' ;
    }
?>

