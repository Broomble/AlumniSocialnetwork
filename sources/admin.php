<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;
	
	if(isset($_POST['login'])) {
		$logInAdmin = new logInAdmin();
		$logInAdmin->db = $db;
		$logInAdmin->url = $CONF['url'];
		$logInAdmin->username = $_POST['username'];
		$logInAdmin->password = $_POST['password'];
		
		$TMPL['message'] = $logInAdmin->in();
	}
	if(isset($_SESSION['usernameAdmin']) && isset($_SESSION['passwordAdmin'])) {
		$loggedInAdmin = new loggedInAdmin();
		$loggedInAdmin->db = $db;
		$loggedInAdmin->url = $CONF['url'];
		$loggedInAdmin->username = $_SESSION['usernameAdmin'];
		$loggedInAdmin->password = $_SESSION['passwordAdmin'];
		$loggedIn = $loggedInAdmin->verify();

		if($loggedIn['username']) {
			// Set the content to true, change the $skin to content
			$content = true;
			
			$TMPL_old = $TMPL; $TMPL = array();
			$TMPL['url'] = $CONF['url']; 
			
			if($_GET['b'] == 'security') { // Security Admin Tab
				$skin = new skin('admin/security'); $page = '';

				if(!empty($_POST)) {
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('admin', $_POST);
					
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=security&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=security&m=i");
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['password_changed'], $LNG['password_success_changed']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('info', $LNG['nothing_changed'], $LNG['password_not_changed']);
				}
			} elseif($_GET['b'] == 'stats') { // Security Admin Tab
				$skin = new skin('admin/stats'); $page = '';

				list($TMPL['messages_total'], $TMPL['messages_public'], $TMPL['messages_private'], $TMPL['comments_total'], $TMPL['users_today'], $TMPL['users_this_month'], $TMPL['users_last_30'], $TMPL['users_total'], $TMPL['total_reports'], $TMPL['pending_reports'], $TMPL['safe_reports'], $TMPL['deleted_reports'], $TMPL['total_message_reports'], $TMPL['pending_message_reports'], $TMPL['safe_message_reports'], $TMPL['deleted_message_reports'], $TMPL['total_comment_reports'], $TMPL['pending_comment_reports'], $TMPL['safe_comment_reports'], $TMPL['deleted_comment_reports'], $TMPL['total_likes'], $TMPL['likes_today'], $TMPL['likes_this_month'], $TMPL['likes_last_30']) = users_stats($db);
			} elseif($_GET['b'] == 'themes') {
				$skin = new skin('admin/themes'); $page = '';
				$updateSettings = new updateSettings();
				$updateSettings->db = $db;
				
				$themes = $updateSettings->getThemes();
				
				$TMPL['themes_list'] = $themes[0];
				
				if(isset($_GET['theme'])) {
					// If theme is in array
					if(in_array($_GET['theme'], $themes[1])) {
						$updated = $updateSettings->query_array('settings', array('theme' => $_GET['theme']));
						
						if($updated == 1) {
							header("Location: ".$CONF['url']."/index.php?a=admin&b=themes&m=s");
						} else {
							header("Location: ".$CONF['url']."/index.php?a=admin&b=themes&m=i");
						}
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['theme_changed'], $LNG['theme_success_changed']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('error', $LNG['nothing_changed'], $LNG['theme_not_changed']);
				}
				
			} elseif($_GET['b'] == 'manage_reports') {
				$skin = new skin('admin/manage_reports'); $page = '';
				
				$manageReports = new manageReports();
				$manageReports->db = $db;
				$manageReports->url = $CONF['url'];
				$manageReports->per_page = $settings['rperpage'];
				
				// Save the array returned into a list
				$TMPL['reports'] = $manageReports->getReports(0);
				
			} elseif($_GET['b'] == 'users_settings') {
				$skin = new skin('admin/users_settings'); $page = '';
					
				if($settings['mprivacy'] == '1') {
					$TMPL['pon'] = 'selected="selected"';
				} else {
					$TMPL['poff'] = 'selected="selected"';
				}
				
				if($settings['notificationl'] == '0') {
					$TMPL['loff'] = 'selected="selected"';
				} else {
					$TMPL['lon'] = 'selected="selected"';
				}
				
				if($settings['notificationc'] == '0') {
					$TMPL['coff'] = 'selected="selected"';
				} else {
					$TMPL['con'] = 'selected="selected"';
				}
				
				if($settings['sound_new_notification'] == '0') {
					$TMPL['snnoff'] = 'selected="selected"';
				} else {
					$TMPL['snnon'] = 'selected="selected"';
				}
				
				if($settings['sound_new_chat'] == '0') {
					$TMPL['sncoff'] = 'selected="selected"';
				} else {
					$TMPL['sncon'] = 'selected="selected"';
				}
				
				if($settings['email_comment'] == '0') {
					$TMPL['ecoff'] = 'selected="selected"';
				} else {
					$TMPL['econ'] = 'selected="selected"';
				}
				
				if($settings['email_like'] == '0') {
					$TMPL['eloff'] = 'selected="selected"';
				} else {
					$TMPL['elon'] = 'selected="selected"';
				}
				
				if($settings['email_new_friend'] == '0') {
					$TMPL['enfoff'] = 'selected="selected"';
				} else {
					$TMPL['enfon'] = 'selected="selected"';
				}
				
				if($settings['notifications'] == '0') {
					$TMPL['soff'] = 'selected="selected"';
				} else {
					$TMPL['son'] = 'selected="selected"';
				}
				
				if($settings['notificationd'] == '0') {
					$TMPL['doff'] = 'selected="selected"';
				} else {
					$TMPL['don'] = 'selected="selected"';
				}
				
				if($settings['notificationf'] == '0') {
					$TMPL['foff'] = 'selected="selected"';
				} else {
					$TMPL['fon'] = 'selected="selected"';
				}
				
				if($settings['ilimit'] == '1') {
					$TMPL['ione'] = 'selected="selected"';
				} elseif($settings['ilimit'] == '3') {
					$TMPL['ithree'] = 'selected="selected"';
				} elseif($settings['ilimit'] == '6') {
					$TMPL['isix'] = 'selected="selected"';
				} else {
					$TMPL['inine'] = 'selected="selected"';
				}
				
				if($settings['ronline'] == '5') {
					$TMPL['uone'] = 'selected="selected"';
				} elseif($settings['ronline'] == '10') {
					$TMPL['utwo'] = 'selected="selected"';
				} else {
					$TMPL['uthree'] = 'selected="selected"';
				}
				
				if($settings['nperwidget'] == '5') {
					$TMPL['none'] = 'selected="selected"';
				} elseif($settings['nperwidget'] == '10') {
					$TMPL['ntwo'] = 'selected="selected"';
				} elseif($settings['nperwidget'] == '20') {
					$TMPL['nthree'] = 'selected="selected"';
				} else {
					$TMPL['nfour'] = 'selected="selected"';
				}
				
				if($settings['lperpost'] == '3') {
					$TMPL['likesone'] = 'selected="selected"';
				} elseif($settings['lperpost'] == '5') {
					$TMPL['likestwo'] = 'selected="selected"';
				} else {
					$TMPL['likesnone'] = 'selected="selected"';
				}
								
				if($settings['verified'] == 0) {
					$TMPL['off_v'] = 'selected="selected"';
				} else {
					$TMPL['on_v'] = 'selected="selected"';
				}

				if(!empty($_POST)) {
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=users_settings&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=users_settings&m=i");
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['settings_saved'], $LNG['general_settings_saved']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('info', $LNG['nothing_saved'], $LNG['general_settings_unaffected']);
				}
			} elseif($_GET['b'] == 'users') {
				$manageUsers = new manageUsers();
				$manageUsers->db = $db;
				$manageUsers->url = $CONF['url'];
				$manageUsers->per_page = $settings['uperpage'];
				
				if(!isset($_GET['e'])) {
				$skin = new skin('admin/manage_users'); $page = '';
				
				// Save the array returned into a list
				$TMPL['users'] = $manageUsers->getUsers(0);
				
				} else {
					$skin = new skin('admin/edit_users'); $page = '';
					$getUser = $manageUsers->getUser($_GET['e'], $_GET['ef']);
					if(!$getUser) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=users&m=un");
					}
					// Create the class instance
					$updateUserSettings = new updateUserSettings();
					$updateUserSettings->db = $db;
					$updateUserSettings->id = $getUser['idu'];
					
					if(!empty($_POST)) {
						$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
					}
					
					$userSettings = $updateUserSettings->getSettings();
					
					$date = explode('-', $userSettings['born']);
					
					$TMPL['years'] = generateDateForm(0, $date[0]);
					$TMPL['months'] = generateDateForm(1, $date[1]);
					$TMPL['days'] = generateDateForm(2, $date[2]);
					
					$TMPL['username'] = $userSettings['username']; $TMPL['idu'] = $userSettings['idu']; $TMPL['currentFirstName'] = $userSettings['first_name']; $TMPL['currentLastName'] = $userSettings['last_name']; $TMPL['currentEmail'] = $userSettings['email']; $TMPL['currentLocation'] = $userSettings['location']; $TMPL['currentWebsite'] = $userSettings['website']; $TMPL['currentBio'] = $userSettings['bio']; $TMPL['currentFacebook'] = $userSettings['facebook']; $TMPL['currentTwitter'] = $userSettings['twitter'];  $TMPL['currentGplus'] = $userSettings['gplus'];
					
					if($userSettings['verified'] == 0) {
						$TMPL['off_v'] = 'selected="selected"';
					} else {
						$TMPL['on_v'] = 'selected="selected"';
					}
				}
				// If GET delete is set, delete the user
				if($_GET['delete']) {
					$manageUsers->deleteUser($_GET['delete']);
					header("Location: ".$CONF['url']."/index.php?a=admin&b=users&m=".$_GET['delete']);
				}
				
				if($_GET['m'] == 'un') {
					$TMPL['message'] = notificationBox('error', $LNG['error'], $LNG['user_not_exist']);
				} elseif(!empty($_GET['m'])) {
					$TMPL['message'] = notificationBox('success', $LNG['user_deleted'], sprintf($LNG['user_has_been_deleted'], $_GET['m']));
				}
			} elseif($_GET['b'] == 'manage_ads') {
				$skin = new skin('admin/manage_ads'); $page = '';
				
				$TMPL['ad1'] = $settings['ad1']; $TMPL['ad2'] = $settings['ad2']; $TMPL['ad3'] = $settings['ad3']; $TMPL['ad4'] = $settings['ad4']; $TMPL['ad5'] = $settings['ad5']; $TMPL['ad6'] = $settings['ad6']; $TMPL['ad7'] = $settings['ad7'];
				if(!empty($_POST)) {
					// Unset the submit array element
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=manage_ads&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=manage_ads&m=i");
					}
				}
			} else {
				$skin = new skin('admin/general'); $page = '';
				
				$TMPL['currentTitle'] = $settings['title']; $TMPL['currentFormat'] = $settings['format']; $TMPL['currentCensor'] = $settings['censor']; $TMPL['currentFormatMsg'] = $settings['formatmsg'];
						
				if($settings['captcha'] == '1') {
					$TMPL['on'] = 'selected="selected"';
				} else {
					$TMPL['off'] = 'selected="selected"';
				}
				
				if($settings['smiles'] == '1') {
					$TMPL['son'] = 'selected="selected"';
				} else {
					$TMPL['soff'] = 'selected="selected"';
				}
				
				if($settings['time'] == '0') {
					$TMPL['one'] = 'selected="selected"';
				} elseif($settings['time'] == '1') {
					$TMPL['two'] = 'selected="selected"';
				} elseif($settings['time'] == '2') {
					$TMPL['three'] = 'selected="selected"';
				} else {
					$TMPL['four'] = 'selected="selected"';
				}
				
				if($settings['conline'] == '60') {
					$TMPL['conone'] = 'selected="selected"';
				} elseif($settings['conline'] == '300') {
					$TMPL['contwo'] = 'selected="selected"';
				} else {
					$TMPL['conthree'] = 'selected="selected"';
				}
				
				if($settings['perpage'] == '10') {
					$TMPL['ten'] = 'selected="selected"';
				} elseif($settings['perpage'] == '20') {
					$TMPL['twenty'] = 'selected="selected"';
				} elseif($settings['perpage'] == '25') {
					$TMPL['twentyfive'] = 'selected="selected"';
				} else {
					$TMPL['fifty'] = 'selected="selected"';
				}
				
				if($settings['nperpage'] == '10') {
					$TMPL['nten'] = 'selected="selected"';
				} elseif($settings['nperpage'] == '25') {
					$TMPL['ntwentyfive'] = 'selected="selected"';
				} elseif($settings['nperpage'] == '50') {
					$TMPL['nfifty'] = 'selected="selected"';
				} else {
					$TMPL['nonehundred'] = 'selected="selected"';
				}
				
				if($settings['mperpage'] == '5') {
					$TMPL['mone'] = 'selected="selected"';
				} elseif($settings['mperpage'] == '10') {
					$TMPL['mtwo'] = 'selected="selected"';
				} elseif($settings['mperpage'] == '25') {
					$TMPL['mthree'] = 'selected="selected"';
				} else {
					$TMPL['mfour'] = 'selected="selected"';
				}
				
				if($settings['climit'] == '500') {
					$TMPL['cone'] = 'selected="selected"';
				} elseif($settings['climit'] == '1000') {
					$TMPL['ctwo'] = 'selected="selected"';
				} elseif($settings['climit'] == '2500') {
					$TMPL['cthree'] = 'selected="selected"';
				} else {
					$TMPL['cfour'] = 'selected="selected"';
				}
				
				if($settings['chatr'] == '1') {
					$TMPL['crone'] = 'selected="selected"';
				} elseif($settings['chatr'] == '2') {
					$TMPL['crtwo'] = 'selected="selected"';
				} elseif($settings['chatr'] == '3') {
					$TMPL['crthree'] = 'selected="selected"';
				} elseif($settings['chatr'] == '5') {
					$TMPL['crfive'] = 'selected="selected"';
				} elseif($settings['chatr'] == '10') {
					$TMPL['crten'] = 'selected="selected"';
				} elseif($settings['chatr'] == '30') {
					$TMPL['crthirty'] = 'selected="selected"';
				} else {
					$TMPL['croff'] = 'selected="selected"';
				}
				
				if($settings['qperpage'] == '10') {
					$TMPL['qten'] = 'selected="selected"';
				} elseif($settings['qperpage'] == '25') {
					$TMPL['qtwentyfive'] = 'selected="selected"';
				} elseif($settings['qperpage'] == '50') {
					$TMPL['qfifty'] = 'selected="selected"';
				} else {
					$TMPL['qonehundred'] = 'selected="selected"';
				}
				
				if($settings['cperpage'] == '3') {
					$TMPL['ctrei'] = 'selected="selected"';
				} elseif($settings['cperpage'] == '5') {
					$TMPL['ccinci'] = 'selected="selected"';
				} elseif($settings['cperpage'] == '10') {
					$TMPL['czece'] = 'selected="selected"';
				} else {
					$TMPL['ccinspe'] = 'selected="selected"';
				}
				
				if($settings['message'] == '500') {
					$TMPL['unu'] = 'selected="selected"';
				} elseif($settings['message'] == '1000') {
					$TMPL['doi'] = 'selected="selected"';
				} elseif($settings['message'] == '2500') {
					$TMPL['trei'] = 'selected="selected"';
				} else {
					$TMPL['patru'] = 'selected="selected"';
				}
				
				if($settings['size'] == '1048576') {
					$TMPL['onemb'] = 'selected="selected"';
				} elseif($settings['size'] == '2097152') {
					$TMPL['twomb'] = 'selected="selected"';
				} elseif($settings['size'] == '3145728') {
					$TMPL['threemb'] = 'selected="selected"';
				} else {
					$TMPL['tenmb'] = 'selected="selected"';
				}
				
				if($settings['mail'] == '1') {
					$TMPL['mailon'] = 'selected="selected"';
				} else {
					$TMPL['mailoff'] = 'selected="selected"';
				}
				
				if($settings['intervalm'] == '10000') {
					$TMPL['intone'] = 'selected="selected"';
				} elseif($settings['intervalm'] == '30000') {
					$TMPL['inttwo'] = 'selected="selected"';
				} elseif($settings['intervalm'] == '60000') {
					$TMPL['intthree'] = 'selected="selected"';
				}  elseif($settings['intervalm'] == '120000') {
					$TMPL['intfour'] = 'selected="selected"';
				} elseif($settings['intervalm'] == '300000') {
					$TMPL['intfive'] = 'selected="selected"';
				} elseif($settings['intervalm'] == '600000') {
					$TMPL['intsix'] = 'selected="selected"';
				} else {
					$TMPL['intseven'] = 'selected="selected"';
				}
				
				if($settings['intervaln'] == '10000') {
					$TMPL['intonen'] = 'selected="selected"';
				} elseif($settings['intervaln'] == '30000') {
					$TMPL['inttwon'] = 'selected="selected"';
				} elseif($settings['intervaln'] == '60000') {
					$TMPL['intthreen'] = 'selected="selected"';
				}  elseif($settings['intervaln'] == '120000') {
					$TMPL['intfourn'] = 'selected="selected"';
				} elseif($settings['intervaln'] == '300000') {
					$TMPL['intfiven'] = 'selected="selected"';
				} elseif($settings['intervaln'] == '600000') {
					$TMPL['intsixn'] = 'selected="selected"';
				} else {
					$TMPL['intsevenn'] = 'selected="selected"';
				}
				
				if($settings['sizemsg'] == '1048576') {
					$TMPL['onembMsg'] = 'selected="selected"';
				} elseif($settings['sizemsg'] == '2097152') {
					$TMPL['twombMsg'] = 'selected="selected"';
				} elseif($settings['sizemsg'] == '3145728') {
					$TMPL['threembMsg'] = 'selected="selected"';
				} else {
					$TMPL['tenmbMsg'] = 'selected="selected"';
				}
				
				if($settings['uperpage'] == '10') {
					$TMPL['upone'] = 'selected="selected"';
				} elseif($settings['uperpage'] == '20') {
					$TMPL['uptwo'] = 'selected="selected"';
				} elseif($settings['uperpage'] == '50') {
					$TMPL['upthree'] = 'selected="selected"';
				} else {
					$TMPL['upfour'] = 'selected="selected"';
				}
				
				if($settings['rperpage'] == '10') {
					$TMPL['rpone'] = 'selected="selected"';
				} elseif($settings['rperpage'] == '20') {
					$TMPL['rptwo'] = 'selected="selected"';
				} elseif($settings['rperpage'] == '50') {
					$TMPL['rpthree'] = 'selected="selected"';
				} else {
					$TMPL['rpfour'] = 'selected="selected"';
				}
				
				if($settings['sperpage'] == '10') {
					$TMPL['sone'] = 'selected="selected"';
				} elseif($settings['sperpage'] == '20') {
					$TMPL['stwo'] = 'selected="selected"';
				} elseif($settings['sperpage'] == '25') {
					$TMPL['sthree'] = 'selected="selected"';
				} else {
					$TMPL['sfour'] = 'selected="selected"';
				}
				
				if(isset($_POST['submit'])) {
					// Unset the submit array element
					unset($_POST['submit']);
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&m=i");
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['settings_saved'], $LNG['general_settings_saved']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('info', $LNG['nothing_saved'], $LNG['general_settings_unaffected']);
				}
			}
			
			$page .= $skin->make();
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['settings'] = $page;
			
			if(isset($_GET['logout']) == 1) {
				$loggedInAdmin->logOut();
				header("Location: ".$CONF['url']."/index.php?a=admin");
			}
			
		} else {
			// Set the content to false, change the $skin to log-in.
			$content = false;
		}
	}
	
	// Bold the current link
	if(isset($_GET['b'])) {
		$LNG["admin_menu_{$_GET['b']}"] = '<strong>'.$LNG["admin_menu_{$_GET['b']}"].'</strong>';
		$TMPL['welcome'] = '<strong>'.$LNG["admin_ttl_{$_GET['b']}"].'</strong>';
	} else {
		$LNG["admin_menu_general"] = '<strong>'.$LNG["admin_menu_general"].'</strong>';
		$TMPL['welcome'] = '<strong>'.$LNG["admin_ttl_general"].'</strong>';
	}
	
	$TMPL['admin_menu'] = '
	<a href="'.$CONF['url'].'/index.php?a=admin">'.$LNG['admin_menu_general'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=users_settings">'.$LNG['admin_menu_users_settings'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=themes">'.$LNG['admin_menu_themes'].'</a> 
	<a href="'.$CONF['url'].'/index.php?a=admin&b=stats">'.$LNG['admin_menu_stats'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=security">'.$LNG['admin_menu_security'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=users">'.$LNG['admin_menu_users'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=manage_reports">'.$LNG['admin_menu_manage_reports'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&b=manage_ads">'.$LNG['admin_menu_manage_ads'].'</a>
	<a href="'.$CONF['url'].'/index.php?a=admin&logout=1">'.$LNG['admin_menu_logout'].'</a>';
	
	$TMPL['url'] = $CONF['url'];
	$TMPL['localurl'] = $CONF['url'];
	$TMPL['titleh'] = $settings['title'];
	$TMPL['title'] = $LNG['title_admin'].' - '.$settings['title'];
	if($content)
		$skin = new skin('admin/content');
	else
		$skin = new skin('admin/login');
	return $skin->make();
}
?>