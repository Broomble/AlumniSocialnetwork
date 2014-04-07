<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if($verify['username']) {
			$feed->user = $verify;
			$feed->username = $verify['username'];
			$feed->id = $verify['idu'];
			
			if(isset($_GET['tag'])) {
				$skin = new skin('shared/top'); $top = '';
				
				$TMPL['theme_url'] = $CONF['theme_url'];
				$TMPL['private_message'] = $verify['privacy'];
				$TMPL['avatar'] = $verify['image'];
				$TMPL['url'] = $CONF['url'];

				$top = $skin->make();
			}
		}
	}

	$feed->per_page = $settings['perpage'];
	$feed->time = $settings['time'];
	$feed->censor = $settings['censor'];
	$feed->smiles = $settings['smiles'];
	$feed->c_per_page = $settings['cperpage'];
	$feed->c_start = 0;
	$feed->l_per_post = $settings['lperpost'];
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('shared/rows'); $rows = '';
	
	if(empty($_GET['filter'])) {
		$_GET['filter'] = '';
	}
	
	// Allowed types
	if(isset($_GET['tag'])) {
		// If the $_GET keyword is empty [hashtag]
		if($_GET['tag'] == '') {
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
		$hashtags = $feed->getHashtags(0, $settings['qperpage'], $_GET['tag'], null);
		$TMPL['messages'] = $hashtags[0];
	} else {
		// If the $_GET keyword is empty [user]
		if($_GET['q'] == '') {
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
		$TMPL['messages'] = $feed->getSearch(0, $settings['qperpage'], $_GET['q'], $_GET['filter']);
	}
	$rows = $skin->make();
	
	$skin = new skin('search/sidebar'); $sidebar = '';

	if(isset($_GET['tag'])) {
		$TMPL['trending'] = $feed->sidebarTrending($_GET['tag'], 10);
	} else {
		$TMPL['genre'] = $feed->sidebarGender($_GET['filter'], $_GET['q']);
	}
	$TMPL['ad'] = generateAd($settings['ad6']);
	
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['top'] = $top;
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;
	
	if(isset($_GET['logout']) == 1) {
		$loggedIn->logOut();
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}

	$TMPL['url'] = $CONF['url'];
	
	if(isset($_GET['tag'])) {
		$TMPL['title'] = '#'.$_GET['tag'].' - '.$settings['title'];
	} else {
		$TMPL['title'] = $LNG['title_search'].' - '.$_GET['q'].' - '.$settings['title'];
	}

	$skin = new skin('shared/timeline_x');
	return $skin->make();
}
?>