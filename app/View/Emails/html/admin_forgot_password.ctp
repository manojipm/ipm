<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
</head>
<body style="margin:0px; padding:12px; font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px; background:#EBF6FF; line-height:23px;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#fff; padding:12px; border:3px solid #DFF1FF" >
	<tr>
		<td colspan="3" style="color:#173D8E; font-size:16px; padding:15px 10px;">Password Recovery</td>
	</tr>
	<tr>
		<td colspan="3" style="color:#173D8E; font-size:16px; padding:15px 10px;">Dear <?php echo $users['UserProfile']['first_name'].' '.$users['UserProfile']['last_name']; ?>, </td>
	</tr>
	<tr>
		<td colspan="3" style="padding:5px 10px;">
			Your password has been reset. Please login to <a href="<?php echo Router::url('/', true);?>/admin/users/login"><?php echo Router::url('/', true);?></a> with the following details. Don't forget to change your password to one that is memorable.
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding:5px 10px;"><strong>Email</strong>: <?php echo $users['User']['email'];?></td>
	</tr>
	<tr>
		<td colspan="3" style="padding:5px 10px;"><strong>Password</strong>: <?php echo $users['User']['password'];?></td>
	</tr>
	<tr>
		<td colspan="3" style="padding:5px 10px;">
			Thank you.
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding:5px 10px;">Kind regards,<br />
		Dating Web Team
		</td>
	</tr>
</table>
</body>
</html>
<?php // die;?>
