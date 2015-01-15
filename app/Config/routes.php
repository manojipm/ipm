
<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
 	Router::connect('/admin', array('controller' => 'users', 'action' => 'login', 'admin'=>true));
 	Router::connect('/agency', array('controller' => 'agencies', 'action' => 'index', 'agency'=>true));
 	Router::connect('/man', array('controller' => 'men', 'action' => 'index', 'man'=>true));
 	Router::connect('/woman', array('controller' => 'women', 'action' => 'index', 'woman'=>true));
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home', 'admin'=>false));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login', 'admin'=>false));
	Router::connect('/registration', array('controller' => 'users', 'action' => 'registration', 'admin'=>false));
	Router::connect('/partners', array('controller' => 'users', 'action' => 'registration_agency', 'admin'=>false));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout', 'admin'=>false));
	Router::connect('/profileadd', array('controller' => 'agencies', 'action' => 'profileadd', 'agency'=>true));
	Router::connect('/profileedit/*', array('controller' => 'agencies', 'action' => 'profileedit', 'agency'=>true));
	Router::connect('/profileview/*', array('controller' => 'agencies', 'action' => 'profileview', 'agency'=>true));
	Router::connect('/profiledelete/*', array('controller' => 'agencies', 'action' => 'profiledelete', 'agency'=>true));
	Router::connect('/woman/introletter', array('controller' => 'women', 'action' => 'introletter', 'woman'=>true));
	Router::connect('/agency/introletters', array('controller' => 'agencies', 'action' => 'introletters', 'agency'=>true));
	Router::connect('/man/buycredits', array('controller' => 'men', 'action' => 'buy_credit', 'man'=>true));
    Router::connect('/man/payment', array('controller' => 'men', 'action' => 'payment', 'man'=>true));
    Router::connect('/agency/introdetails/*', array('controller' => 'agencies', 'action' => 'introdetails', 'agency'=>true));
    Router::connect('/agency/connecttoprofile/*', array('controller' => 'agencies', 'action' => 'connecttoprofile', 'agency'=>true));
    Router::connect('/agency/disconnecttoprofile/*', array('controller' => 'agencies', 'action' => 'disconnecttoprofile', 'agency'=>true));
    Router::connect('/agency/myprofile', array('controller' => 'agencies', 'action' => 'myprofile', 'agency'=>true));
    Router::connect('/woman/myprofile', array('controller' => 'women', 'action' => 'myprofile', 'woman'=>true));
    Router::connect('/man/myprofile', array('controller' => 'men', 'action' => 'myprofile', 'man'=>true));
    Router::connect('/agency/myaccount', array('controller' => 'agencies', 'action' => 'myaccount', 'agency'=>true));
   // Router::connect('/woman/myaccount', array('controller' => 'women', 'action' => 'myaccount', 'woman'=>true));
   // Router::connect('/man/myaccount', array('controller' => 'men', 'action' => 'myaccount', 'man'=>true));
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
