<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if(empty($verify['username'])) {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
		
		// If the $_GET user is empty, define default user as current logged in user, else redirect to home-pag
		if($_GET['u'] == '') {
			$_GET['u'] = (!empty($verify['username']) ? $verify['username'] : header("Location: ".$CONF['url']."/index.php?a=welcome"));
		}
		
		// If the current user is the same with the viewed profile, display the Message Form
		if($verify['username'] == $_GET['u']) {
			$skin = new skin('shared/top'); $top = '';
		
			$TMPL['theme_url'] = $CONF['theme_url'];
			$TMPL['private_message'] = $verify['privacy'];
			$TMPL['avatar'] = $verify['image'];
			$TMPL['url'] = $CONF['url'];
			$top = $skin->make();
		}
	}
		 
	// Start displaying the Feed
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->user = $verify;
	$feed->id = $verify['idu'];
	$feed->username = $verify['username'];
	$feed->per_page = $settings['perpage'];
	$feed->time = $settings['time'];
	$feed->censor = $settings['censor'];
	$feed->smiles = $settings['smiles'];
	$feed->c_per_page = $settings['cperpage'];
	$feed->c_start = 0;
	$feed->l_per_post = $settings['lperpost'];
	
	if($verify['username']) {
		$feed->updateStatus($verify['offline']);
	}
	
	// If the $_GET user is empty, define default user as current logged in user, else redirect to home-pag
	if($_GET['u'] == '') {
		$_GET['u'] = (!empty($feed->username) ? $feed->username : header("Location: ".$CONF['url']."/index.php?a=welcome"));
	}
	
	$feed->profile = $_GET['u'];
	$feed->profile_data = $feed->profileData($_GET['u']);
	$feed->subscriptionsList = $feed->getSubs($feed->profile_data['idu'], 0, null);
	$feed->subscribersList = $feed->getSubs($feed->profile_data['idu'], 1, null);
	// $feed->image = $verify['image'];
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('shared/rows'); $rows = '';
	
	if(empty($_GET['filter'])) {
		$_GET['filter'] = '';
	}
	// Allowed types
	list($timeline, $message) = $feed->getProfile(0, $_GET['filter']);

	if($_GET['r'] == 'subscriptions') {
		if($message !== 1) {
			$top = ''; // Hide the message form
			$feed->s_per_page = $settings['sperpage'];
			$feed->subsList = $feed->getSubs($feed->profile_data['idu'], 0, 0);
			$TMPL['messages'] = $feed->listSubs(0);
			$x = 1;
		} else {
			$TMPL['messages'] = $timeline;
		}
	} elseif($_GET['r'] == 'subscribers') {
		if($message !== 1) {
			$top = ''; // Hide the message form
			$feed->s_per_page = $settings['sperpage'];
			$feed->subsList = $feed->getSubs($feed->profile_data['idu'], 1, 0);
			$TMPL['messages'] = $feed->listSubs(1);
			$x = 1;
		} else {
			$TMPL['messages'] = $timeline;
		}
	} elseif($_GET['r'] == 'likes') {
		if($message !== 1) {
			$top = ''; // Hide the message form
			$TMPL['messages'] = $feed->getLikes(0, 1);
			$x = 1;
		} else {
			$TMPL['messages'] = $timeline;
		}
	} else {
		$TMPL['messages'] = $timeline;
	}
	
	$rows = $skin->make();
	
	$skin = new skin('profile/sidebar'); $sidebar = '';
	// If the username doesn't exist
	if($message !== 1) {
		$TMPL['about'] = $feed->fetchProfileInfo($feed->profileData($_GET['u']));
		$TMPL['sidebar'] = $feed->sidebarTypes($_GET['filter'], 'profile');
		$TMPL['dates'] = $feed->sidebarDates($_GET['filter'], 'profile');

		$TMPL['places'] = $feed->sidebarPlaces($feed->profile_data['idu']);
		
		$TMPL['subscriptions'] = $feed->sidebarSubs(0, $subscriptions, 0);
		$TMPL['subscribers'] = $feed->sidebarSubs(1, $subscribers, 0);
		$TMPL['ad'] = generateAd($settings['ad4']);
	} else {
		$skin = new skin('profile/sidebar'); $sidebar = '';
		$TMPL['ad'] = generateAd($settings['ad4']);
	}
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['top'] = $top;
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;
	$TMPL['cover'] = $feed->fetchProfile($feed->profile_data);
	
	if(isset($_GET['logout']) == 1) {
		$loggedIn->logOut();
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['title_profile'].' - '.realName($_GET['u'], $feed->profile_data['first_name'], $feed->profile_data['last_name'], 1).' - '.$settings['title'];

	if($x) {
		$skin = new skin('shared/timeline_x');
	} else {
		$skin = new skin('shared/timeline');
	}
	return $skin->make();
}
?>