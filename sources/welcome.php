<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if($settings['captcha']) {
		$TMPL['captcha'] = '<input type="text" name="captcha" placeholder="'.$LNG['captcha'].'" />
		<span class="welcome-captcha"><img src="'.$CONF['url'].'/includes/captcha.php" /></span>';
	}
	
	//if(isset($_POST['verification'])) {
		// Verification usage
		
	//}

	if(isset($_POST['register'])) {
		// Register usage
		$reg = new register();
		$reg->db = $db;
		$reg->url = $CONF['url'];
		$reg->username = $_POST['username'];
		$reg->password = $_POST['password'];
		$reg->email = $_POST['email'];
		$reg->enrollno = $_POST['enrollno'];
		$reg->captcha = $_POST['captcha'];
		$reg->captcha_on = $settings['captcha'];
		$reg->message_privacy = $settings['mprivacy'];
		$reg->like_notification = $settings['notificationl'];
		$reg->comment_notification = $settings['notificationc'];
		$reg->shared_notification = $settings['notifications'];
		$reg->chat_notification = $settings['notificationd'];
		$reg->friend_notification = $settings['notificationf'];
		$reg->verified = $settings['verified'];
		$reg->email_like = $settings['email_like'];
		$reg->email_comment = $settings['email_comment'];
		$reg->email_new_friend = $settings['email_new_friend'];
		$reg->sound_new_notification = $settings['sound_new_notification'];
		$reg->sound_new_chat = $settings['sound_new_chat'];
		
		$TMPL['registerMsg'] = $reg->process();

		if($TMPL['registerMsg'] == 1) {
			if($settings['mail']) {
				sendMail($_POST['email'], sprintf($LNG['welcome_mail'], $settings['title']), sprintf($LNG['user_created'], $settings['title'], $_POST['username'], $_POST['password'], $CONF['url'], $settings['title']), $CONF['email']);
			}
			header("Location: ".$CONF['url']."/index.php?a=feed");
		}
	}


	/*if(isset($_POST['contacts'])) {
		// Contacts usage

	}

	if(isset($_POST['employment'])) {
		// Employment usage

	}*/

	
	if(isset($_POST['login'])) {
		// Log-in usage
		$log = new logIn();
		$log->db = $db;
		$log->url = $CONF['url'];
		$log->username = $_POST['username'];
		$log->password = $_POST['password'];
		$log->remember = $_POST['remember'];
		
		$TMPL['loginMsg'] = notificationBox('transparent', $LNG['error'], $log->in(), 1);
	}
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		
		$verify = $loggedIn->verify();

		if($verify['username']) {
			header("Location: ".$CONF['url']."/index.php?a=feed");
		}
	}
	
	// Start displaying the home-page users
	
	$result = $db->query("SELECT * FROM `users` WHERE `image` != 'default.png' ORDER BY `idu` DESC LIMIT 10 ");
	while($row = $result->fetch_assoc()) {
		$users[] = $row;
	}
	
	$TMPL['rows'] = showUsers($users, $CONF['url']);
	
	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['welcome'].' - '.$settings['title'];
	
	$TMPL['ad'] = $settings['ad1'];
	
	$skin = new skin('welcome/content');
	return $skin->make();
}
?>