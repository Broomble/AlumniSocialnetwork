<?php

function getSettings() {
	$querySettings = "SELECT * from `settings`";
	return $querySettings;
}
function menu($user) {
	global $CONF, $settings, $LNG;

	if($user !== false) {
		// If the result is not 0 (int) then show the menu
		return '
		<a href="'.$CONF['url'].'/index.php?a=feed&logout=1"><div class="menu_btn tooltip" title="'.$LNG['log_out'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/logout.png" /></div></a>
		<a onclick="showNotification(\'\', \'1\')"><div class="menu_btn tooltip" id="notifications_btn" title="'.$LNG['title_notifications'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/notification.png" id="notifications_img" /></div></a>
		<a href="'.$CONF['url'].'/index.php?a=messages" id="messages_url"><div class="menu_btn tooltip" id="messages_btn" title="'.$LNG['title_messages'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/message.png" /></div></a>
		<a href="'.$CONF['url'].'/index.php?a=timeline"><div class="menu_btn tooltip" title="'.$LNG['title_timeline'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/timeline.png" /></div></a>
		<a href="'.$CONF['url'].'/index.php?a=feed"><div class="menu_btn tooltip" title="'.$LNG['title_feed'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/feed.png" /></div></a>
		<a href="'.$CONF['url'].'/index.php?a=profile&u='.$user['username'].'"><div class="menu"><div class="menu_img"><img src="'.$CONF['url'].'/thumb.php?src='.$user['image'].'&t=a&w=50&h=50" /></div><div class="menu_name"><strong>'.realName($user['username'], $user['first_name'], $user['last_name']).'</strong></div></div></a>
		<div class="notification-container">
			<div class="notification-content">
				<div class="notification-inner">
					<span id="global_page_url"><a href="'.$CONF['url'].'/index.php?a=notifications"><strong>'.$LNG['view_all_notifications'].'</strong></a></span>
					<span id="chat_page_url"><a href="'.$CONF['url'].'/index.php?a=notifications&filter=chats"><strong>'.$LNG['view_chat_notifications'].'</strong></a></span>
					<a onclick="showNotification(\'close\')" title="'.$LNG['close_notifications'].'"><div class="delete_btn"></div></a>
				</div>
				<div id="notifications-content"></div>
				<div class="notification-row"><div class="notification-padding"><a href="'.$CONF['url'].'/index.php?a=settings&b=notifications">'.$LNG['notifications_settings'].'</a></div></div>
			</div>
		</div>
		<script type="text/javascript">
		function checkNewNotifications(x) {
			// Retrieve the current notification values
			xy = $("#notifications_btn .notifications-number").html();
			xz = $("#messages_btn .notifications-number").html();
			
			// If there are not current values, reset them to 0
			if(!xy) {
				xy = 0;
			}
			if(!xz) {
				xz = 0;
			}
			$.ajax({
				type: "POST",
				url: "'.$CONF['url'].'/requests/check_notifications.php",
				data: "for=1",
				success: function(html) {
					// If the response does not include "No notifications" and is not empty show the notification
					if(html.indexOf("'.$LNG['no_notifications'].'") == -1 && html !== "" && html !== "0") {
						result = jQuery.parseJSON(html);
						if(result.response.global > 0) {
							$("#notifications_btn").html(getNotificationImage()+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.global+"</span></span>");
						} else {
							$("#notifications_btn").html(getNotificationImage());
						}
						if(result.response.messages > 0) {
							$("#messages_btn").html(getMessagesImageUrl(1)+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.messages+"</span></span>");
							$("#messages_url").attr("onclick", "showNotification(\'\', \'2\')");
							$("#messages_url").removeAttr("href");
						} else {
							$("#messages_btn").html(getMessagesImageUrl(1));
							$("#messages_url").removeAttr("onclick");
							$("#messages_url").attr("href", getMessagesImageUrl());
						}
						
						// If the new value is higher than the current one, and the current one is not equal to 0

						if(result.response.global > xy && xy != 0 || result.response.global == 1 && xy == 0) {
							checkAlert();
						} else if(result.response.messages > xz && xz != 0 || result.response.messages == 1 && xz == 0) {
							checkAlert();
						}
					}
					stopNotifications = setTimeout(checkNewNotifications, '.$settings['intervaln'].');
			   }
			});
		}
		checkNewNotifications();
		
		function checkAlert() {
			if(!document.hasFocus()) {						
				// If the current document title doesn\'t have an alert, add one
				if(document.title.indexOf("(!)") == -1) {
					document.title = "(!) " + document.title;
				}
				notificationTitle(2);
			}
		}
		function getNotificationImage() {
			return "<img src=\"'.$CONF['url'].'/'.$CONF['theme_url'].'/images/notification.png\" />";
		}
		function getMessagesImageUrl(x) {
			if(x) {
				return "<img src=\"'.$CONF['url'].'/'.$CONF['theme_url'].'/images/message.png\" />";
			} else {
				return "'.$CONF['url'].'/index.php?a=messages";
			}
		}
		
		</script>'.audioContainer('Notification', $user['sound_new_notification']);
	} else {
		// Else show the LogIn Register button
		return '
		<a href="'.$CONF['url'].'/index.php?a=welcome"><div class="menu_btn tooltip" data-tip="Login" title="'.$LNG['register'].'"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/register.png" /></div></a>
		<a href="'.$CONF['url'].'/index.php?a=verify"><div class="menu_visitor"><strong>Sign Up</strong></div></a>
		<a href="'.$CONF['url'].'/index.php?a=directory"><div class="menu_visitor"><strong>Directory</strong></div></a>';
	}
}
function notificationBox($type, $title, $message, $z = null) {
	if($z) {
		$z = ' box-transparent';
		$y = ' close-transparent';
	}
	return '<div class="divider"></div>
			<div class="notification-box'.$z.' notification-box-'.$type.'">
			<h5>'.$title.'</h5>
			<p>'.$message.'</p>
			<a href="#" class="notification-close notification-close-'.$type.$y.'">x</a>
			</div>';
}

