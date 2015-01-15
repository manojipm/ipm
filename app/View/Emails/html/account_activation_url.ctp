<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Dating Password Change </title>

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
                <td colspan="3" style="color:#016165; font-size:16px; padding:15px 10px;">Hello <b><?php echo $users['UserProfile']['first_name'] . ' ' . $users['UserProfile']['last_name']; ?></b>, </td>
            </tr>

            <tr>
                <td colspan="3" style="padding:5px 10px;">Your login password to the Drug Comparison website has been reset.
                    <br>Please use the following login details to access your account.</td>
            </tr>

            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Website</strong>: <b><?php echo Configure::read('site.url'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Activation Url </strong>: 
                    <b>
                    <?php echo $this->Html->link(SITEURL.'users/activation/'.$users['User']['activation_key'],array('controller'=>'users','action'=>'activation',$users['User']['activation_key']) );?>
                    </b>
                </td>
            </tr>
<!--            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Username</strong>: <b><?php echo $users['User']['email']; ?></b></td>
            </tr>
            <tr>
                <td colspan="3" style="padding:5px 10px;"><strong>Password</strong>: <b><?php echo $users['User']['password']; ?></b></td>
            </tr>-->

            <tr>
                <td colspan="3" style="padding:5px 10px;">Thank you, 
                    <br />
                    Dating Web Team</td>
            </tr>
           <!-- <tr>
              <td colspan="3"><img src="<?php echo Router::url('/', true); ?>img/email/clods-bot.png" alt="<?php echo Router::url('/', true); ?>img/email/cluds.png" /></td>
            </tr>-->
        </table>

    </body>
</html>
<?php //pr($users); die; ?>