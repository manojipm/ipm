<?php
################### Constant variable define here all type -: 19-12-2014 #############################

$hostname = $_SERVER['HTTP_HOST'];
if($hostname == 'localhost' || $hostname == '192.168.4.208' ){
    define('SITEURL', 'http://'.$hostname.'/git_ipm/');
}else{
    define('SITEURL', 'http://'.$hostname);
}
define('ADMIN_EMAIL', 'manish.singh@mailinator.com');


define('ADMIN_PAGING', '5');
define('FRONT_PAGING', '10');


define('SHOW_PER_PAGE',serialize(array("10" => "10" ,"20" => "20" ,"30" => "30" ,"40" => "40" ,"50"=>"50","100"=>"100","150" => "150" ,"200" => "200" ,)) );

$ip = $_SERVER['REMOTE_ADDR'];
//$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));

//if(isset($details->country) && !empty($details->country)){
//    define("COUNTRY_CODE", $details->country);
//}else{
    define("COUNTRY_CODE", 'IN');
//}

define("UPLOAD", 'uploads/');

define("AGENCY_FILE_PATH", UPLOAD.'agency_license');
define("NEWS_FILE_PATH", UPLOAD.'news_images');
define("USER_PASSPORT_PATH", UPLOAD.'passport_scan_copy');
define("USER_VIDEO_PATH", UPLOAD.'profile_vedio');
define("SLIDER_FILE_PATH", UPLOAD.'slider_images');
define("PRODUCT_FILE_PATH", UPLOAD.'products');

define("VIRPRODUCT_FILE_PATH", PRODUCT_FILE_PATH.'/virtual');
define("LOVEPRODUCT_FILE_PATH", PRODUCT_FILE_PATH.'/love');
define("ROMANCEPRODUCT_FILE_PATH", PRODUCT_FILE_PATH.'/romance');
define("REALPRODUCT_FILE_PATH", PRODUCT_FILE_PATH.'/real');

define("VIRPRODUCT_THUMB_FILE_PATH", VIRPRODUCT_FILE_PATH.'/thumb');
define("LOVEPRODUCT_THUMB_FILE_PATH", LOVEPRODUCT_FILE_PATH.'/thumb');
define("ROMANCEPRODUCT_THUMB_FILE_PATH", ROMANCEPRODUCT_FILE_PATH.'/thumb');
define("REALPRODUCT_THUMB_FILE_PATH", REALPRODUCT_FILE_PATH.'/thumb');


define("TESTIMONIAL_FILE_PATH", UPLOAD.'testimonial_images');
define("USER_PIC_PATH", UPLOAD.'user_images');
define("PENALTY_ATTACHMENT_FILE_PATH", UPLOAD.'penalty_attachments');
define("MESSAGE_FILE_PATH", UPLOAD.'message_files');


define("PAGE_IMAGE_PATH", UPLOAD.'page_images');


define("ADMIN_DATE_FORMAT", 'M jS, Y');
define("FRONT_DATE_FORMAT", '%d-%m-%Y');
define("TIME_ZONE", 'Asia/Kolkata');

define("SEX", serialize(array("m"=>"Man","w"=>"Woman","o"=>"Other")));
define("EYES",serialize(array("red"=>"Red","black"=>"Black","other"=>"Other")) );
define("RELEGION", serialize(array("hindu"=>"Hindu","sikh"=>"Sikh","other"=>"Other")));
define("MARITALSTATUS", serialize(array("single"=>"Single","married" => 'Married', 'widow'=>'Widow', 'other'=>'Other')));
define("CHILDREN", serialize(array("1"=>"1","2"=>"2","3"=>"3")));
define("HEIR",serialize(array("red"=>"Red","black"=>"Black","other"=>"Other")) );
define("PENALTY_REASON",serialize(array("obsence Images uploaded"=>"obsence Images uploaded")) );
define("WOMAN_ID",'4');
define("MAN_ID",'3');
define("AGENCY_ID",'2');

define("ACTIVE",'1');
define("DEACTIVE",'0');

define("SENT_ITEM",'2');
define("INBOX",'1');
define("TRASH",'3');
define("UNREAD",'0');

define("OTHER_ID",'5');// OTHER in Roles table
define("GIFT_DELIVERY",'11');// Activities table id 11 for gift delivery
define("CURRENCY","$");

define("COMPANY_NAME","InLoveBride.Com");