require_once('classes/register.php');
require_once('classes/verify.php');
require_once('classes/contact.php');
require_once('classes/employee.php');
require_once('classes/logIn.php');
require_once('classes/loggedIn.php');
require_once('classes/logInAdmin.php');
require_once('classes/loggedInAdmin.php');
require_once('classes/updateSettings.php');
require_once('classes/updateUserSettings.php');
require_once('classes/recover.php');
require_once('classes/manageUsers.php');
require_once('classes/manageReports.php');
require_once('classes/feed.php');

function nl2clean($text) {
	// Replace two or more new lines with two new rows [blank space between them]
	return preg_replace("/(\r?\n){2,}/", "\n\n", $text);
}
function sendMail($to, $subject, $message, $from) {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from.'' . "\r\n" .
		'Reply-To: '.$from . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		return @mail($to, $subject, $message, $headers);

}
function strip_tags_array($value) {
	return strip_tags($value);
}
function users_stats($db) {
	$query = "SELECT 
	(SELECT COUNT(id) FROM messages) AS messages_total,
	(SELECT COUNT(id) FROM messages WHERE public = '1') AS messages_public,
	(SELECT COUNT(id) FROM messages WHERE public = '0') as messages_private,
	(SELECT COUNT(id) FROM comments) as comments_total,
	(SELECT count(idu) FROM users WHERE CURDATE() = `date`) as users_today,
	(SELECT count(idu) FROM users WHERE MONTH(CURDATE()) = MONTH(`date`) AND YEAR(CURDATE()) = YEAR(`date`)) as users_this_month,
	(SELECT count(idu) FROM users WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= `date`) as users_last_30,
	(SELECT count(idu) FROM users) as users_total,
	(SELECT count(id) FROM `reports`) as total_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 0) as pending_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 1) as safe_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 2) as deleted_reports,
	(SELECT count(id) FROM `reports` WHERE `type` = 1) as total_message_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 0 AND `type` = 1) as pending_message_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 1 AND `type` = 1) as safe_message_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 2 AND `type` = 1) as deleted_message_reports,
	(SELECT count(id) FROM `reports` WHERE `type` = 0) as total_comment_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 0 AND `type` = 0) as pending_comment_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 1 AND `type` = 0) as safe_comment_reports,
	(SELECT count(id) FROM `reports` WHERE `state` = 2 AND `type` = 0) as deleted_comment_reports,
	(SELECT count(id) FROM `likes`) as total_likes,
	(SELECT count(id) FROM `likes` WHERE CURDATE() = date(`time`)) as likes_today,
	(SELECT count(id) FROM `likes` WHERE MONTH(CURDATE()) = MONTH(date(`time`)) AND YEAR(CURDATE()) = YEAR(date(`time`))) as likes_this_month,
	(SELECT count(id) FROM `likes` WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= date(`time`)) as likes_last_30";
	$result = $db->query($query);
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$stats = array();
	foreach($rows[0] as $value) {
		$stats[] = $value;
	}
	return $stats;
}
function fsize($bytes) { #Determine the size of the file, and print a human readable value
   if ($bytes < 1024) return $bytes.' B';
   elseif ($bytes < 1048576) return round($bytes / 1024, 2).' KiB';
   elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).' MiB';
   elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).' GiB';
   else return round($bytes / 1099511627776, 2).' TiB';
}
function audioContainer($type, $sound) {
	global $CONF;
	if($sound) {
		$output = '<audio id="soundNew'.$type.'"><source src="'.$CONF['url'].'/'.$CONF['theme_url'].'/sounds/sound'.$type.'.ogg" type="audio/ogg"><source src="'.$CONF['url'].'/'.$CONF['theme_url'].'/sounds/sound'.$type.'.mp3" type="audio/mpeg"><source src="'.$CONF['url'].'/'.$CONF['theme_url'].'/sounds/sound'.$type.'.wav" type="audio/wav"></audio>';
	} else {
		$output = '<audio id="soundNew'.$type.'"></audio>';
	}
	return $output;
}
function realName($username, $first = null, $last = null, $fullname = null) {
	if($fullname) {
		if($first && $last) {
			return $first.' '.$last;
		} else {
			return $username;
		}
	}
	if($first && $last) {
		return $first.' '.$last;
	} elseif($first) {
		return $first;
	} elseif($last) {
		return $last;
	} elseif($username) { // If username is not set, return empty (example: the real-name under the subscriptions)
		return $username;
	}
}
function showUsers($users, $url) {

	foreach($users as $user) {
		$x .= '<div class="welcome-user"><a href="'.$url.'/index.php?a=profile&u='.$user['username'].'"><img src="'.$url.'/thumb.php?src='.$user['image'].'&t=a&w=112&h=112"></a></div>';
	}
	return $x;
}
function parseCallback($matches) {
	// If match www. at the beginning, at http before, to be html valid
	if(substr($matches[1], 0, 4) == 'www.') {
		$url = 'http://'.$matches[1];
	} else {
		$url = $matches[1];
	}
	return '<a href="'.$url.'" target="_blank" rel="nofollow">'.$matches[1].'</a>';
}
function generateDateForm($type, $current) {
	global $LNG;
	$rows = '';
	if($type == 0) {
		for ($i = date('Y'); $i >= (date('Y') - 50); $i--) {
			if($i == $current) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}
			$rows .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		}
	} elseif($type == 1) {
		for ($i = 1; $i <= 12; $i++) {
			if($i == $current) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}			
			($i < 10) ? $i = '0'.$i : $i;
			
			$rows .= '<option value="'.$i.'"'.$selected.'>'.$LNG["month_$i"].'</option>';
		}
	} elseif($type == 2) {
		for ($i = 1; $i <= 31; $i++) {
			if($i == $current) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}
			$rows .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		}
	}
	return $rows;
}
function generateAd($content) {
	global $LNG;
	if(empty($content)) {
		return false;
	}
	$ad = '<div class="sidebar-container widget-ad"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['sponsored'].'</div>'.$content.'</div></div>';
	return $ad;
}
function sortDateDesc($a, $b) {
	// Convert the array value into a UNIX timestamp
	strtotime($a['time']);
	strtotime($b['time']);
	
	return strcmp($a['time'], $b['time']);
}
function sortDateAsc($a, $b) {
	// Convert the array value into a UNIX timestamp
	strtotime($a['time']); 
	strtotime($b['time']);
	
	if ($a['time'] == $b['time']) {
		return 0;
	}
	return ($a['time'] > $b['time']) ? -1 : 1;  
}
function sortOnlineUsers($a, $b) {
	// Convert the array value into a UNIX timestamp
	strtotime($a['online']); 
	strtotime($b['online']);
	
	if ($a['online'] == $b['online']) {
		return 0;
	}
	return ($a['online'] > $b['online']) ? -1 : 1;  
}
function getLanguage($url, $ln = null, $type = null) {
	// Type 1: Output the available languages
	// Type 2: Change the path for the /requests/ folder location
	// Set the directory location
	if($type == 2) {
		$languagesDir = '../languages/';
	} else {
		$languagesDir = './languages/';
	}
	// Search for pathnames matching the .png pattern
	$language = glob($languagesDir . '*.php', GLOB_BRACE);

	if($type == 1) {
		// Add to array the available images
		foreach($language as $lang) {
			// The path to be parsed
			$path = pathinfo($lang);
			
			// Add the filename into $available array
			$available .= '<a href="'.$url.'/index.php?lang='.$path['filename'].'">'.ucfirst(strtolower($path['filename'])).'</a> - ';
		}
		return substr($available, 0, -3);
	} else {
		// If get is set, set the cookie and stuff
		$lang = 'english'; // DEFAULT LANGUAGE
		if($type == 2) {
			$path = '../languages/';
		} else {
			$path = './languages/';
		}
		if(isset($_GET['lang'])) {
			if(in_array($path.$_GET['lang'].'.php', $language)) {
				$lang = $_GET['lang'];
				setcookie('lang', $lang, time() +  (10 * 365 * 24 * 60 * 60)); // Expire in one month
			} else {
				setcookie('lang', $lang, time() +  (10 * 365 * 24 * 60 * 60)); // Expire in one month
			}
		} elseif(isset($_COOKIE['lang'])) {
			if(in_array($path.$_COOKIE['lang'].'.php', $language)) {
				$lang = $_COOKIE['lang'];
			}
		} else {
			setcookie('lang', $lang, time() +  (10 * 365 * 24 * 60 * 60)); // Expire in one month
		}

		if(in_array($path.$lang.'.php', $language)) {
			return $path.$lang.'.php';
		}
	}
}
function deletePhotos($type, $value) {
	// If the message type is picture
	if($type == 'picture') {		
		// Explode the images string value
		$images = explode(',', $value);

		// Delete each image
		foreach($images as $image) {
			unlink('../uploads/media/'.$image);
		}
	}
}
?>