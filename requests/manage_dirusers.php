<?php
include("../includes/config.php");
include("../includes/classes.php");
include(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
session_start();
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings());
$settings = $resultSettings->fetch_assoc();

		if(isset($_POST['start'])) {
			$manageUsers = new manageUsers();
			
			$manageUsers->db = $db;
			$manageUsers->url = $CONF['url'];
			$manageUsers->per_page = $settings['uperpage'];
			
			echo $manageUsers->dirgetUsers($_POST['start']);
		}
	

?>