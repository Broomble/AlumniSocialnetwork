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
			$feed->online_time = $settings['conline'];
			$feed->friends_online = $settings['ronline'];
			$feed->subscriptionsList = $feed->getSubs($verify['idu'], 0);
			$feed->subscribersList = $feed->getSubs($verify['idu'], 1);
			$feed->updateStatus($verify['offline']);
			
			// Useed in timeline javascript which checks for new messages
			$TMPL['subs'] = 1;
			
			$TMPL_old = $TMPL; $TMPL = array();
			$skin = new skin('shared/rows'); $rows = '';
			
			if(empty($_GET['filter'])) {
				$_GET['filter'] = '';
			}
			// Allowed types
			list($timeline, $message) = $feed->getFeed(0, $_GET['filter']);
			$TMPL['messages'] = $timeline;

			$rows = $skin->make();
			
			$skin = new skin('feed/sidebar'); $sidebar = '';
			
			$TMPL['editprofile'] = $feed->fetchProfileWidget($verify['username'], realName($verify['username'], $verify['first_name'], $verify['last_name']), $verify['image']);
			$TMPL['sidebar'] = $feed->sidebarTypes($_GET['filter'], $feed->subscriptions);
			$TMPL['dates'] = $feed->sidebarDates($_GET['filter'], $feed->subscriptions);
			$TMPL['trending'] = $feed->sidebarTrending($_GET['tag'], 5);
			$TMPL['users'] = $feed->onlineUsers();
			$TMPL['subscriptions'] = $feed->sidebarSubs(0, 0);
			$TMPL['subscribers'] = $feed->sidebarSubs(1, 0);
			$TMPL['friendsactivity'] = $feed->sidebarFriendsActivity(20, 1);
			if(count($feed->subscriptionsList[0]) < 6) {
				$TMPL['suggestions'] = $feed->sidebarSuggestions();
			}
			$TMPL['ad'] = generateAd($settings['ad3']);
			
			$sidebar = $skin->make();
			
			$skin = new skin('shared/top'); $top = '';
			
			// $TMPL['top'] = $feed->getForm();
			
			$TMPL['theme_url'] = $CONF['theme_url'];
			$TMPL['private_message'] = $verify['privacy'];
			$TMPL['avatar'] = $verify['image'];
			$TMPL['url'] = $CONF['url'];
			
			$top = $skin->make();
			
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['top'] = $top;
			$TMPL['rows'] = $rows;
			$TMPL['sidebar'] = $sidebar;
		}
	} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}
	
	if(isset($_GET['logout']) == 1) {
		$loggedIn->logOut();
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['title_feed'].' - '.$settings['title'];

	$skin = new skin('shared/timeline');
	return $skin->make();
}
?>