<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Agency Registration </title>

    </head>
	
    <body style='margin:0px; padding:0; font-family: "Calibri", Helvetica, Arial, Verdana, sans-serif; font-size:14px; background:#f0f0f0; line-height:23px;'>
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#fff; padding:0px 10px;" >
            <tr>
                <td style="border-bottom:solid 5px #016165;">
                    <img src="<?php echo Router::url('/', true); ?>img/logo1.png"  alt="<?php echo Router::url('/', true); ?>img/logo1.png" />
                </td>
                <td width="284" align="right" valign="bottom" style="border-bottom:solid 5px #016165;">&nbsp;</td>
                <td width="134" align="right" valign="bottom" style="border-bottom:solid 5px #016165;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="color:#016165; font-size:16px; padding:15px 10px;">Hello <b><?php echo $users['UserProfile']['first_name'].' '.$users['UserProfile']['last_name']; ?></b>, </td>
            </tr>
			
            <tr>
                <td colspan="3" style="padding:5px 10px;">Welcome to inlovebride. <?php echo $this->Session->read('Auth.User.first_name'); ?> agency has been registered your profile and sent to the site admin for approval. Once the admin has approved your profile you can access your account using below details:</td>
            </tr>
			<?php if(isset($users) && !empty($users)){ ?>
            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>ID</strong>: <?php echo $users['UserProfile']['unique_id']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Username</strong>: <?php echo $users['User']['email']; ?></td>
            </tr>
			
			 <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Password</strong>:<?php echo $users['User']['showpassword']; ?></td>
            </tr>
			
			
			<?php } ?>
             <tr>
                <td colspan="3" style="padding:5px 10px;">Thank you, 
                    <br />
                    Inlovebride Web Team</td>
            </tr>
           <!-- <tr>
              <td colspan="3"><img src="<?php echo Router::url('/', true); ?>img/email/clods-bot.png" alt="<?php echo Router::url('/', true); ?>img/email/cluds.png" /></td>
            </tr>-->
        </table>

    </body>
</html>