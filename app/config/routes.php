<?php
return array(
	'_root_'  => '/web/index/',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
    'login'  => '/admin/home/login',
    'logout'  => '/admin/home/logout',
    'admin'  => '/admin/home',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);