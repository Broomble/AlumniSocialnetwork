<?php
#error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);

$CONF = $TMPL = array();

// The MySQL credentials
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = 'root';
$CONF['name'] = 'alumni';

// The Installation URL
$CONF['url'] = 'http://alumni.dev';

// The Notifications e-mail
$CONF['email'] = 'notifications@alumni.dev';

// The themes directory
$CONF['theme_path'] = 'themes';

$action = array('admin'			=> 'admin',
				'feed'			=> 'feed',
				'verify'		=> 'verify',
				'register'		=> 'register',
				'contact'		=> 'contact',
				'employee'		=> 'employee',
				'settings'		=> 'settings',
				'messages'		=> 'messages',
				'post'			=> 'post',
				'recover'		=> 'recover',
				'timeline'		=> 'timeline',
				'profile'		=> 'profile',
				'notifications'	=> 'notifications',
				'search'		=> 'search',
				'page'			=> 'page',
				'directory'		=> 'alumnidir'
				);
?>
