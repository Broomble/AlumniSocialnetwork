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

					if(isset($_POST['employee'])) {
						// Verification usage
						$emp = new employee();
						$emp->db = $db;
						$emp->url = $CONF['url'];
						$emp->company = $_POST['company'];
/*						$emp->hrphone = $_POST['hrphone'];
						$emp->hrname = $_POST['hrname'];
						$emp->hremail = $_POST['hremail'];*/
						$emp->offaddress = $_POST['offaddress'];	
						$emp->offemail = $_POST['offemail'];	
						$emp->offphone = $_POST['offphone'];		
						$emp->industry = $_POST['industry'];
						$emp->designation = $_POST['designation'];
						$emp->department = $_POST['department'];
						$emp->country = $_POST['country'];
						$emp->state = $_POST['state'];
						$emp->country = $_POST['country'];
						$emp->joining = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

						
						//$con->dob = $settings['captcha'];

						$TMPL['employeeMsg'] = $emp->process();

						if($TMPL['employeeMsg'] == 1) {
							header("Location: ".$CONF['url']."/index.php?a=employee");
						}

					}

					// If the username input string is an e-mail, switch the query
					if(isset($_SESSION['username'])){
						if(filter_var($_SESSION['username'], FILTER_VALIDATE_EMAIL)) {
							$result = $db->query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'");
						} else {
							$result = $db->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'");
						}
					}elseif(isset($_COOKIE['username'])){
						if(filter_var($_COOKIE['username'], FILTER_VALIDATE_EMAIL)) {
							$result = $db->query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['username']."' AND `password` = '".$_COOKIE['password']."'");
						} else {
							$result = $db->query("SELECT * FROM `users` WHERE `username` = '".$_COOKIE['username']."' AND `password` = '".$_COOKIE['password']."'");
						}
					}	
					
					while($row = $result->fetch_assoc()) {
						$status = $row['status'];	
					}
					
					if($status == 0){
						header("Location: ".$CONF['url']."/index.php?a=contact");
					}elseif($status == 2){
						header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar");
					}

				}
		} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}
	$TMPL['years'] = generateDateForm(0, $date[0]);
	$TMPL['months'] = generateDateForm(1, $date[1]);
	$TMPL['days'] = generateDateForm(2, $date[2]);			
	
	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['Employee'].' - '.$settings['title'];
	
	$TMPL['ad'] = $settings['ad1'];
	
	$skin = new skin('register/employee');
	return $skin->make();
}

?>