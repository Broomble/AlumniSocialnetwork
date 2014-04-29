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

// Remove any extra white spaces, new lines
$_POST['message'] = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $_POST['message']);

// If message is not empty
if(!empty($_POST['message']) && $_POST['message'] !== ' ') {

	// If the user have session or cookie set
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$loggedIn = new loggedIn();
		$loggedIn->db = $db;
		$loggedIn->url = $CONF['url'];
		$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
		$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
		
		$verify = $loggedIn->verify();
		
		// If user is authed successfully
		if($verify['username']) {
			$feed = new feed();
			$feed->db = $db;
			$feed->url = $CONF['url'];
			$feed->username = $verify['username'];
			$feed->time = $settings['time'];
			$feed->id = $verify['idu'];
			$feed->chat_length = $settings['message'];
			$feed->censor = $settings['censor'];
			$feed->smiles = $settings['smiles'];
			
			// Set the $x to output the value via JS
			echo $feed->postChat($_POST['message'], $_POST['id']);
		}
	}
}

?>