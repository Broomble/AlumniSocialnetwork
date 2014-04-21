<?php

function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if(empty($verify['username'])) {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		} else {

			if(isset($_POST['contact'])) {
				// Verification usage
				$con = new contact();
				$con->db = $db;
				$con->url = $CONF['url'];
				$con->phone = $_POST['phone'];
				$con->email = $_POST['email'];
				$con->address = $_POST['address'];		
				$con->state = $_POST['state'];
				$con->country = $_POST['country'];

				
				//$con->dob = $settings['captcha'];

				$TMPL['contactMsg'] = $con->process();

				if($TMPL['contactMsg'] == 1) {
					header("Location: ".$CONF['url']."/index.php?a=contact");
				}

			}

		// If the username input string is an e-mail, switch the query
		if(filter_var($_SESSION['username'], FILTER_VALIDATE_EMAIL)) {
			$result = $db->query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'");
		} else {
			$result = $db->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'");
		}		
		
		while($row = $result->fetch_assoc()) {
			$status = $row['status'];	
		}
		
		if($status == 1){
			header("Location: ".$CONF['url']."/index.php?a=employee");
		}elseif($status == 2){
			header("Location: ".$CONF['url']."/index.php?a=feed");
		}

	}
		} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['Contact'].' - '.$settings['title'];
	
	$TMPL['ad'] = $settings['ad1'];
	
	$skin = new skin('register/contact');
	return $skin->make();
}

?>