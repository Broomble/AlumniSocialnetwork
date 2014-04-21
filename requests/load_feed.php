<?php
include("../includes/config.php");
include("../includes/classes.php");
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
session_start();
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings()); 
$settings = $resultSettings->fetch_assoc();

// The theme complete url
$CONF['theme_url'] = $CONF['theme_path'].'/'.$settings['theme'];

if(!empty($_POST['start'])) {
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$loggedIn = new loggedIn();
		$loggedIn->db = $db;
		$loggedIn->url = $CONF['url'];
		$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
		$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
		
		$verify = $loggedIn->verify();
		
		$feed = new feed();
		$feed->db = $db;
		$feed->url = $CONF['url'];
		$feed->user = $verify;
		$feed->id = $verify['idu'];
		$feed->username = $verify['username'];
		$feed->per_page = $settings['perpage'];
		$feed->censor = $settings['censor'];
		$feed->smiles = $settings['smiles'];
		$feed->c_per_page = $settings['cperpage'];
		$feed->c_start = 0;
		$feed->l_per_post = $settings['lperpost'];
		$feed->time = $settings['time'];
		if(empty($_POST['filter'])) {
			$_POST['filter'] = '';
		}
		
		$getFeed = $feed->getFeed($_POST['start'], $_POST['filter']);
		echo $getFeed[0];
	}
}
?>