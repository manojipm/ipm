<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Date Your with Your love</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<!--[if IE]>  
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>  
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<?php echo $this->element('front/front_css'); ?>
</head>

<body>
	<div class="page">
		<?php
			echo $this->element('front/header'); // Common to all
			echo $this->Session->flash();
			// Common For All
			echo $this->fetch('content');
			echo $this->element('front/footer');
		?>
	</div>
	<?php echo $this->element('front/front_js'); ?>
</body>
</html>