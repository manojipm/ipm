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
                <td colspan="3" style="padding:5px 10px;">A new agency is registred on inlovebride site. Agency details are as follows:</td>
            </tr>
			<?php if(isset($ArrDetails) && !empty($ArrDetails)){ ?>
            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Agency Name</strong>: <?php echo $ArrDetails['UserProfile']['first_name']; ?></td>
            </tr>
			
			 <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Contact Person</strong>:<?php echo $ArrDetails['UserProfile']['contact_person']; ?></td>
            </tr>
			
			 <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Address</strong>: <?php echo $ArrDetails['UserProfile']['address']; ?></td>
            </tr>

			<tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Phone</strong>: <?php echo $ArrDetails['UserProfile']['phone']; ?></td>
            </tr> <tr>
			
			
                <td colspan="3" style="padding:5px 10px;"><strong>Email</strong>: <?php echo $ArrDetails['User']['email']; ?></td>
            </tr>
			
			
			<?php } ?>
           <tr>
			
                <td colspan="3" style="padding:5px 10px;">Please login to admin panel, verify the details and activate the agency.</td>
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
<?php //pr($ArrDetails); die; ?>