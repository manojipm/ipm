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
                <td colspan="3" style="color:#016165; font-size:16px; padding:15px 10px;">Hello <b>Admin</b>, </td>
            </tr>
			
            <tr>
                <td colspan="3" style="padding:5px 10px;">A new girl profile is registred through <?php echo $this->Session->read('Auth.User.first_name'); ?> agency on inlovebride site. Girl Profile details are as follows:</td>
            </tr>
			<?php if(isset($users) && !empty($users)){ ?>
            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>ID</strong>: <?php echo $users['UserProfile']['unique_id']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Name</strong>: <?php echo $users['UserProfile']['first_name'].' '.$users['UserProfile']['last_name']; ?></td>
            </tr>
			
			 <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Nickname</strong>:<?php echo $users['UserProfile']['nickname']; ?></td>
            </tr>
			
			 <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Age</strong>: <?php echo $this->Common->birthday($users['UserProfile']['age']); ?></td>
            </tr>

			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Weight</strong>: <?php echo $users['UserProfile']['weight'].' '.$users['UserProfile']['weight_type']; ?></td>
            </tr>
			<?php 
				$feet = (int)($users['UserProfile']['height']/12) ;
				$inches = ($users['UserProfile']['height']%12) ;
				$height = $feet.' Feet '.$inches.' Inch';
			?>
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Height</strong>: <?php echo $height; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Eyes</strong>: <?php echo $users['UserProfile']['eyes']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Hair </strong>: <?php echo $users['UserProfile']['hair']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Religion  </strong>: <?php echo $users['UserProfile']['relegion']; ?></td>
            </tr>
			
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Marital Status  </strong>: <?php echo $users['UserProfile']['marital_status']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Children</strong>: <?php echo $users['UserProfile']['children']; ?></td>
            </tr>
			
			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Phone</strong>: <?php echo $users['UserProfile']['phone']; ?></td>
            </tr> <tr>
			
			
                <td colspan="3" style="padding:5px 10px;"><strong>Email</strong>: <?php echo $users['User']['email']; ?></td>
            </tr>
			
			
			<?php } ?>
           <tr>
			
                <td colspan="3" style="padding:5px 10px;">Please login to admin panel, verify the details and activate the girl Profile.</td>
            </tr>
            <tr>
                <td colspan="3" style="padding:5px 10px;">Thank you, 
                    <br />
                    Inlovebride System Adminitrater</td>
            </tr>
           <!-- <tr>
              <td colspan="3"><img src="<?php echo Router::url('/', true); ?>img/email/clods-bot.png" alt="<?php echo Router::url('/', true); ?>img/email/cluds.png" /></td>
            </tr>-->
        </table>

    </body>
</html>