<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if($verify['username']) {
			
			$TMPL_old = $TMPL; $TMPL = array();
			$TMPL['url'] = $CONF['url'];
			if($_GET['b'] == 'security') {
				$skin = new skin('settings/security'); $page = '';
				
				// Create the class instance
				$updateUserSettings = new updateUserSettings();
				$updateUserSettings->db = $db;
				$updateUserSettings->id = $verify['idu'];
				
				if(!empty($_POST)) {	
					// Unset the verified value if exist, by unsetting it here and not in the class, I'm allowing the Admin to change this value
					unset($_POST['verified']);
					$TMPL['message'] = $updateUserSettings->query_array('users', $_POST);
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				$page .= $skin->make();
			} elseif($_GET['b'] == 'avatar') {
				$skin = new skin('settings/avatar'); $page = '';
				
				// Create the class instance
				$updateUserSettings = new updateUserSettings();
				$updateUserSettings->db = $db;
				$updateUserSettings->id = $verify['idu'];
				$TMPL['image'] = '<img src="'.$CONF['url'].'/thumb.php?src='.$verify['image'].'&t=a" width="80" height="80" />';
				$TMPL['cover'] = '<img src="'.$CONF['url'].'/thumb.php?src='.$verify['cover'].'&t=c&w=900&h=200" />';
				
				$maxsize = $settings['size'];

				if(isset($_FILES['avatarselect']['name'])) {
					foreach ($_FILES['avatarselect']['error'] as $key => $error) {
					$ext = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_EXTENSION);
					$size = $_FILES['avatarselect']['size'][$key];
					$extArray = explode(',', $settings['format']);
					
					// Get the image size
					list($width, $height) = getimagesize($_FILES['avatarselect']['tmp_name'][0]);
					$ratio = ($width / $height);
						if (in_array(strtolower($ext), $extArray) && $size < $maxsize && $size > 0 && !empty($width) && !empty($height)) {
							$rand = mt_rand();
							$tmp_name = $_FILES['avatarselect']['tmp_name'][$key];
							$name = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_FILENAME);
							$fullname = $_FILES['avatarselect']['name'][$key];
							$size = $_FILES['avatarselect']['size'][$key];
							$type = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_EXTENSION);
							$finalName = mt_rand().'_'.mt_rand().'_'.mt_rand().'.'.$db->real_escape_string($ext);
							
							// Move the file into the uploaded folder
							move_uploaded_file($tmp_name, 'uploads/avatars/'.$finalName);

							// Send the image name in array format to the function
							$image = array('image' => $finalName);
							$updateUserSettings->query_array('users', $image);
							
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=s");
						} elseif($_FILES['avatarselect']['name'][$key] == '') { 
							//Daca nu este selectata nici o fila.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=nf");
						} elseif($size > $maxsize || $size == 0) { 
							//Daca fila are dimensiunea mai mare decat dimensiunea admisa, sau egala cu 0.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=fs");
						} else { 
							//Daca formatul filei nu este un format admis.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=wf");
						}
					}
				}
				
				if(isset($_FILES['coverselect']['name'])) {
					foreach ($_FILES['coverselect']['error'] as $key => $error) {
					$ext = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_EXTENSION);
					$size = $_FILES['coverselect']['size'][$key];
					$extArray = explode(',', $settings['format']);
					
					// Get the image size
					list($width, $height) = getimagesize($_FILES['coverselect']['tmp_name'][0]);
					$ratio = ($width / $height);
						if (in_array(strtolower($ext), $extArray) && $size < $maxsize && $size > 0 && !empty($width) && !empty($height)) {
							$rand = mt_rand();
							$tmp_name = $_FILES['coverselect']['tmp_name'][$key];
							$name = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_FILENAME);
							$fullname = $_FILES['coverselect']['name'][$key];
							$size = $_FILES['coverselect']['size'][$key];
							$type = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_EXTENSION);
							$finalName = mt_rand().'_'.mt_rand().'_'.mt_rand().'.'.$db->real_escape_string($ext);
							
							// Move the file into the uploaded folder
							move_uploaded_file($tmp_name, 'uploads/covers/'.$finalName);

							// Send the image name in array format to the function
							$image = array('cover' => $finalName);
							$updateUserSettings->query_array('users', $image);
							
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=s");
						} elseif($_FILES['coverselect']['name'][$key] == '') { 
							//Daca nu este selectata nici o fila.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=nf");
						} elseif($size > $maxsize || $size == 0) { 
							//Daca fila are dimensiunea mai mare decat dimensiunea admisa, sau egala cu 0.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=fs");
						} else { 
							//Daca formatul filei nu este un format admis.
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=wf");
						}
					}
				}

				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['image_saved'], $LNG['profile_picture_saved']);
				} elseif($_GET['m'] == 'nf') {
					$TMPL['message'] = notificationBox('error', $LNG['error'], $LNG['no_file']);
				} elseif($_GET['m'] == 'fs') {
					$TMPL['message'] = notificationBox('error', $LNG['error'], sprintf($LNG['file_exceeded'], round($maxsize / 1048576, 2)));
				} elseif($_GET['m'] == 'wf') {
					$TMPL['message'] = notificationBox('error', $LNG['error'], sprintf($LNG['file_format'], $settings['format']));
				} elseif($_GET['m'] == 'de') {
					$TMPL['message'] = notificationBox('success', $LNG['image_removed'], $LNG['profile_picture_removed']);
				}
				$page .= $skin->make();
			} elseif($_GET['b'] == 'notifications') {
				$skin = new skin('settings/notifications'); $page = '';
				
				// Create the class instance
				$updateUserSettings = new updateUserSettings();
				$updateUserSettings->db = $db;
				$updateUserSettings->id = $verify['idu'];
				
				if(!empty($_POST)) {
					// Unset the verified value if exist, by unsetting it here and not in the class, I'm allowing the Admin to change this value
					unset($_POST['verified']);
					$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				if($userSettings['notificationl'] == '0') {
					$TMPL['loff'] = 'selected="selected"';
				} else {
					$TMPL['lon'] = 'selected="selected"';
				}
				
				if($userSettings['notificationc'] == '0') {
					$TMPL['coff'] = 'selected="selected"';
				} else {
					$TMPL['con'] = 'selected="selected"';
				}
				
				if($userSettings['notifications'] == '0') {
					$TMPL['soff'] = 'selected="selected"';
				} else {
					$TMPL['son'] = 'selected="selected"';
				}
				
				if($userSettings['notificationd'] == '0') {
					$TMPL['doff'] = 'selected="selected"';
				} else {
					$TMPL['don'] = 'selected="selected"';
				}
				
				if($userSettings['notificationf'] == '0') {
					$TMPL['foff'] = 'selected="selected"';
				} else {
					$TMPL['fon'] = 'selected="selected"';
				}
				
				if($userSettings['sound_new_notification'] == '0') {
					$TMPL['snnoff'] = 'selected="selected"';
				} else {
					$TMPL['snnon'] = 'selected="selected"';
				}
				
				if($userSettings['sound_new_chat'] == '0') {
					$TMPL['sncoff'] = 'selected="selected"';
				} else {
					$TMPL['sncon'] = 'selected="selected"';
				}
				
				if($userSettings['email_comment'] == '0') {
					$TMPL['ecoff'] = 'selected="selected"';
				} else {
					$TMPL['econ'] = 'selected="selected"';
				}
				
				if($userSettings['email_like'] == '0') {
					$TMPL['eloff'] = 'selected="selected"';
				} else {
					$TMPL['elon'] = 'selected="selected"';
				}
				
				if($userSettings['email_new_friend'] == '0') {
					$TMPL['enfoff'] = 'selected="selected"';
				} else {
					$TMPL['enfon'] = 'selected="selected"';
				}
				
				$page .= $skin->make();
			} else {
				$skin = new skin('settings/general'); $page = '';
				
				// Create the class instance
				$updateUserSettings = new updateUserSettings();
				$updateUserSettings->db = $db;
				$updateUserSettings->id = $verify['idu'];
				
				if(!empty($_POST)) {
					// Unset the verified value if exist, by unsetting it here and not in the class, I'm allowing the Admin to change this value
					unset($_POST['verified']);
					$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				$date = explode('-', $userSettings['born']);
				
				$TMPL['years'] = generateDateForm(0, $date[0]);
				$TMPL['months'] = generateDateForm(1, $date[1]);
				$TMPL['days'] = generateDateForm(2, $date[2]);
				
				$TMPL['currentFirstName'] = $userSettings['first_name']; $TMPL['currentLastName'] = $userSettings['last_name']; $TMPL['currentEmail'] = $userSettings['email']; $TMPL['currentLocation'] = $userSettings['location']; $TMPL['currentWebsite'] = $userSettings['website']; $TMPL['currentBio'] = $userSettings['bio']; $TMPL['currentFacebook'] = $userSettings['facebook']; $TMPL['currentTwitter'] = $userSettings['twitter'];  $TMPL['currentGplus'] = $userSettings['gplus'];
				$TMPL['currentEnrollno'] = $userSettings['enrollno'];
				$join = explode('-', $userSettings['join']);
				
				$TMPL['jyear'] = generateDateForm(0, $join[0]);
				$TMPL['tyear'] = generateDateForm(0, $join[1]);
			
			
				if($userSettings['private'] == '1') {
					$TMPL['on'] = 'selected="selected"';
				} elseif($userSettings['private'] == '2') {
					$TMPL['semi'] = 'selected="selected"';
				} else {
					$TMPL['off'] = 'selected="selected"';
				}
				
				if($userSettings['privacy'] == '0') {
					$TMPL['pon'] = 'selected="selected"';
				} else {
					$TMPL['poff'] = 'selected="selected"';
				}
				
				if($userSettings['offline'] == '1') {
					$TMPL['con'] = 'selected="selected"';
				} else {
					$TMPL['coff'] = 'selected="selected"';
				}
				
				if($userSettings['gender'] == '0') {
					$TMPL['ngender'] = 'selected="selected"';
				} elseif($userSettings['gender'] == '1') {
					$TMPL['mgender'] = 'selected="selected"';
				} else {
					$TMPL['fgender'] = 'selected="selected"';
				}

				if($userSettings['course'] == '1') {
					$TMPL['btech'] = 'selected="selected"';
				} elseif($userSettings['course'] == '2') {
					$TMPL['mca'] = 'selected="selected"';
				} elseif($userSettings['course'] == '3') {
					$TMPL['mba'] = 'selected="selected"';
				} elseif($userSettings['course'] == '4') {
					$TMPL['bca'] = 'selected="selected"';
				}else{
					$TMPL['none'] = 'selected="selected"';
				}


				if($userSettings['branch'] == '1') {
					$TMPL['ece'] = 'selected="selected"';
				} elseif($userSettings['branch'] == '2') {
					$TMPL['cse'] = 'selected="selected"';
				} elseif($userSettings['branch'] == '3') {
					$TMPL['mae'] = 'selected="selected"';
				} elseif($userSettings['branch'] == '4') {
					$TMPL['eee'] = 'selected="selected"';
				} elseif($userSettings['branch'] == '5') {
					$TMPL['it'] = 'selected="selected"';
				} elseif($userSettings['branch'] == '6') {
					$TMPL['ce'] = 'selected="selected"';
				}else{
					$TMPL['none'] = 'selected="selected"';				
				}
				
				$page .= $skin->make();
			}
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['settings'] = $page;
			
		} else {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
	} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}
	
	
	// Bold the current link
	if(isset($_GET['b'])) {
		$LNG["user_menu_{$_GET['b']}"] = '<strong>'.$LNG["user_menu_{$_GET['b']}"].'</strong>';
		$TMPL['welcome'] = '<strong>'.$LNG["user_ttl_{$_GET['b']}"].'</strong>';
	} else {
		$LNG["user_menu_general"] = '<strong>'.$LNG["user_menu_general"].'</strong>';
		$TMPL['welcome'] = '<strong>'.$LNG["user_ttl_general"].'</strong>';
	}
	
	$TMPL['user_menu'] = '
	<a href="'.$CONF['url'].'/index.php?a=settings">'.$LNG['user_menu_general'].'</a> 
	<a href="'.$CONF['url'].'/index.php?a=settings&b=avatar">'.$LNG['user_menu_avatar'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=settings&b=notifications">'.$LNG['user_menu_notifications'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=settings&b=security">'.$LNG['user_menu_security'].'</a>';
	
	$TMPL['image'] = '<img src="'.$CONF['url'].'/thumb.php?src='.$verify['image'].'&t=a" width="80" height="80" />';	
				
	$TMPL['title'] = $LNG['title_settings'].' - '.$settings['title'];
	
	$skin = new skin('settings/content');
	return $skin->make();
}
?>