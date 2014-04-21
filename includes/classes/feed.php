<?php

class feed {
	public $db;					// Database Property
	public $url;				// Installation URL Property
	public $title;				// Installation WebSite Title
	public $email;				// Installation Default E-mail
	public $id;					// The ID of the user
	public $username;			// The username
	public $user_email;			// The email of the current username
	public $per_page;			// The per_page limit for feed
	public $c_start;			// The row where to start the nex
	public $c_per_page;			// Comments per_page limit
	public $s_per_page;			// Subscribers per page (dedicated profile page)
	public $m_per_page;			// Conversation Messages (Chat) per page
	public $time;				// The time option from the admin panel
	public $censor;				// List of censored words
	public $max_size;			// Image size allowed for upload (messages)
	public $image_format;		// Image formats allowed for upload (messages)
	public $subscriptions;		// The public variable to be accessed outside of the class to pass variable to sidebar functions
	public $message_length;		// The maximum message length allowed for messages/comments
	public $max_images;			// The maxium images allowed to be uploaded per message
	public $is_admin;			// The option for is_admin to show the post no matter what
	public $profile;			// The current viewed user profile
	public $profile_id;			// The profile id of the current viewed user profile
	public $profile_data;		// The public variable which holds all the data for queried user
	public $subscriptionsList;	// The subscriptions users list Array([value],[count])
	public $subscribersList;	// The subscribers users list Array([value],[count])
	public $subsList;			// The subs list for dedicated subs page
	public $l_per_post;			// Likes per post (small thumbs)
	public $online_time;		// The amount of time an user is being kept as online
	public $friends_online;		// The amount of online friends to be displayed on the Feed/Subscriptions page
	public $chat_length;		// The maximum chat length allowed for conversations
	public $email_comment;		// The admin settings for allowing e-mails on comments to be sent
	public $email_like;			// The admin settings for allowing e-mails on likes to be sent
	public $email_new_friend;	// The admin settings for allowing e-mails on new friendship to be sent
	public $smiles;				// The admin settings for displaying smiles in messages

	function getMessages($query, $type, $typeVal) {
		// QUERY: Holds the query string
		// TYPE: [loadTimeline, loadFeed, loadProfile, loadHashtags]
		// TYPEVAL: Values for the JS functions
		global $LNG;

		// Run the query
		$result = $this->db->query($query);
		
		// Set the result into an array
		$rows = array();
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		// If the Feed is empty, display a welcome message
		if(empty($rows) && $type == 'loadTimeline') {
			return $this->showError('welcome_timeline');
		} elseif(empty($rows) && $type == 'loadHashtags') {
			return $this->showError('no_results');
		}
		
		// Define the $loadmore variable
		$loadmore = '';
		
		// If there are more results available than the limit, then show the Load More Comments
		if(array_key_exists($this->per_page, $rows)) {
			$loadmore = 1;
			
			// Unset the last array element because it's not needed, it's used only to predict if the Load More Messages should be displayed
			array_pop($rows);
		}
		
		// Define the $messages variable
		$messages = '';
		
		// If it's set profile, then set $profile
		if($this->profile) {
			$profile = ', \''.$this->profile.'\'';
		}
		$messages .= '<div class="last-message" name="name-'.$rows[0]['idu'].'" id="last-'.$rows[0]['id'].'" title="type-'.str_replace('\'', '', $typeVal).'" alt="profile-'.str_replace(array(', \'', '\''), '', $profile).'"></div>';
		// Start outputting the content
		foreach($rows as $row) {
			$time = $row['time']; $b = '';
			if($this->time == '0') {
				$time = date("c", strtotime($row['time']));
			} elseif($this->time == '2') {
				$time = $this->ago(strtotime($row['time']));
			} elseif($this->time == '3') {
				$date = strtotime($row['time']);
				$time = date('Y-m-d', $date);
				$b = '-standard';
			}

			// Define the style variable (reset the last value)
			$style = '';
			if($this->username == $row['username']) { // If it's current username is the same with the current author
				if($row['public'] == 1) {
					$privacy = '<a onclick="privacy('.$row['id'].', 0)" title="'.$LNG['this_post_public'].'"><div class="public_btn"></div></a>';
					$delete = '<a onclick="delete_the('.$row['id'].', 1)" title="'.$LNG['delete_this_message'].'"><div class="delete_btn"></div></a>';
					// $style = '';
				} else {
					$privacy = '<a onclick="privacy('.$row['id'].', 1)" title="'.$LNG['this_post_private'].'"><div class="private_btn"></div></a>';
					$delete = '<a onclick="delete_the('.$row['id'].', 1)" title="'.$LNG['delete_this_message'].'"><div class="delete_btn"></div></a>';
					// Hide the comment box
					$style = ' style="display: none"';
				}
			} elseif(empty($this->username)) { // If the user is not registered
					// $privacy = '';
					// $delete = '';
					$style = ' style="display: none"'; // Hide the comments post box for visitors
					if($row['public'] == 0) { 
						$hide = 1;
					}
			} else { // If the current username is not the same as the author
				if($row['public'] == 1) {
					$privacy = '';
					$delete = '<a onclick="report_the('.$row['id'].', 1)" title="'.$LNG['report_this_message'].'"><div class="report_btn"></div></a>';
					$style = '';
				} else {
					$privacy = '';
					$delete = '<a onclick="report_the('.$row['id'].', 1)" title="'.$LNG['report_this_message'].'"><div class="report_btn"></div></a>';
					// Hide the comment box
					$style = ' style="display: none"';
					$hide = 1;
				}
			}

			if($hide && !$this->is_admin) {
				$error = $this->showError('message_hidden');
				$messages .= $error[0];
			} else {
				$messages .= '
				<div class="message-container" id="message'.$row['id'].'">
					<div class="message-content">
						<div class="message-inner">
							<div class="message-avatar" id="avatar'.$row['id'].'">
								<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">
									<img onmouseover="profileCard('.$row['idu'].', '.$row['id'].', 0, 0);" onmouseout="profileCard(0, 0, 0, 1);" onclick="profileCard(0, 0, 1, 1);" src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50" />
								</a>
							</div>
							<div class="message-top">
								'.$delete.'
								<span id="privacy'.$row['id'].'">'.$privacy.'</span>
								<div class="message-author" id="author'.$row['id'].'">
									<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.realName($row['username'], $row['first_name'], $row['last_name']).'</a>
								</div>
								<div class="message-time">
										<span id="time'.$row['id'].'"><a href="'.$this->url.'/index.php?a=post&m='.$row['id'].'" target="_blank">
											<div class="timeago'.$b.'" title="'.$time.'">
												'.$time.'
											</div>
										</span>
										<div class="comments_preloader" id="del_message_'.$row['id'].'"></div>
									</a>
								</div>
							</div>
							<div class="message-message">			
							'.nl2br($this->parseMessage($row['message'])).'
							</div>
						</div>
						<div class="message-divider"></div>
						'.$this->getType($row['type'], $row['value'], $row['id']).'
						<div class="message-replies">
							<div class="message-actions"><div class="message-actions-content" id="message-action'.$row['id'].'">'.$this->getActions($row['id'], $row['likes'], null).'</div></div>
							<div class="message-replies-content" id="comments-list'.$row['id'].'">
								'.$this->getComments($row['id'], null, $this->c_start).'
							</div>
						</div>
						<div class="message-comment-box-container" id="comment_box_'.$row['id'].'"'.$style.'>
							<div class="message-reply-avatar">
								<a href="'.$this->url.'/index.php?a=profile&u='.$this->user['username'].'"><img src="'.$this->url.'/thumb.php?src='.$this->user['image'].'&t=a&w=50&h=50" /></a>
							</div>
							<div class="message-comment-box-form">
								<textarea id="comment-form'.$row['id'].'" onclick="showButton('.$row['id'].')" placeholder="'.$LNG['leave_comment'].'" class="comment-reply-textarea"></textarea>
							</div>
							<div class="comment-btn" id="comment_btn_'.$row['id'].'">
								<a onclick="postComment('.$row['id'].')">'.$LNG['post'].'</a>
							</div>
							<div class="delete_preloader" id="post_comment_'.$row['id'].'"></div>
						</div>
					</div>	
				</div>';
				$start = $row['id'];
			}
		}
		
		// If the $loadmore button is set, then show the Load More Messages button
		if($loadmore) {
			$messages .= '
						<div class="message-container" id="more_messages">
							<div class="load_more"><a onclick="'.$type.'('.$start.', '.$typeVal.''.$profile.')">'.$LNG['view_more_messages'].'</a></div>
						</div>';
		}
		return array($messages, 0);
	}
	
	function getTimeline($start, $value) {
		// Allowed types
		$allowedType = $this->listTypes('timeline');
		$allowedDates = $this->listDates('timeline');
		
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'AND messages.id < \''.$this->db->real_escape_string($start).'\'';
		}

		if(in_array($value, $allowedType)) {
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.type = '%s' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id, $this->db->real_escape_string($value), $start, ($this->per_page + 1));
			$value = '\''.$value.'\'';
		} elseif(in_array($value, $allowedDates)) {
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND extract(YEAR_MONTH from `time`) = '%s' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id, $this->db->real_escape_string($value), $start, ($this->per_page + 1));
			$value = '\''.$value.'\'';
		} else {
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id, $start, ($this->per_page + 1));
			$value = '\'\'';
		}

		return $this->getMessages($query, 'loadTimeline', $value);
	}
	
	function getFeed($start, $value) {
		$this->subscriptions = $this->getSubscriptionsList();

		// Allowed types (if it's empty, return false to cancel the query)
		$allowedType = $this->listTypes(($this->subscriptions) ? $this->subscriptions : false);
		$allowedDates = $this->listDates(($this->subscriptions) ? $this->subscriptions : false);
		
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'AND messages.id < \''.$this->db->real_escape_string($start).'\'';
		}
		
		if(in_array($value, $allowedType)) {
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid IN (%s) AND messages.type = '%s' AND messages.public = '1' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id.','.$this->subscriptions, $this->db->real_escape_string($value), $start, ($this->per_page + 1));
			$value = '\''.$value.'\'';
		} elseif(in_array($value, $allowedDates)) {
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid IN (%s) AND extract(YEAR_MONTH from `time`) = '%s' AND messages.public = '1' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id.','.$this->subscriptions, $this->db->real_escape_string($value), $start, ($this->per_page + 1));
			$value = '\''.$value.'\'';
		} else {
			// The query to select the subscribed users
			$query = sprintf("SELECT * FROM messages, users WHERE messages.uid IN (%s) AND messages.public = '1' AND messages.uid = users.idu %s ORDER BY messages.id DESC LIMIT %s", $this->id.','.$this->subscriptions, $start, ($this->per_page + 1));
			$value = '\'\'';
		}
		
		// If the user subscribed to other users get the messages (prevents fatal error because of empty IN () query)
		if(!empty($this->subscriptions)) {
			return $this->getMessages($query, 'loadFeed', $value);
		} else {
			return $this->showError('welcome_feed');
		}
	}
	
	function getProfile($start, $value) {
		$profile = $this->profile_data;
		$this->profile_id = $profile['idu'];
		
		// If the username exist
		if(!empty($profile['idu'])) {
			$relationship = $this->verifyRelationship($this->id, $this->profile_id, 0);
			
			// Check privacy
			switch($profile['private']) {
				case 0:
					break;
				case 1:
					// Check if the username is not same with the profile
					if($this->profile !== $this->username) {
						return $this->showError('profile_private');
					}
					break;
				case 2:
					// Check relationship
					if(!$relationship) {
						return $this->showError('profile_semi_private');
					}
					break;
			}
			
			// Allowed types
			$allowedType = $this->listTypes('profile');
			$allowedDates = $this->listDates('profile');
			
			// If the $start value is 0, empty the query;
			if($start == 0) {
				$start = '';
			} else {
				// Else, build up the query
				$start = 'AND messages.id < \''.$this->db->real_escape_string($start).'\'';
			}
			
			// Decide if the query will include only public messages or not
			$public = ($this->username == $this->profile) ? '' : 'AND messages.public = 1';
			if(in_array($value, $allowedType)) {
				$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.type = '%s' AND messages.uid = users.idu %s %s ORDER BY messages.id DESC LIMIT %s", $this->db->real_escape_string($profile['idu']), $this->db->real_escape_string($value), $public, $start, ($this->per_page + 1));
				$value = '\''.$value.'\'';
			} elseif(in_array($value, $allowedDates)) {
				$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND extract(YEAR_MONTH from `time`) = '%s' AND messages.uid = users.idu %s %s ORDER BY messages.id DESC LIMIT %s", $this->db->real_escape_string($profile['idu']), $this->db->real_escape_string($value), $public, $start, ($this->per_page + 1));
				$value = '\''.$value.'\'';
			} else {
				$query = sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.uid = users.idu %s %s ORDER BY messages.id DESC LIMIT %s", $this->db->real_escape_string($profile['idu']), $public, $start, ($this->per_page + 1));
				$value = '\'\'';
			}
			return $this->getMessages($query, 'loadProfile', $value);
		} else {
			return $this->showError('profile_not_exist');
		}
	}
	
	function getSubscriptionsList() {
		// The query to select the subscribed users
		$query = sprintf("SELECT `leader` FROM `relations` WHERE `subscriber` = '%s'", $this->db->real_escape_string($this->id));
		
		// Run the query
		$result = $this->db->query($query);
		
		// The array to store the subscribed users
		$subscriptions = array();
		while($row = $result->fetch_assoc()) {
			$subscriptions[] = $row['leader'];
		}
		
		// Close the query
		$result->close();
		
		// Return the subscriptions list (e.g: 13,22,19)
		return implode(',', $subscriptions);
	}
	
	public function profileData($username = null, $id = null) {
		// The query to select the profile
		// If the $id is set (used in Subscribe function for profiels) then search for the ID
		if($id) {
			$query = sprintf("SELECT `idu`, `username`, `email`, `first_name`, `last_name`, `location`, `course`, `branch`, `join`, `enrollno`, `website`, `bio`, `date`, `facebook`, `twitter`, `gplus`, `image`, `private`, `background`, `privacy`, `born`, `cover`, `verified`, `gender`, `email_new_friend` FROM `users` WHERE `idu` = '%s'", $this->db->real_escape_string($id));
		} else {
			$query = sprintf("SELECT `idu`, `username`, `email`, `first_name`, `last_name`, `location`, `course`, `branch`, `join`, `enrollno`, `website`, `bio`, `date`, `facebook`, `twitter`, `gplus`, `image`, `private`, `background`, `privacy`, `born`, `cover`, `verified`, `gender`, `email_new_friend` FROM `users` WHERE `username` = '%s'", $this->db->real_escape_string($username));
		}
		
		// Run the query
		$result = $this->db->query($query);
		
		return $result->fetch_assoc();
	}
	
	function fetchProfile($profile) {
		global $LNG, $CONF;
		$coverImage = ((!empty($profile['cover'])) ? $profile['cover'] : 'default.png');
		$coverAvatar = ((!empty($profile['image'])) ? $profile['image'] : 'default.png');
		$cover = '<div class="twelve columns">
					<div class="cover-container">
						<div class="cover-content">
							<a onclick="gallery(\''.$coverImage.'\', \''.$profile['idu'].$profile['username'].'\', \'covers\')" id="'.$coverImage.'"><div class="cover-image" style="background-position: center; background-image: url('.$this->url.'/thumb.php?src='.((!empty($profile['cover'])) ? $profile['cover'] : 'default.png').'&w=900&h=200&t=c)">
							</div></a>
							<div class="cover-description">
								<div class="cover-avatar-content">
									<div class="cover-avatar">
										<a onclick="gallery(\''.$coverAvatar.'\', \''.$profile['idu'].$profile['username'].'\', \'avatars\')" id="'.$coverAvatar.'"><span id="avatar'.$profile['idu'].$profile['username'].'"><img src="'.$this->url.'/thumb.php?src='.$coverAvatar.'&t=a&w=150&h=150" /></span></a>
									</div>
								</div>
								<div class="cover-description-content">
									<span id="author'.$profile['idu'].$profile['username'].'"></span><span id="time'.$profile['idu'].$profile['username'].'"></span><div class="cover-username"><a href="'.$this->url.'/index.php?a=profile&u='.$profile['username'].'">'.realName($profile['username'], $profile['first_name'], $profile['last_name']).'</a>'.((!empty($profile['verified'])) ? '<img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" />' : '').'</div>
									<div class="cover-description-buttons"><div id="subscribe'.$profile['idu'].'">'.$this->getSubscribe(null, null, null).'</div>'.$this->chatButton($profile['idu'], $profile['username'], 1).'</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
		return $cover;
	}
	
	function getProfileCard($profile) {
		global $LNG, $CONF;
		$coverAvatar = ((!empty($profile['image'])) ? $profile['image'] : 'default.png');
		$subscribe = $this->getSubscribe(null, null, null);
		$card = '
			<div class="profile-card-cover"><img src="'.$this->url.'/thumb.php?src='.((!empty($profile['cover'])) ? $profile['cover'] : 'default.png').'&w=900&h=300&t=c"></div>
			<div class="profile-card-avatar">
				<a href="'.$this->url.'/index.php?a=profile&u='.$profile['username'].'"><img src="'.$this->url.'/thumb.php?src='.$coverAvatar.'&t=a&w=112&h=112" /></a>
			</div>
			<div class="profile-card-info">
				<a href="'.$this->url.'/index.php?a=profile&u='.$profile['username'].'"><span id="author'.$profile['idu'].$profile['username'].'"></span><span id="time'.$profile['idu'].$profile['username'].'"></span><div class="cover-username">'.realName($profile['username'], $profile['first_name'], $profile['last_name']).''.((!empty($profile['verified'])) ? '<img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" />' : '').'</div></a>
			</div>
			'.((!empty($profile['bio'])) ? '<div class="profile-card-divider"></div><div class="profile-card-bio">'.$profile['bio'].'</div>' : '').'
			'.((!empty($subscribe)) ? '
			<div class="profile-card-divider"></div>
			<div class="profile-card-buttons"><div class="profile-card-buttons-container"><div id="subscribe'.$profile['idu'].'">'.$subscribe.'</div>'.$this->chatButton($profile['idu'], $profile['username'], 1).'</div></div>' : '').'
		';
		return $card;
	}
	
	function fetchProfileWidget($username, $name, $image) {
		global $LNG;
		$widget =  '<div class="sidebar-container widget-welcome">
						<div class="sidebar-content">
							<div class="sidebar-header">'.$LNG['welcome'].'</div>
							<div class="sidebar-inner">
								<div class="sidebar-avatar"><a href="'.$this->url.'/index.php?a=profile&u='.$username.'"><img src="'.$this->url.'/thumb.php?src='.$image.'&t=a&w=50&h=50" /></a></div>
								<div class="sidebar-avatar-desc">
									<a href="'.$this->url.'/index.php?a=profile&u='.$username.'">'.((!empty($name) ? $name : $username)).'</a>
									<div class="sidebar-avatar-edit"><a href="'.$this->url.'/index.php?a=settings">'.$LNG['admin_ttl_edit_profile'].'</a></div>
								</div>
							</div>
						</div>
					</div>';
		return $widget;
	}
	
	function checkNewMessages($uid, $id, $filter = null, $profile = null, $subs = null) {
		global $LNG;
		// If the viewed profile is not the one of the viewer, show notification only on public messages
		$url = 'timeline';
		if(!empty($profile)) {
			if($this->username == $profile) {
				$public = '';
			} else {
				$public = 'AND messages.public = 1';
			}
			$url = 'profile&u='.$profile;
		}
		
		// If the query is for subscribers
		if($subs) {
			// Get the subscribers list
			$query = sprintf("SELECT `leader` FROM `relations` WHERE `subscriber` = '%s'", $this->db->real_escape_string($this->id));

			// Run the query
			$result = $this->db->query($query);
			
			// The array to store the subscribed users
			$subscriptions = array();
			while($row = $result->fetch_assoc()) {
				$subscriptions[] = $row['leader'];
			}
			$where = 'messages.uid IN ('.implode(',', $subscriptions).')';
			
			// Show only the public messages
			$public = 'AND messages.public = 1';
			$url = 'feed';
		} else {
			$where = sprintf("messages.uid = %s", $this->db->real_escape_string($uid));
		}
		
		// If is numberic (AKA DATES)
		if(is_numeric($filter)) {	
			$query = sprintf("SELECT * FROM messages, users WHERE %s AND messages.uid = users.idu AND messages.id > '%s' AND extract(YEAR_MONTH from `time`) = '%s' %s ORDER BY messages.id DESC LIMIT 1", $where, $this->db->real_escape_string($id), $this->db->real_escape_string($filter), $public);
		// Else if is not empty (it means it contains something, AKA FILTERS)
		} elseif(!empty($filter)) {
			$query = sprintf("SELECT * FROM messages, users WHERE %s AND messages.uid = users.idu AND messages.id > '%s' AND messages.type = '%s' %s ORDER BY messages.id DESC LIMIT 1", $where, $this->db->real_escape_string($id), $this->db->real_escape_string($filter), $public);
		} else {
			$query = sprintf("SELECT * FROM messages, users WHERE %s AND messages.uid = users.idu AND messages.id > '%s' %s ORDER BY messages.id DESC LIMIT 1", $where, $this->db->real_escape_string($id), $public);
		}

		$result = $this->db->query($query);
		if($result->num_rows) {
		return '<div class="message-container new-message-url"><a href="'.$this->url.'/index.php?a='.$url.'"><div class="new-message">'.$LNG['new_messages_posted'].'</div></a></div>';
		} else {
			return false;
		}
	}
	
	function fetchProfileInfo($profile) {
		global $LNG;
		
		// Explode the born value [[0]=>Y,[1]=>M,[2]=>D];
		$born = explode('-', $profile['born']);
		$join  = explode('-', $profile['join']);
		// Make it into integer instead of a string (removes the 0, e.g: 03=>3, prevents breaking the language)
		$month = intval($born[1]);

		if($profile['course'] == '1') {
					$course  = $LNG['btech'];
				} elseif($profile['course'] == '2') {
					$course  = $LNG['mca'];
				} elseif($profile['course'] == '3') {
					$course  = $LNG['mba'];
				} elseif($profile['course'] == '4') {
					$course  = $LNG['bca'];
				}

				if($profile['branch'] == '1') {
					$branch  = $LNG['ece'];
				} elseif($profile['branch'] == '2') {
					$branch  = $LNG['cse'];
				} elseif($profile['branch'] == '3') {
					$branch  = $LNG['mae'];
				} elseif($profile['branch'] == '4') {
					$branch  = $LNG['eee'];
				} elseif($profile['branch'] == '5') {
					$branch  = $LNG['it'];
				} elseif($profile['branch'] == '6') {
					$branch  = $LNG['ce'];
				}


		$info = '<div class="sidebar-container widget-about"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['profile_about'].''.(($this->profile == $this->username) ? ' (<a href="'.$this->url.'/index.php?a=settings">'.$LNG['admin_ttl_edit'].'</a>)' : '').'</div>
		'.((!empty($profile['location'])) ? '<div class="sidebar-list">'.$LNG['profile_location'].': <strong>'.$profile['location'].'</strong></div>' : '').'
		'.(($profile['born'] !== '0000-00-00') ? '<div class="sidebar-list">'.$LNG['profile_born'].': <strong>'.$LNG["month_$month"].' '.$born[2].', '.$born[0].'</strong></div>' : '').'
		'.((!empty($profile['gender'])) ? '<div class="sidebar-list">'.$LNG['ttl_gender'].': <strong>'.(($profile['gender'] == 1) ? $LNG['male'] : $LNG['female']).'</strong></div>' : '').'
		'.(($profile['join'] !== '0000-0000') ? '<div class="sidebar-list">'.$LNG['ttl_year'].': <strong>'.$join[0].' - '.$join[1].'</strong></div>' : '').'		
		'.((!empty($profile['course'])) ? '<div class="sidebar-list">'.$LNG['ttl_course'].': <strong>'.$course.'</strong></div>' : '').'
		'.((!empty($profile['branch'])) ? '<div class="sidebar-list">'.$LNG['ttl_branch'].': <strong>'.$branch.'</strong></div>' : '').'				
		'.((!empty($profile['enrollno'])) ? '<div class="sidebar-list">'.$LNG['ttl_enrollno'].': <strong>'.$profile['enrollno'].'</strong></div>' : '').'
		'.((!empty($profile['website'])) ? '<div class="sidebar-list">'.$LNG['profile_website'].': <strong><a href="'.$profile['website'].'" target="_blank" rel="nofllow">'.$LNG['profile_view_site'].'</a></strong></div>' : '').'
		'.((!empty($this->subscriptionsList[1])) ? '<div class="sidebar-list">'.$LNG['follows'].': '.$this->sidebarSubs(0, 1).'</div>' : '').'
		'.((!empty($this->subscribersList[1])) ? '<div class="sidebar-list">'.$LNG['followed_by'].': '.$this->sidebarSubs(1, 1).'</div>' : '').'
		'.((!empty($profile['facebook'])) ? '<div class="sidebar-list">Facebook: <strong><a href="http://facebook.com/'.$profile['facebook'].'" target="_blank" rel="nofllow">'.$LNG['profile_view_profile'].'</a></strong></div>' : '').'
		'.((!empty($profile['gplus'])) ? '<div class="sidebar-list">Google+: <strong><a href="http://plus.google.com/'.$profile['gplus'].'" target="_blank" rel="nofllow">'.$LNG['profile_view_profile'].'</a></strong></div>' : '').'
		'.((!empty($profile['twitter'])) ? '<div class="sidebar-list">Twitter: <strong><a href="http://twitter.com/'.$profile['twitter'].'" target="_blank" rel="nofllow">'.$LNG['profile_view_profile'].'</a></strong></div>' : '').'
		'.(($this->getLikes()) ? '<div class="sidebar-list">'.$LNG['likes'].': <a href="'.$this->url.'/index.php?a=profile&u='.$profile['username'].'&r=likes"><strong>'.$this->getLikes().' '.$LNG['messages'].'</strong></a></div>' : '').'
		'.((!empty($profile['bio'])) ? '<div class="sidebar-list">'.$LNG['profile_bio'].': '.$profile['bio'].'</div>' : '').'
		</div></div>';
		
		return $info;
	}
	
	function checkNewNotifications($limit, $type = null, $for = null, $ln = null, $cn = null, $sn = null, $fn = null, $dn = null) {
		global $LNG, $CONF;
		// $ln, $cn, $mn holds the filters for the notifications
		// Type 0: Just check for and show the new notification alert
		// Type 1: Return the last X notifications from each category. (Drop Down Notifications)
		// Type 2: Return the latest X notifications (read and unread) (Notifications Page)
		
		// For 0: Returns the Global Notifications
		// For 1: Return results for the Chat Messages Notifications (Drop Down)
		// For 2: Return Chat Messages results for the Notifications Page

		// Start checking for new notifications
		if(!$type) {
		
			// Check for new likes events
			if($ln) {
				$checkLikes = $this->db->query(sprintf("SELECT `id` FROM `notifications` WHERE `to` = '%s' AND `from` <> '%s' AND `type` = '2' AND `read` = '0'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
				
				$lc = $checkLikes->num_rows;
			}
			
			// Check for new comments events
			if($cn) {
				$checkComments = $this->db->query(sprintf("SELECT `id` FROM `notifications` WHERE `to` = '%s' AND `from` <> '%s' AND `type` = '1' AND `read` = '0'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
						
				// If any, return 1 (show notification)
				$cc = $checkComments->num_rows;
			}
			
			// Check for new messages events (shared messages)
			if($sn) {
				$checkShares = $this->db->query(sprintf("SELECT `id` FROM `notifications` WHERE `to` = '%s' AND `from` <> '%s' AND `type` = '3' AND `read` = '0'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
				
				// If any, return 1 (show notification)
				$sc = $checkShares->num_rows;
			}
			
			// Check for new friend additions
			if($fn) {
				$checkFriends = $this->db->query(sprintf("SELECT `id` FROM `notifications` WHERE `to` = '%s' AND `from` <> '%s' AND `type` = '4' AND `read` = '0'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
				
				// If any, return 1 (show notification)
				$fc = $checkFriends->num_rows;
			}
			
			if($for) {
				if($dn) {
					$checkChats = $this->db->query(sprintf("SELECT `id` FROM `chat` WHERE `to` = '%s' AND `read` = '0'", $this->db->real_escape_string($this->id)));
					
					// If any, return 1 (show notification)
					$dc = $checkChats->num_rows;
				}
			}
			
			$output = array('response' => array('global' => $lc + $cc + $sc + $fc, 'messages' => $dc));
			return json_encode($output);
		} else {
			// Define the arrays that holds the values (prevents the array_merge to fail, when one or more options are disabled)
			$likes = array();
			$comments = array();
			$shares = array();
			$friends = array();
			$chats = array();
			
			if($type) {
				// Get the events and display all unread messages [applies only to the drop down widgets]
				if($for == 2 && $type !== 2 || !$for && $type !== 2) {
					if($ln) {
						// Check for new likes events
						$checkLikes = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '2' AND `notifications`.`read` = '0' ORDER BY `notifications`.`id` DESC", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
						// Fetch the comments
						while($row = $checkLikes->fetch_assoc()) {
							$likes[] = $row;
						}
					}
					
					if($cn) {
						// Check for new comments events
						$checkComments = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '1' AND `notifications`.`read` = '0' ORDER BY `notifications`.`id` DESC", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
						// Fetch the comments
						while($row = $checkComments->fetch_assoc()) {
							$comments[] = $row;
						}
					}
					
					if($sn) {
						// Check for new messages events
						$checkShares = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '3' AND `notifications`.`read` = '0' ORDER BY `notifications`.`id` DESC", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
						// Fetch the messages
						while($row = $checkShares->fetch_assoc()) {
							$shares[] = $row;
						}
					}
					
					if($fn) {
						// Check for new messages events
						$checkFriends = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '4' AND `notifications`.`read` = '0' ORDER BY `notifications`.`id` DESC", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id)));
						// Fetch the messages
						while($row = $checkFriends->fetch_assoc()) {
							$friends[] = $row;
						}
					}
					
					if($for == 2) {
						if($dn) {
							// Check for new messages events
							$checkChats = $this->db->query(sprintf("SELECT * FROM (SELECT * FROM `chat`,`users` WHERE `chat`.`to` = '%s' AND `chat`.`read` = '0' AND `chat`.`from` = `users`.`idu` ORDER BY `id` DESC) as x GROUP BY `from`", $this->db->real_escape_string($this->id)));
							// Fetch the chat
							while($row = $checkChats->fetch_assoc()) {
								$chats[] = $row;
							}
						}
					}
				}
				// Return the unread messages for drop-down messages notifications (excludes $for 2 and $type 2)
				elseif($type !== 2 && $for == 1) {
					if($dn) {
						// Check for new messages events
						$checkChats = $this->db->query(sprintf("SELECT * FROM (SELECT * FROM `chat`,`users` WHERE `chat`.`to` = '%s' AND `chat`.`read` = '0' AND `chat`.`from` = `users`.`idu` ORDER BY `id` DESC) as x GROUP BY `from`", $this->db->real_escape_string($this->id)));
						// Fetch the chat
						while($row = $checkChats->fetch_assoc()) {
							$chats[] = $row;
						}
					}
				}
				
				// If there are no new (unread) notifications (for the drop-down wdigets), get the lastest notifications
				if(!$for) {
					// Verify for the drop-down notifications
					if(empty($likes) && empty($comments) && empty($shares) && empty($friends) || $type == 2) {
						$all = 1;
					}
				} 
				// For the Notifications Page
				elseif($for == 2 && $type == 2) {
					// Verify for the notifications page
					$all = 1;
				}
				
				if($all) {
					// LR: Enable limit rows when there are unread messages
					$lr = 1;
					if($ln) {
						$checkLikes = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '2' ORDER BY `notifications`.`id` DESC LIMIT %s", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id), $limit));
						
						while($row = $checkLikes->fetch_assoc()) {
							$likes[] = $row;
						}
					}
					
					if($cn) {
						$checkComments = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '1' ORDER BY `notifications`.`id` DESC LIMIT %s", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id), $limit));
						
						while($row = $checkComments->fetch_assoc()) {
							$comments[] = $row;
						}
					}
					
					if($sn) {
						$checkShares = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '3' ORDER BY `notifications`.`id` DESC LIMIT %s", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id), $limit));
						
						while($row = $checkShares->fetch_assoc()) {
							$shares[] = $row;
						}
					}
					
					if($fn) {
						$checkFriends = $this->db->query(sprintf("SELECT * FROM `notifications`,`users` WHERE `notifications`.`from` = `users`.`idu` AND `notifications`.`to` = '%s' and `notifications`.`from` <> '%s' AND `notifications`.`type` = '4' ORDER BY `notifications`.`id` DESC LIMIT %s", $this->db->real_escape_string($this->id), $this->db->real_escape_string($this->id), $limit));
						
						while($row = $checkFriends->fetch_assoc()) {
							$friends[] = $row;
						}
					}
					
					if($for == 2) {
						if($dn) {
							$checkChats = $this->db->query(sprintf("SELECT * FROM (SELECT * FROM `chat`,`users` WHERE `chat`.`to` = '%s' AND `chat`.`from` = `users`.`idu` ORDER BY `id` DESC) as x GROUP BY `from` LIMIT %s", $this->db->real_escape_string($this->id), $limit));
						
							while($row = $checkChats->fetch_assoc()) {
								$chats[] = $row;
							}
						}
					}
					
					// If there are no latest notifications
					if($for == 2) {
						// Verify for the notifications page
						if(empty($likes) && empty($comments) && empty($shares) && empty($friends) && empty($chats)) {
							return '<div class="notification-row"><div class="notification-padding">'.$LNG['no_notifications'].'</a></div></div><div class="notification-row"><div class="notification-padding"><a href="'.$this->url.'/index.php?a=settings&b=notifications">'.$LNG['notifications_settings'].'</a></div></div>';
						}
					} else {
						// Verify for the drop-down notifications
						if(empty($likes) && empty($comments) && empty($shares) && empty($friends)) {
							return '<div class="notification-row"><div class="notification-padding">'.$LNG['no_notifications'].'</a></div></div>';
						}
					}
				}
			}
			
			// Add the types into the recursive array results
			$x = 0;
			foreach($likes as $like) {
				$likes[$x]['event'] = 'like';
				$x++;
			}
			$y = 0;
			foreach($comments as $comment) {
				$comments[$y]['event'] = 'comment';
				$y++;
			}
			$z = 0;
			foreach($shares as $share) {
				$shares[$z]['event'] = 'shared';
				$z++;
			}
			$a = 0;
			foreach($friends as $friend) {
				$friends[$a]['event'] = 'friend';
				$a++;
			}
			$b = 0;
			foreach($chats as $chat) {
				$chats[$b]['event'] = 'chat';
				$b++;
			}
			
			$array = array_merge($likes, $comments, $shares, $friends, $chats);

			// Sort the array
			usort($array, 'sortDateAsc');
			
			$i = 0;
			foreach($array as $value) {
				if($i == $limit && $lr == 1) break;
				$time = $value['time']; $b = '';
				if($this->time == '0') {
					$time = date("c", strtotime($value['time']));
				} elseif($this->time == '2') {
					$time = $this->ago(strtotime($value['time']));
				} elseif($this->time == '3') {
					$date = strtotime($value['time']);
					$time = date('Y-m-d', $date);
					$b = '-standard';
				}
				$events .= '<div class="notification-row'.(($value['read'] == 0 && $value['event'] == 'chat') ? ' notification-unread' : '').'"><div class="notification-padding">';
				if($value['event'] == 'like') {
					$events .= '<div class="notification-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="notification-text"><a href="'.$this->url.'/index.php?a=profile&u='.$value['username'].'">'.sprintf($LNG['new_like_notification'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['parent']).'.<br /><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/like_n.png" width="17" height="17" /><span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
				} elseif($value['event'] == 'comment') {
					$events .= '<div class="notification-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="notification-text">'.sprintf($LNG['new_comment_notification'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['parent'].'#'.$value['child']).'.<br /><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/comment_n.png" width="17" height="17" /><span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
				} elseif($value['event'] == 'shared') {
					$events .= '<div class="notification-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="notification-text">'.sprintf($LNG['new_shared_notification'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['child']).'.<br /><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/shared_n.png" width="17" height="17" /><span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
				} elseif($value['event'] == 'friend') {
					$events .= '<div class="notification-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="notification-text">'.sprintf($LNG['new_friend_notification'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name'])).'.<br /><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/friendships_n.png" width="17" height="17" /><span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
				} elseif($value['event'] == 'chat') {
					$events .= '<div class="notification-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="notification-text">'.sprintf($LNG['new_chat_notification'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=messages&u='.$value['username'].'&id='.$value['idu']).'.<br /><span class="chat-snippet">'.$this->parseMessage(substr($value['message'], 0, 45)).'...</span><br /><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/chat_n.png" width="17" height="17" /><span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
				}
				$events .= '</div></div>';
				$i++;
			}
			
			if(!$for) {
				// Mark global notifications as read
				$this->db->query("UPDATE `notifications` SET `read` = '1', `time` = `time` WHERE `to` = '{$this->id}' AND `read` = '0'");
			} 
			// Update when the for is set, and it's not viewed from the Notifications Page
			elseif($type !== 2) {
				// Mark chat messages notifications as read
				$this->db->query("UPDATE `chat` SET `read` = '1', `time` = `time` WHERE `to` = '{$this->id}' AND `read` = '0'");
			}
			// return the result
			return $events;
		}
		
		// If no notification was returned, return 0
	}
	
	function chatButton($id, $username, $z = null) {
		// Profile: Returns the current row username
		// Z: A switcher for the sublist CSS class
		global $LNG;
		if($z == 1) {
			$style = ' subslist_message';
		}
		if(!empty($this->username) && $this->username !== $username) {
			return '<a href="'.$this->url.'/index.php?a=messages&u='.$username.'&id='.$id.'" title="'.$LNG['send_message'].'"><div class="message_btn'.$style.'"></div></a>';
		}
	}
	
	function getSubscribe($type = null, $list = null, $z = null) {
		global $LNG;
		// Type 0: Just show the button
		// Type 1: Go trough the add friend query
		// List: Array (for the dedicated profile page list)
		// Z: A switcher for the sublist CSS class
		if($list) {
			$profile = $list;
		} else {
			$profile = $this->profile_data;
		}
		if($z == 1) {
			$style = ' subslist';
		}
		
		// Avoid queries search for abuse avoid, Repro: 5 users follows $X, then $X goes private, the button to unfollow remains active to offer the possibility to unfollow
		
		// Verify if the profile is completely private
		if($profile['private'] == 1) {
			// Run the query only if the user is logged-in
			if($this->id) {
				$avoid = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `leader` = '%s' AND `subscriber` = '%s'", $this->db->real_escape_string($profile['idu']), $this->db->real_escape_string($this->id)));
			}
			if($avoid->num_rows == 0) {
				if($this->username == $profile['username']) {
					// Set a variable if the profile is private and the one who views the profile is the owner, then show settings button
					$a = 1;
				} else {
					return false;
				}
			}
		} elseif($profile['private'] == 2) {
			if($this->id) {
				$avoid = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `leader` = '%s' AND `subscriber` = '%s'", $this->db->real_escape_string($profile['idu']), $this->db->real_escape_string($this->id)));
				
				// If the user have semi-private profile, hide the add button
				$result = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `subscriber` = '%s' AND `leader` = '%s'", $this->db->real_escape_string($profile['idu']), $this->db->real_escape_string($this->id)));
			}
			if($result->num_rows == 0 && $avoid->num_rows == 0) {
				if($this->username == $profile['username']) {
					// Set a variable if the profile is semi-private and the one who views the profile is the owner, then show settings button
					$a = 1;
				} else {
					return false;
				}
			}
		}
		
		// Verify if the username is logged in, and it's not the same with the viewed profile
		if(!empty($this->username) && $this->username !== $profile['username']) {
			if($type) {
				$result = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `subscriber` = '%s' AND `leader` = '%s'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($profile['idu'])));
				
				// If a relationship already exist, then remove
				if($result->num_rows) {
					$result = $this->db->query(sprintf("DELETE FROM `relations` WHERE `subscriber` = '%s' AND `leader` = '%s'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($profile['idu'])));
					$insertNotification = $this->db->query(sprintf("DELETE FROM `notifications` WHERE `from` = '%s' AND `to` = '%s' AND `type` = '4'", $this->db->real_escape_string($this->id), $profile['idu']));
				} else {
					$result = $this->db->query(sprintf("INSERT INTO `relations` (`subscriber`, `leader`, `time`) VALUES ('%s', '%s', CURRENT_TIMESTAMP)", $this->db->real_escape_string($this->id), $this->db->real_escape_string($profile['idu'])));
					$insertNotification = $this->db->query(sprintf("INSERT INTO `notifications` (`from`, `to`, `type`, `read`) VALUES ('%s', '%s', '4', '0')", $this->db->real_escape_string($this->id), $profile['idu']));
					
					if($this->email_new_friend) {
						// If user has emails on new friendships enabled
						if($profile['email_new_friend']) {
							// Send e-mail
							sendMail($profile['email'], sprintf($LNG['ttl_new_friend_email'], $this->username), sprintf($LNG['new_friend_email'], realName($profile['username'], $profile['first_name'], $profile['last_name']), $this->url.'/index.php?a=profile&u='.$this->username, $this->username, $this->title, $this->url.'/index.php?a=settings&b=notifications'), $this->email);
						}
					}
				}
			}
		} elseif($this->username == $profile['username'] || $a == 1) {
			return '<a href="'.$this->url.'/index.php?a=settings&b=avatar" title="'.$LNG['edit_profile_cover'].'"><div class="edit_profile_btn'.$style.'"></div></a>';
		} else {
			return false;
		}
		
		$result = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `subscriber` = '%s' AND `leader` = '%s'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($profile['idu'])));
		if($result->num_rows) {
			return '<div class="subscribe_btn unsubscribe'.$style.'" title="'.$LNG['remove_friend'].'" onclick="subscribe('.$profile['idu'].', 1'.(($z == 1) ? ', 1' : '').')"></div>';
		} else {
			return '<div class="subscribe_btn'.$style.'" title="'.$LNG['add_friend'].'" onclick="subscribe('.$profile['idu'].', 1'.(($z == 1) ? ', 1' : '').')"></div>';
		}
	}
	
	function showError($error) {
		global $LNG;
		$message = '<div class="message-container"><div class="message-content"><div class="message-header">'.$LNG[$error.'_ttl'].'</div><div class="message-inner">'.$LNG["$error"].'</div></div></div>';
		
		return array($message, 1);
	
	}
	
	function verifyRelationship($user_id, $profile_id, $type) {
		// Type 0: The viewed profile subscribed to the logged in username
		// Type 1: The logged in username is a subscriber of the viewed profile
		if($type == 0) {
			$result = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `subscriber` = '%s' AND `leader` = '%s'", $this->db->real_escape_string($profile_id), $this->db->real_escape_string($user_id)));
		} elseif($type == 1) {
			$result = $this->db->query(sprintf("SELECT * FROM `relations` WHERE `leader` = '%s' AND `subscriber` = '%s'", $this->db->real_escape_string($profile_id), $this->db->real_escape_string($user_id)));
		}
		
		
		// If the logged in username is the same with the viewed profile
		if($user_id == $profile_id) {
			return 2;
		}
		// If a relationship exist
		elseif($result->num_rows) {
			return 1;
		} else {
			return 0;
		}
	}

	function getMessage($id) {
		// Obey the message privacy to the profile privacy and then to the message privacy
		$query = $this->db->query(sprintf("SELECT `idu`,`username`,`private` FROM messages, users WHERE messages.id = '%s' AND messages.uid = users.idu", $this->db->real_escape_string($id)));
		$result = $query->fetch_assoc();
		
		$relationship = $this->verifyRelationship($this->id, $result['idu'], 0);
			
		// Check privacy
		switch($result['private']) {
			case 0:
				break;
			case 1:
				// Check if the username is not same with the profile
				if($result['username'] !== $this->username) {
					$x = 1;
				}
				break;
			case 2:
				// Check relationship
				if(!$relationship) {
					$x = 1;
				}
				break;
		}
		
		// Override any settings and grant admin permissions
		if($this->is_admin) {
			$x = 0;
		}
		
		// Get the message for Messages Page
		$query = sprintf("SELECT * FROM messages, users WHERE messages.id = '%s' AND messages.uid = users.idu", $this->db->real_escape_string($id));
		
		if($x) {
			return $this->showError('message_hidden');
		} else {
			return $this->getMessages($query, null, null);
		}
	}
	
	function getLastMessage() {
		$query = sprintf("SELECT * FROM `messages`, `users` WHERE `uid` = '%s' AND `messages`.`uid` = `users`.`idu` ORDER BY `id` DESC LIMIT 0, 1", $this->db->real_escape_string($this->id));
		
		$message = $this->getMessages($query, $start, '', '');
		return $message[0];
	}
	
	function getComments($id, $cid, $start) {
		global $LNG;
		// The query to select the subscribed users
		
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'AND comments.id < \''.$this->db->real_escape_string($cid).'\'';
		}
		$query = sprintf("SELECT * FROM comments, users WHERE comments.mid = '%s' AND comments.uid = users.idu %s ORDER BY comments.id DESC LIMIT %s", $this->db->real_escape_string($id), $start, ($this->c_per_page + 1));

		// check if the query was executed
		if($result = $this->db->query($query)) {
			
			// Set the result into an array
			$rows = array();
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			$rows = array_reverse($rows);
			
			// Define the $comments variable;
			$comments = '';
			
			// If there are more results available than the limit, then show the Load More Comments
			if(array_key_exists($this->c_per_page, $rows)) {
				$loadmore = 1;
				
				// Unset the first array element because it's not needed, it's used only to predict if the Load More Comments should be displayed
				unset($rows[0]);
			}
			
			foreach($rows as $comment) {
				// Define the time selected in the Admin Panel
				$time = $comment['time']; $b = '';
				if($this->time == '0') {
					$time = date("c", strtotime($comment['time']));
				} elseif($this->time == '2') {
					$time = $this->ago(strtotime($comment['time']));
				} elseif($this->time == '3') {
					$date = strtotime($comment['time']);
					$time = date('Y-m-d', $date);
					$b = '-standard';
				}
				
				if($this->username == $comment['username']) { // If it's current username is the same with the current author
					$delete = '<a onclick="delete_the('.$comment['id'].', 0)" title="'.$LNG['delete_this_comment'].'"><div class="delete_btn"></div></a>';
				} elseif(empty($this->username)) { // If the user is not registered
					$delete = '';
				} else { // If the current username is not the same as the author
					$delete = '<a onclick="report_the('.$comment['id'].', 0)" title="'.$LNG['report_this_comment'].'"><div class="report_btn"></div></a>';
				}
				
				// Variable which contains the result
				$comments .= '
				<div class="message-reply-container" id="comment'.$comment['id'].'">
					'.$delete.'
					<div class="message-reply-avatar">
						<a href="'.$this->url.'/index.php?a=profile&u='.$comment['username'].'"><img onmouseover="profileCard('.$comment['idu'].', '.$comment['id'].', 1, 0)" onmouseout="profileCard(0, 0, 1, 1);" onclick="profileCard(0, 0, 1, 1);" src="'.$this->url.'/thumb.php?src='.$comment['image'].'&t=a" /></a>
					</div>
					<div class="message-reply-message">
						<span class="message-reply-author"><a href="'.$this->url.'/index.php?a=profile&u='.$comment['username'].'">'.realName($comment['username'], $comment['first_name'], $comment['last_name']).'</a></span>: '.$this->parseMessage($comment['message']).'
						<div class="message-time">
							<div class="timeago'.$b.'" title="'.$time.'">
								'.$time.'
							</div>
						</div>
					</div>
					<div class="delete_preloader" id="del_comment_'.$comment['id'].'"></div>
					
				</div>';
				$message_id = $comment['mid'];
			}
			
			if($loadmore) {
				$load = '<div class="load-more-comments" id="more_comments_'.htmlentities($id, ENT_QUOTES).'"><a onclick="loadComments('.$message_id.', '.$rows[1]['id'].', '.($start + $this->c_per_page).')">'.$LNG['view_more_comments'].'</a></div>';
			}
			
					
			// Close the query
			$result->close();
			
			// Return the comments variable
			return $load.$comments;
		} else {
			return false;
		}
	}
	
	function parseWww($url) {
		if(substr($url, 1, 5) == 'www.') {
			$url = 'http://'.$url;
		}
		var_dump($url);
		return $url;
	}
	
	function parseMessage($message) {
		global $LNG, $CONF;
		
		// Parse links
		$parseUrl = preg_replace_callback('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?\AB\BB\93\94\91\92]))/', "parseCallback", $message);
		
		// Parse @mentions and #hashtags
		$parsedMessage = preg_replace(array('/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#(\w+)/u'), array('$1<a href="'.$this->url.'/index.php?a=profile&u=$2">@$2</a>', '$1<a href="'.$this->url.'/index.php?a=search&tag=$2">#$2</a>'), $parseUrl);
		
		// Define the censored words
		$censored = explode(',', $this->censor);
		
		// Strip any html tags except anchors, and replace any bad words
		$parsedMessage = str_replace($censored, $LNG['censored'], $parsedMessage);
		
		// Define smiles
		$smiles = array(
			'xD'	=> 'devil.png',
			'>:)'	=> 'devil.png',
			'x('	=> 'angry.png',
			':(('	=> 'cry.png',
			':*'	=> 'kiss.png',
			':))'	=> 'laugh.png',
			':D'	=> 'laugh.png',
			':-D'	=> 'laugh.png',
			':x'	=> 'love.png',
			'(:|'	=> 'sleepy.png',
			':)'	=> 'smile.png',
			':-)'	=> 'smile.png',
			':('	=> 'sad.png',
			':-('	=> 'sad.png',
			';)'	=> 'wink.png',
			';-)'	=> 'wink.png',
		);
		
		if($this->smiles) {
			foreach($smiles as $smile => $img) {
				$parsedMessage = str_replace($smile, '<img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/emoticons/'.$img.'" height="14" width="14" />', $parsedMessage);
			}
		}

		return $parsedMessage;
	}
	
	function getType($type, $value, $id) {
		global $LNG, $CONF;
		// Switch the case
		switch($type) {
		
			// If it's a map
			case "map":
				return '<div class="message-type-map event-map"><img src="https://maps.googleapis.com/maps/api/staticmap?center='.$value.'&zoom=13&size=700x150&maptype=roadmap&markers=color:red%7C'.$value.'&sensor=false&scale=2&visual_refresh=true" /></div>
				<div class="message-divider"></div>';
				break;
			
			// If it's a ate action
			case "food":
				return '<div class="message-type-general event-food"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/food.png" />'.sprintf($LNG['food'], $value).'</div>
				<div class="message-divider"></div>';
				break;
				
			// If it's a visit action
			case "visited":
				return '<div class="message-type-general event-visited"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/visited.png" />'.sprintf($LNG['visited'], $value).'</div>
				<div class="message-divider"></div>';
				break;
			
			// If it's a game action
			case "game":
				return '<div class="message-type-general event-game"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/game.png" />'.sprintf($LNG['played'], $value).'</div>
				<div class="message-divider"></div>';
				break;
				
			// If it's a movie action
			case "movie":
				return '<div class="message-type-general event-movie"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/movie.png" />'.sprintf($LNG['watched'], $value).'</div>
				<div class="message-divider"></div>';
				break;
			
			// If it's a music/song action
			case "music":
				// Explode each slash to determine the /username or find the users/ into the string [switch the height]
				$count = explode('/', $value);
				if(count($count) <= 2 || strpos($value, 'users/') !== false) {
					$height = '380';
				} else {
					$height = '120';
				}
				if(substr($value, 0, 3) == 'sc:') {
					return '<iframe width="100%" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https://soundcloud.com'.str_replace('sc:', '', $value).'"></iframe>';
				} else {
					return '<div class="message-type-general event-music"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/music.png" />'.sprintf($LNG['listened'], $value).'</div>
					<div class="message-divider"></div>';
				}
				break;
				
			// If it's a shared post
			case "shared":
				$shared = explode(':', $value);
				$message = $this->url.'/index.php?a=post&m='.$shared[0];
				$profile = $this->url.'/index.php?a=profile&u='.$shared[1];
				return '<div class="message-type-general event-shared"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/shared.png" />'.sprintf($LNG['shared'], $message, $profile, $shared[1]).'</div>
				<div class="message-divider"></div>';
				break;
			
			// If it's a picture
			case "picture":
				$images = explode(',', $value);
				if(count($images) == 1) {
					$result .= '<div class="message-type-image event-picture">';
					$i = 0;
					foreach($images as $image) {
						$result .= '<a onclick="gallery(\''.$image.'\', '.$id.', \'media\')" id="'.$image.'"><img src="'.$this->url.'/thumb.php?src='.$image.'&w=650&h=300&t=m" /></a>';
						$i++;
					}
				} else {
					$result .= '<div class="message-type-image event-picture"><div class="image-container-padding">';
					$i = 0;
					foreach($images as $image) {
						$result .= '<a onclick="gallery(\''.$image.'\', '.$id.', \'media\')" id="'.$image.'"><div class="image-thumbnail-container"><div class="image-thumbnail"><img src="'.$this->url.'/thumb.php?src='.$image.'&w=204&h=204&t=m" /></div></div></a>';
						$i++;
					}
					$result .= '</div>';
				}
				return $result.'</div><div class="message-divider"></div>';
				break;
			// If it's a video
			case "video":
				if(substr($value, 0, 3) == 'yt:') {
					return '<div class="message-type-player event-video"><iframe width="100%" height="315" src="//www.youtube.com/embed/'.str_replace('yt:', '', $value).'" frameborder="0" allowfullscreen></iframe></div>
					<div class="message-divider"></div>';
				} elseif(substr($value, 0, 3) == 'vm:') {
					return '<div class="message-type-player event-video"><iframe width="100%" height="315" src="http://player.vimeo.com/video/'.str_replace('vm:', '', $value).'" frameborder="0" allowfullscreen></iframe></div>
					<div class="message-divider"></div>';
				}
				
			// If it's empty
			case "":
				return false;
		}
	}
	
	function delete($id, $type) {
		// Type 0: Delete Comment
		// Type 1: Delete Message
		// Type 2: Delete Chat Message
		
		// Prepare the statement
		if($type == 0) {
			$stmt = $this->db->prepare("DELETE FROM `comments` WHERE `id` = '{$this->db->real_escape_string($id)}' AND `uid` = '{$this->db->real_escape_string($this->id)}'");
			
			// Set $x variable to 1 if the delete query is for `comments`
			$x = 0;
		} elseif($type == 1) {
			// Get the current type (for images deletion)
			$query = $this->db->query(sprintf("SELECT `type`, `value` FROM `messages` WHERE `id` = '%s'", $this->db->real_escape_string($id)));
			$row = $query->fetch_assoc();
			
			// Execute the deletePhotos function
			deletePhotos($row['type'], $row['value']);
			
			
			$stmt = $this->db->prepare("DELETE FROM `messages` WHERE `id` = '{$this->db->real_escape_string($id)}' AND `uid` = '{$this->db->real_escape_string($this->id)}'");
			
			// Set $x variable to 1 if the delete query is for `messages`
			$x = 1;
		} elseif($type == 2) {
			$stmt = $this->db->prepare("DELETE FROM `chat` WHERE `id` = '{$this->db->real_escape_string($id)}' AND `from` = '{$this->db->real_escape_string($this->id)}'");
			
			$x = 2;
		}

		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;
		
		// Close the statement
		$stmt->close();
		
		// If the messages/comments table was affected
		if($affected) {
			// Deletes the Comments/Likes/Reports if the Message was deleted
			if($x == 1) {
				$this->db->query("DELETE FROM `comments` WHERE `mid` = '{$this->db->real_escape_string($id)}'");
				$this->db->query("DELETE FROM `likes` WHERE `post` = '{$this->db->real_escape_string($id)}'");
				$this->db->query("DELETE FROM `reports` WHERE `post` = '{$this->db->real_escape_string($id)}' AND `parent` = '0'");
				$this->db->query("DELETE FROM `notifications` WHERE `parent` = '{$this->db->real_escape_string($id)}'");
			} elseif($x == 0) {
				$this->db->query("DELETE FROM `reports` WHERE `post` = '{$this->db->real_escape_string($id)}' AND `parent` != '0'");
				$this->db->query("DELETE FROM `notifications` WHERE `child` = '{$this->db->real_escape_string($id)}' AND `type` = '1'");
			}
		}
		
		return ($affected) ? 1 : 0;
	}
	
	function report($id, $type) {
		global $LNG;
		// Check if the Message exists
		if($type == 1) {
			$result = $this->db->query(sprintf("SELECT `id` FROM `messages` WHERE `id` = '%s'", $this->db->real_escape_string($id)));
		} else {
			$result = $this->db->query(sprintf("SELECT `id`,`mid` FROM `comments` WHERE `id` = '%s'", $this->db->real_escape_string($id)));
			$parent = $result->fetch_array(MYSQLI_ASSOC); 
		}
		// If the Message/Comment exists
		if($result->num_rows) {
			$result->close();
		
			// Get the report status, 0 = already exists * 1 = is safe
			$query = sprintf("SELECT `state` FROM `reports` WHERE `post` = '%s' AND `type` = '%s'", $this->db->real_escape_string($id), $this->db->real_escape_string($type));
			$result = $this->db->query($query);
			$state = $result->fetch_assoc();
			
			//  If the report already exists
			if($result->num_rows) {
				// If the comment state is 0, then already exists
				if($state['state'] == 0) {
					return $LNG["{$type}_already_reported"];
				} elseif($state['state'] == 1) {
					return $LNG["{$type}_is_safe"];
				} else {
					return $LNG["{$type}_is_deleted"];
				}
			} else {
				$stmt = $this->db->prepare(sprintf("INSERT INTO `reports` (`post`, `parent`, `by`, `type`) VALUES ('%s', '%s', '%s', '%s')", $this->db->real_escape_string($id), ($parent['mid']) ? $parent['mid'] : 0, $this->db->real_escape_string($this->id), $this->db->real_escape_string($type)));

				// Execute the statement
				$stmt->execute();
				
				// Save the affected rows
				$affected = $stmt->affected_rows;

				// Close the statement
				$stmt->close();
				
				// If the comment was added, return 1
				return ($affected) ? $LNG["{$type}_report_added"] : $LNG["{$type}_report_error"];
			}
		} else {
			return $LNG["{$type}_not_exists"];
		}
	}
	
	function addComment($id, $comment) {
		// Check if the POST is public
		$query = sprintf("SELECT * FROM `messages`,`users` WHERE `id` = '%s' AND `messages`.`uid` = `users`.`idu`", $this->db->real_escape_string($id));
		$result = $this->db->query($query);

		$row = $result->fetch_assoc();

		// If the POST is public
		if($row['public'] == 1) {
			// Add the insert message
			$stmt = $this->db->prepare("INSERT INTO `comments` (`uid`, `mid`, `message`) VALUES ('{$this->db->real_escape_string($this->id)}', '{$this->db->real_escape_string($id)}', '{$this->db->real_escape_string(htmlspecialchars($comment))}')");

			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;

			// Close the statement
			$stmt->close();
			
			// Select the last inserted message
			$getId = $this->db->query(sprintf("SELECT `id`,`uid`,`mid` FROM `comments` WHERE `uid` = '%s' AND `mid` = '%s' ORDER BY `id` DESC", $this->db->real_escape_string($this->id), $row['id']));
			$lastComment = $getId->fetch_assoc();
			
			// Do the INSERT notification
			$insertNotification = $this->db->query(sprintf("INSERT INTO `notifications` (`from`, `to`, `parent`, `child`, `type`, `read`) VALUES ('%s', '%s', '%s', '%s', '1', '0')", $this->db->real_escape_string($this->id), $row['uid'], $row['id'], $lastComment['id']));
			
			if($affected) {
				// If email on likes is enabled in admin settings
				if($this->email_comment) {
				
					// If user has emails on like enabled and it\'s not liking his own post
					if($row['email_comment'] && ($this->id !== $row['idu'])) {
						global $LNG;
						
						// Send e-mail
						sendMail($row['email'], sprintf($LNG['ttl_comment_email'], $this->username), sprintf($LNG['comment_email'], realName($row['username'], $row['first_name'], $row['last_name']), $this->url.'/index.php?a=profile&u='.$this->username, $this->username, $this->url.'/index.php?a=post&m='.$id, $this->title, $this->url.'/index.php?a=settings&b=notifications'), $this->email);
					}
				}
			}
			
			// If the comment was added, return 1
			return ($affected) ? 1 : 0;
		} else {
			return 0;
		}
	}
	
	function getLastComment() {
		// Select the last comment from the logged-in user
		$query = sprintf("SELECT * FROM `comments`, `users` WHERE `uid` = '%s' AND `comments`.`uid` = `users`.`idu` ORDER BY `id` DESC LIMIT 0, 1", $this->db->real_escape_string($this->id));
		
		// If the select was made
		if($result = $this->db->query($query)) {
			
			// Set the result into an array
			$row = $result->fetch_assoc();

			// Define the time selected in the Admin Panel
			$time = $row['time']; $b = '';
			if($this->time == '0') {
				$time = date("c", strtotime($row['time']));
			} elseif($this->time == '2') {
				$time = $this->ago(strtotime($row['time']));
			} elseif($this->time == '3') {
				$date = strtotime($row['time']);
				$time = date('Y-m-d', $date);
				$b = '-standard';
			}			
			
			// Variable which contains the result
			$comment = '
			<div class="message-reply-container" id="comment'.$row['id'].'" style="display: none">
				<a onclick="delete_the('.$row['id'].', 0)"><div class="delete_btn"></div></a>
				<div class="message-reply-avatar">
					<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a" /></a>
				</div>
				<div class="message-reply-message">
					<span class="message-reply-author"><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.realName($row['username'], $row['first_name'], $row['last_name']).'</a></span>: '.$this->parseMessage($row['message']).'
					<div class="message-time">
						<div class="timeago'.$b.'" title="'.$time.'">
							'.$time.'
						</div>
					</div>
				</div>
				<div class="delete_preloader" id="del_comment_'.$row['id'].'"></div>
				
			</div>';
			
			return $comment;
		} else {
			return false;
		}
	}
	
	function changePrivacy($id, $value) {
		$stmt = $this->db->prepare("UPDATE `messages` SET `public` = '{$this->db->real_escape_string($value)}' WHERE `id` = '{$this->db->real_escape_string($id)}' AND `uid` = '{$this->db->real_escape_string($this->id)}'");
		
		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;
		
		// Close the statement
		$stmt->close();
		
		return ($affected) ? 1 : 0;
	}
	
	function ago($i){
		$m = time()-$i; $o='just now';
		$t = array('year'=>31556926,'month'=>2629744,'week'=>604800, 'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
		foreach($t as $u=>$s){
			if($s<=$m){$v=floor($m/$s); $o="$v $u".($v==1?'':'s').' ago'; break;}
		}
		return $o;
	}
		
	function sidebarGender($bold) {
		global $LNG, $CONF;
		
		// Start the output
		$row = array('male', 'female');
		$link = '<div class="sidebar-container widget-gender"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['filter_gender'].'</div>';
		$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].'&q='.htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8').'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/filters/all.png" />'.$LNG["all_genders"].'</a></div>';
		foreach($row as $type) {
			// Start the strong tag
			if($type == $bold) {
				$link .= '<strong>';
			}
			// Output the links
			
			$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].'&q='.htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8').'&filter='.substr($type, 0, 1).'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/filters/'.$type.'.png" />'.$LNG["sidebar_{$type}"].'</a></div>';
			
			// Close the Strong tag
			if($type == $bold) {
				$link .= '</strong>';
			}
		}
		$link .= '</div></div>';
		return $link;
		
	}
	
	function sidebarNotifications($bold) {
		global $LNG, $CONF;
		
		// Start the output
		$row = array('likes', 'comments', 'shared', 'friendships', 'chats');
		$link = '<div class="sidebar-container widget-notifications"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['filter_events'].'</div>';
		$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/all.png" />'.$LNG["all_events"].'</a></div>';
		foreach($row as $type) {
			// Start the strong tag
			if($type == $bold) {
				$link .= '<strong>';
			}
			// Output the links
			
			$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].'&filter='.$type.'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/'.$type.'.png" />'.$LNG["sidebar_{$type}"].'</a></div>';
			
			// Close the Strong tag
			if($type == $bold) {
				$link .= '</strong>';
			}
		}
		$link .= '</div></div>';
		return $link;
	}
	
	function sidebarTypes($bold, $values = null) {
		global $LNG, $CONF;
		$row = $this->listTypes($values);

		$profile = ($this->profile) ? '&u='.$this->profile : '';
		// If the result is not empty
		if($row) {
			// Start the output
			$link = '<div class="sidebar-container widget-types"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['filter_events'].'</div>';
			$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].$profile.'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/all.png" />'.$LNG["all_events"].'</a></div>';
			foreach($row as $type) {
				// Start the strong tag
				if($type == $bold) {
					$link .= '<strong>';
				}
				// Output the links
				
				$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].$profile.'&filter='.$type.'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/events/'.$type.'.png" />'.$LNG["sidebar_{$type}"].'</a></div>';
				
				// Close the Strong tag
				if($type == $bold) {
					$link .= '</strong>';
				}
			}
			$link .= '</div></div>';
			return $link;
		}
	}
	
	function sidebarDates($bold, $values = null) {
		global $LNG;
		$row = $this->listDates($values);
		
		$profile = ($this->profile) ? '&u='.$this->profile : '';
		// If the result is not empty
		if($row) {
			// Start the output
			$link = '<div class="sidebar-container widget-archive"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['archive'].'</div>';
			$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].$profile.'">'.$LNG["all_time"].'</a></div>';
			foreach($row as $date) {
				
				// Explode the born value [[0]=>Y,[1]=>M];
				$born = explode('-', wordwrap($date, 4, '-', true));
				
				// Make it into integer instead of a string (removes the 0, e.g: 03=>3, prevents breaking the language)
				$month = intval($born[1]);
				
				// Start the strong tag
				if($date == $bold) {
					$link .= '<strong>';
				}
				
				// Output the links
				$link .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a='.$_GET['a'].$profile.'&filter='.$date.'">'.$LNG["month_{$month}"].' - '.$born[0].'</a></div>';
				
				// Close the Strong tag
				if($date == $bold) {
					$link .= '</strong>';
				}
			}
			$link .= '</div></div>';
			return $link;
		}
	}
	
	function listTypes($values = null) {
		if($values == false) {
			return false;
		} elseif($values == 'timeline') {
			$query = sprintf("SELECT DISTINCT `type` FROM `messages` WHERE uid = '%s'", $this->db->real_escape_string($this->id));
		} elseif($values == 'profile') {
			$profile = ($this->profile == $this->username) ? '' : 'AND public = 1';
			$query = sprintf("SELECT DISTINCT `type` FROM `messages` WHERE uid = '%s' %s", $this->db->real_escape_string($this->profile_id), $profile);
		} elseif($values) {
			$query = sprintf("SELECT DISTINCT `type` FROM `messages` WHERE uid IN (%s) AND `public` = 1", $this->db->real_escape_string($values));
		}
		$result = $this->db->query($query);
		
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		// If the select was made
		if($result = $this->db->query($query)) {
			// Define the array;
			$store = array();
			foreach($rows as $type) {
				// Check for the result not to be empty
				if(!empty($type['type'])) {
					// Add the elemnts to the array
					$store [] = $type['type'];
				}
			}
			return $store;
		} else {
			return false;
		}
	}
	
	function listDates($values = null) {
		if($values == false) {
			return false;
		} elseif($values == 'timeline') {
			$query = sprintf("SELECT DISTINCT extract(YEAR_MONTH from `time`) AS dates FROM `messages` WHERE uid = '%s' ORDER BY `time` DESC", $this->db->real_escape_string($this->id));
		} elseif($values == 'profile') {
			$profile = ($this->profile == $this->username) ? '' : 'AND public = 1';
			$query = sprintf("SELECT DISTINCT extract(YEAR_MONTH from `time`) AS dates FROM `messages` WHERE uid = '%s' %s ORDER BY `time` DESC", $this->db->real_escape_string($this->profile_id), $profile);
		} elseif($values) {
			$query = sprintf("SELECT DISTINCT extract(YEAR_MONTH from `time`) AS dates FROM `messages` WHERE uid IN (%s) AND `public` = 1 ORDER BY `time` DESC", $this->db->real_escape_string($values));
		}
		
		$result = $this->db->query($query);
				
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		// If the select was made
		if($result = $this->db->query($query)) {
			// Define the array;
			$store = array();
			foreach($rows as $date) {
				// Add the elemnts to the array
				$store [] = $date['dates'];
			}
			return $store;
		} else {
			return false;
		}
	}
	
	function sidebarSubs($type, $for) {
		global $LNG;
		if($type == 0) {
			$result = $this->subscriptionsList;
			$title = $LNG['subscriptions'];
			$r = 'subscriptions';
		} else {
			$result = $this->subscribersList;
			$title = $LNG['subscribers'];
			$r = 'subscribers';
		}
		
		// If the select was made
		if($result[1] > 0) {
			if($for == 0) {
				$i = 0;
				$output = '<div class="sidebar-container widget-'.$r.'"><div class="sidebar-content"><div class="sidebar-header"><a href="'.$this->url.'/index.php?a=profile&u='.((!empty($this->profile)) ? $this->profile : $this->username).'&r='.$r.'">'.$title.' <span class="sidebar-header-light">('.$result[1].')</span></a></div>';
				foreach($result[0] as $row) {
					if($i == 6) break; // Display only the last 6 subscriptions
					$username = realName($row['username'], $row['first_name'], $row['last_name']);
					// Add the elemnts to the array
					$output .= '<div class="sidebar-subscriptions"><div class="sidebar-title-container"><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><div class="sidebar-title-name">'.$username.'</div></a></div><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=112&h=112" /></a></div>';
					$i++;
				}
				$output .= '</div></div>';
			} elseif($for == 1) {
				$output = '<strong><a href="'.$this->url.'/index.php?a=profile&u='.((!empty($this->profile)) ? $this->profile : $this->username).'&r='.$r.'">'.$result[1].' '.$LNG['people'].'</strong></a>';
			}
			return $output;
		} else {
			return false;
		}
	}
	
	function onlineUsers($type = null, $value = null) {
		global $LNG, $CONF;
		// Type 2: Show the Friends Results for the live search for Chat/Messages
		//		 : If value is set, find friends from Subscriptions
		// Type 1: Display the friends for the Chat/Messages page
		//		 : If value is set, find exact username
		// Type 0: Display the friends for feed/timeline page
		
		// Get the subscritions
		$subscriptions = $this->getSubscriptionsList();
		$currentTime = time();

		if(!empty($subscriptions)) {
			if($type == 1) {
				if($value) {
					// Search for an exact username match [PM System]
					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `username` = '%s'", $this->db->real_escape_string($value)));
				} else {
					// Display current friends
					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `idu` IN (%s) ORDER BY `online` DESC", $this->db->real_escape_string($subscriptions)));
				}
			} elseif($type == 2) {
				if($value) {
					// Search in friends
					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE (`username` LIKE '%s' OR concat_ws(' ', `first_name`, `last_name`) LIKE '%s') AND `idu` IN (%s) ORDER BY `online` DESC", '%'.$this->db->real_escape_string($value).'%', '%'.$this->db->real_escape_string($value).'%', $this->db->real_escape_string($subscriptions)));
				} else {
					// Display current friends
					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `idu` IN (%s) ORDER BY `online` DESC", $this->db->real_escape_string($subscriptions)));
				}
			} else {
				// Display the online friends (used in Feed/Subscriptions)
				$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `idu` IN (%s) AND `online` > '%s'-'%s' ORDER BY `online` DESC", $this->db->real_escape_string($subscriptions), $currentTime, $this->online_time));
			}
			
			// Store the array results
			while($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		
		// usort($rows, 'sortOnlineUsers');
		
		if($type == 1) {
			// Output the users
			$output = '<div class="sidebar-container widget-online-users"><div class="sidebar-content"><div class="sidebar-header"><input type="text" placeholder="'.$LNG['search_in_friends'].'"  id="search-list" /></div><div class="search-list-container"></div><div class="sidebar-chat-list">';
			if(!empty($rows)) {
				$i = 0;
				foreach($rows as $row) {
					// Switch the images, depending on the online state
					if(($currentTime - $row['online']) > $this->online_time) {
						$icon = 'offline';
					} else {
						$icon = 'online';
					}
					
					$output .= '<div class="sidebar-users"><a onclick="loadChat('.$row['idu'].', \''.$this->db->real_escape_string(realName($row['username'], $row['first_name'], $row['last_name'])).'\', 1)"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/'.$icon.'.png" class="sidebar-status-icon" /> <img src="'.$this->url.'/thumb.php?src='.$row['image'].'&w=25&h=25&t=a" /> '.realName($row['username'], $row['first_name'], $row['last_name']).'</a></div>';
					
					$i++;
				}
			} else {
				$output .= '<div class="sidebar-inner">'.$LNG['lonely_here'].'</div>';
			}
			$output .= '</div></div></div>';
		} elseif($type == 2) {
			$output = '';
			if(!empty($rows)) {
				$i = 0;
				foreach($rows as $row) {
					// Switch the images, depending on the online state
					if(($currentTime - $row['online']) > $this->online_time) {
						$icon = 'offline';
					} else {
						$icon = 'online';
					}
					
					$output .= '<div class="sidebar-users"><a onclick="loadChat('.$row['idu'].', \''.$this->db->real_escape_string(realName($row['username'], $row['first_name'], $row['last_name'])).'\', 1)"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/'.$icon.'.png" class="sidebar-status-icon" /> <img src="'.$this->url.'/thumb.php?src='.$row['image'].'&w=25&h=25&t=a" /> '.realName($row['username'], $row['first_name'], $row['last_name']).'</a></div>';
					
					$i++;
				}
			} else {
				$output .= '<div class="sidebar-inner">'.$LNG['no_results'].'</div>';
			}
		} else {
			// If the query has content
			if(!empty($rows)) {
				// Output the online users
				$output = '<div class="sidebar-container widget-online-users"><div class="sidebar-content"><div class="sidebar-header"><a href="'.$this->url.'/index.php?a=messages">'.$LNG['online_friends'].' <span class="sidebar-header-light">('.$query->num_rows.')</span></a></div>';
				
				$i = 0;
				foreach($rows as $row) {
					// Hide the rest of the users if it reaches the limit
					if($i == $this->friends_online) {
						$output .= '<div class="sidebar-users"><a href="'.$this->url.'/index.php?a=messages"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/online.png" class="sidebar-status-icon" /> <img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/users.png" width="25" height="25" /> View All</a></div>';
						break;
					}
					
					$output .= '<div class="sidebar-users"><a href="'.$this->url.'/index.php?a=messages&u='.$row['username'].'&id='.$row['idu'].'"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/online.png" class="sidebar-status-icon" /> <img src="'.$this->url.'/thumb.php?src='.$row['image'].'&w=25&h=25&t=a" /> '.realName($row['username'], $row['first_name'], $row['last_name']).'</a></div>';
					
					$i++;
				}
				$output .= '</div></div>';
			} else {
				return false;
			}
		}
		return $output;
	}
	
	function getChat($uid, $user) {
		global $LNG, $CONF;
		$output =	'<div class="message-container">
						<div class="message-content">
							<div class="message-form-header">
								<div class="message-form-user"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/chat.png"></div>
								<span class="chat-username">'.((empty($user['username'])) ? $LNG['conversation'] : realName($user['username'], $user['first_name'], $user['last_name'])).'</span><span class="blocked-button">'.$this->getBlocked($uid).'</span>
								<div class="message-loader" style="display: none"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/preloader.gif"></div>
							</div>
							<div class="chat-container">
								'.((empty($user['username'])) ? $this->chatError($LNG['start_conversation']) : $this->getChatMessages($uid)).'
							</div>
							<div class="message-divider"></div>

							<div class="chat-form-inner"><input id="chat" class="chat-user'.$uid.'" placeholder="'.$LNG['write_message'].'" name="chat" /></div>
						</div>	
					</div>'.audioContainer('Chat', $this->sound_new_chat);
		return $output;
	}
	
	function checkChat($uid) {
		$query = $this->db->query(sprintf("SELECT * FROM `chat` WHERE `from` = '%s' AND `to` = '%s' AND `read` = '0'",  $this->db->real_escape_string($uid), $this->db->real_escape_string($this->id)));
				
		if($query->num_rows) {
			return $this->getChatMessages($uid, null, null, 2); 
		}
		return false;
	}
	
	function getChatMessages($uid, $cid, $start, $type = null) {
		// uid = user id (from which user the message was sent)
		// cid = where the pagination will start
		// start = on/off
		// type 1: swtich the query to get the last message
		global $LNG;
		// The query to select the subscribed users

		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'AND `chat`.`id` < \''.$this->db->real_escape_string($cid).'\'';
		}
		
		if($type == 1) {
			$query = sprintf("SELECT * FROM `chat`, `users` WHERE (`chat`.`from` = '%s' AND `chat`.`to` = '%s' AND `chat`.`from` = `users`.`idu`) ORDER BY `chat`.`id` DESC LIMIT 1", $this->db->real_escape_string($this->id), $this->db->real_escape_string($uid));
		} elseif($type == 2) {
			$query = sprintf("SELECT * FROM `chat`,`users` WHERE `from` = '%s' AND `to` = '%s' AND `read` = '0' AND `chat`.`from` = `users`.`idu` ORDER BY `chat`.`id` DESC", $this->db->real_escape_string($uid), $this->db->real_escape_string($this->id));
		} else {
			$query = sprintf("SELECT * FROM `chat`, `users` WHERE (`chat`.`from` = '%s' AND `chat`.`to` = '%s' AND `chat`.`from` = `users`.`idu`) %s OR (`chat`.`from` = '%s' AND `chat`.`to` = '%s' AND `chat`.`from` = `users`.`idu`) %s ORDER BY `chat`.`id` DESC LIMIT %s", $this->db->real_escape_string($this->id), $this->db->real_escape_string($uid), $start, $this->db->real_escape_string($uid), $this->db->real_escape_string($this->id), $start, ($this->m_per_page + 1));
		}
		
		// check if the query was executed
		if($result = $this->db->query($query)) {
			
			if($type !== 1) {
				// Set the read status to 1 whenever you load messages [IGNORE TYPE: 1]
				$update = $this->db->query(sprintf("UPDATE `chat` SET `read` = '1', `time` = `time` WHERE `from` = '%s' AND `to` = '%s' AND `read` = '0'", $this->db->real_escape_string($uid), $this->db->real_escape_string($this->id)));
			}

			// Set the result into an array
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			$rows = array_reverse($rows);
			
			// Define the $output variable;
			$output = '';
			
			// If there are more results available than the limit, then show the Load More Chat Messages
			if(array_key_exists($this->m_per_page, $rows)) {
				$loadmore = 1;
				
				// Unset the first array element because it's not needed, it's used only to predict if the Load More Chat Messages should be displayed
				unset($rows[0]);
			}
			
			foreach($rows as $row) {
				// Define the time selected in the Admin Panel
				$time = $row['time']; $b = '';
				if($this->time == '0') {
					$time = date("c", strtotime($row['time']));
				} elseif($this->time == '2') {
					$time = $this->ago(strtotime($row['time']));
				} elseif($this->time == '3') {
					$date = strtotime($row['time']);
					$time = date('Y-m-d', $date);
					$b = '-standard';
				}
				
				if($this->username == $row['username']) { // If it's current username is the same with the current author
					$delete = '<a onclick="delete_the('.$row['id'].', 2)" title="'.$LNG['delete_this_message'].'"><div class="delete_btn"></div></a>';
				} else {
					$delete = '';
				}
				
				// Variable which contains the result
				$output .= '
				<div class="message-reply-container" id="chat'.$row['id'].'">
					'.$delete.'
					<div class="message-reply-avatar">
						<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a" /></a>
					</div>
					<div class="message-reply-message">
						<span class="message-reply-author"><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.realName($row['username'], $row['first_name'], $row['last_name']).'</a></span>: '.$this->parseMessage($row['message']).'
						<div class="message-time">
							<div class="timeago'.$b.'" title="'.$time.'">
								'.$time.'
							</div>
						</div>
					</div>
					<div class="delete_preloader" id="del_chat_'.$row['id'].'"></div>
					
				</div>';
				$start = $row['id'];
			}
			if($loadmore) {
				$load = '<div class="load-more-chat"><a onclick="loadChat('.htmlentities($uid, ENT_QUOTES).', \'\', \'\', '.$rows[1]['id'].', 1)">'.$LNG['view_more_conversations'].'</a></div>';
			}
					
			// Close the query
			$result->close();
			
			// Return the conversations
			return $load.$output;
		} else {
			return false;
		}
	}
	
	function postChat($message, $uid) {
		global $LNG;
		
		$user = $this->profileData(null, $uid);

		if(strlen($message) > $this->chat_length) {
			return $this->chatError(sprintf($LNG['chat_too_long'], $this->chat_length));
		} elseif($uid == $this->id) {
			return $this->chatError(sprintf($LNG['chat_self']));
		} elseif(!$user['username']) {
			return $this->chatError(sprintf($LNG['chat_no_user']));
		}

		$query = $this->db->query(sprintf("SELECT * FROM `blocked` WHERE `by` = '%s' AND uid = '%s'", $this->db->real_escape_string($this->id), $this->db->real_escape_string($uid)));
				
		if($query->num_rows) {
			return $this->chatError(sprintf($LNG['blocked_user'], realName($user['username'], $user['first_name'], $user['last_name'])));
		} else {
			$query = $this->db->query(sprintf("SELECT * FROM `blocked` WHERE `by` = '%s' AND uid = '%s'", $this->db->real_escape_string($uid), $this->db->real_escape_string($this->id)));
			
			if($query->num_rows) {
				return $this->chatError(sprintf($LNG['blocked_by'], realName($user['username'], $user['first_name'], $user['last_name'])));
			}
		}
			
		// Prepare the insertion
		$stmt = $this->db->prepare(sprintf("INSERT INTO `chat` (`from`, `to`, `message`, `read`, `time`) VALUES ('%s', '%s', '%s', '%s', CURRENT_TIMESTAMP)", $this->db->real_escape_string($this->id), $this->db->real_escape_string($uid), $this->db->real_escape_string(htmlspecialchars($message)), 0));

		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;

		// Close the statement
		$stmt->close();
		if($affected) {
			return $this->getChatMessages($uid, null, null, 1);
		}
	}
	
	function updateStatus($offline = null) {
		if(!$offline) {
			$this->db->query(sprintf("UPDATE `users` SET `online` = '%s' WHERE `idu` = '%s'", time(), $this->db->real_escape_string($this->id)));
		}
	}
	
	function chatError($value) {
		return '<div class="chat-error">'.$value.'</div>';
	}
	
	function sidebarPlaces($id) {
		global $LNG;
		
		// Get the maps posts (public if the logged in user is the same with the viewed profile)
		if($this->id == $id) {
			$query = $this->db->query(sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.type = 'map' AND messages.uid = users.idu ORDER BY messages.id DESC", $this->db->real_escape_string($id)));
		} else {
			$query = $this->db->query(sprintf("SELECT * FROM messages, users WHERE messages.uid = '%s' AND messages.type = 'map' AND messages.uid = users.idu AND `messages`.`public` = '1' ORDER BY messages.id DESC", $this->db->real_escape_string($id)));
		}

		// Store the array results
		while($row = $query->fetch_assoc()) {
			$rows[] = $row;
		}

		// If there are maps available
		if(!empty($rows)) {
			$i = 0;
			$output = '<div class="sidebar-container widget-subscriptions"><div class="sidebar-content"><div class="sidebar-header"><a href="'.$this->url.'/index.php?a=profile&u='.((!
			empty($this->profile)) ? $this->profile : $this->username).'&filter=map">'.$LNG['sidebar_map'].' <span class="sidebar-header-light">('.$query->num_rows.')</span></a></div>';
			foreach($rows as $row) {
				if($i == 6) break; // Display only the last 6 maps
				
				$output .= '<div class="sidebar-subscriptions"><div class="sidebar-title-container"><div class="sidebar-places-name">'.$row['value'].'</div></div><a href="'.$this->url.'/index.php?a=post&m='.$row['id'].'"><img src="https://maps.googleapis.com/maps/api/staticmap?center='.$row['value'].'&zoom=13&size=150x150&maptype=roadmap&sensor=false&scale=2&visual_refresh=true" /></a></div>';
				
				$i++;
			}
			$output .= '</div></div>';
			return $output;
		} else {
			return false;
		}
	}
	
	function sidebarFriendsActivity($limit, $type = null) {
		global $LNG, $CONF;

		$subscriptions = $this->getSubscriptionsList();
		// If there is no subscriptions, return false
		if(empty($subscriptions)) {
			return false;
		}
		
		// Define the arrays that holds the values (prevents the array_merge to fail, when one or more options are disabled)
		$likes = array();
		$comments = array();
		$messages = array();
		
		$checkLikes = $this->db->query(sprintf("SELECT * FROM `likes`,`users` WHERE `likes`.`by` = `users`.`idu` AND `likes`.`by` IN (%s) ORDER BY `id` DESC LIMIT %s", $subscriptions, 25));
		while($row = $checkLikes->fetch_assoc()) {
			$likes[] = $row;
		}
	
		$checkComments = $this->db->query(sprintf("SELECT * FROM `comments`,`users` WHERE `comments`.`uid` = `users`.`idu` AND `comments`.`uid` IN (%s) ORDER BY `id` DESC LIMIT %s", $subscriptions, 25));
		while($row = $checkComments->fetch_assoc()) {
			$comments[] = $row;
		}
	
		$checkMessages = $this->db->query(sprintf("SELECT * FROM `messages`,`users` WHERE `messages`.`uid` = `users`.`idu` AND `messages`.`uid` IN (%s) AND `messages`.`public` = '1' ORDER BY `id` DESC LIMIT %s", $subscriptions, 25));
		while($row = $checkMessages->fetch_assoc()) {
			$messages[] = $row;
		}
		
		// If there are no latest notifications
		if(empty($likes) && empty($comments) && empty($messages)) {
			return false;
		}
		
		// Add the types into the recursive array results
		$x = 0;
		foreach($likes as $like) {
			$likes[$x]['event'] = 'like';
			$x++;
		}
		$y = 0;
		foreach($comments as $comment) {
			$comments[$y]['event'] = 'comment';
			$y++;
		}
		$z = 0;
		foreach($messages as $message) {
			$messages[$z]['event'] = 'message';
			$z++;
		}
		
		$array = array_merge($likes, $comments, $messages);

		// Sort the array
		usort($array, 'sortDateAsc');
		
		$activity .= '<div class="sidebar-container widget-friends-activity"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['sidebar_friends_activity'].'</div><div class="sidebar-fa-content">';
		$i = 0;
		foreach($array as $value) {
			if($i == $limit) break;
			$time = $value['time']; $b = '';
			if($this->time == '0') {
				$time = date("c", strtotime($value['time']));
			} elseif($this->time == '2') {
				$time = $this->ago(strtotime($value['time']));
			} elseif($this->time == '3') {
				$date = strtotime($value['time']);
				$time = date('Y-m-d', $date);
				$b = '-standard';
			}
			$activity .= '<div class="notification-row"><div class="notification-padding">';
			if($value['event'] == 'like') {
				$activity .= '<div class="sidebar-fa-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="sidebar-fa-text"><a href="'.$this->url.'/index.php?a=profile&u='.$value['username'].'">'.sprintf($LNG['new_like_fa'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['post']).'. <span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
			} elseif($value['event'] == 'comment') {
				$activity .= '<div class="sidebar-fa-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="sidebar-fa-text">'.sprintf($LNG['new_comment_fa'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['mid']).'. <span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
			} elseif($value['event'] == 'message') {
				$activity .= '<div class="sidebar-fa-image"><img class="notifications" src='.$this->url.'/thumb.php?src='.$value['image'].'&t=a&w=50&h=50" /></div><div class="sidebar-fa-text">'.sprintf($LNG['new_message_fa'], $this->url.'/index.php?a=profile&u='.$value['username'], realName($value['username'], $value['first_name'], $value['last_name']), $this->url.'/index.php?a=post&m='.$value['id']).'. <span class="timeago'.$b.'" title="'.$time.'">'.$time.'</span></div>';
			}
			$activity .= '</div></div>';
			$i++;
		}
		$activity .= '</div></div></div>';
		
		return $activity;
	}
	
	function sidebarSuggestions() {
		global $LNG;
		
		// Get some friends suggestions [Top Social users -- SUBJECT TO BE CHANGED]
		if($this->getSubscriptionsList($this->id)) {
			// If he already follows some of the top users, eliminate those
			$query = $this->db->query(sprintf("SELECT *, COUNT(`subscriber`) AS popular FROM `relations`, `users` WHERE `relations`.`leader` = `users`.`idu` AND `relations`.`leader` NOT IN (%s) AND `private` = '0' GROUP BY `leader` ORDER BY popular DESC LIMIT 6", $this->id.','.$this->db->real_escape_string($this->getSubscriptionsList($this->id))));
		} else {
			$query = $this->db->query(sprintf("SELECT *, COUNT(`subscriber`) AS popular FROM `relations`, `users` WHERE `relations`.`leader` = `users`.`idu` AND `users`.`idu` <> '%s' AND `private` = '0' GROUP BY `leader` ORDER BY popular DESC LIMIT 6", $this->id));
		}

		// Store the array results
		while($row = $query->fetch_assoc()) {
			$rows[] = $row;
		}

		// If suggestions are available
		if(!empty($rows)) {
			$i = 0;
			
			$output = '<div class="sidebar-container widget-suggestions"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['sidebar_suggestions'].'</div>';
			foreach($rows as $row) {
				if($i == 6) break; // Display only the last 6 suggestions
				
				$username = realName($row['username'], $row['first_name'], $row['last_name']);
				// Add the elemnts to the array
				$output .= '<div class="sidebar-subscriptions"><div class="sidebar-title-container"><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><div class="sidebar-title-name">'.$username.'</div></a></div><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=112&h=112" /></a></div>';
				$i++;
			}
			$output .= '</div></div>';
			return $output;
		} else {
			return false;
		}
	}
	
	function sidebarTrending($bold, $per_page) {
		global $LNG;
		
		// Get some friends suggestions [Top Social users -- SUBJECT TO BE CHANGED]
		$query = $this->db->query(sprintf("SELECT * FROM messages WHERE `time` > CURRENT_DATE AND `time` < CURRENT_DATE + INTERVAL 1 DAY AND `tag` != ''"));
		
		// Store the hashtags into a string
		while($row = $query->fetch_assoc()) {
			$hashtags .= $row['tag'];
		}

		// If there are trends available
		if(!empty($hashtags)) {
			$i = 0;
			// Count the array values and filter out the blank spaces (also lowercase all array elements to prevent case-insensitive showing up, e.g: Test, test, TEST)
			$hashtags = explode(',', $hashtags);
			$count = array_count_values(array_map('strtolower', array_filter($hashtags)));
			
			// Sort them by trend
			arsort($count);
			$output = '<div class="sidebar-container widget-trending"><div class="sidebar-content"><div class="sidebar-header">'.$LNG['sidebar_trending'].'</div>';
			foreach($count as $row => $value) {
				if($i == $per_page) break; // Display and break when the trends hits the limit
				if($row == $bold) {
					$output .= '<div class="sidebar-link"><strong><a href="'.$this->url.'/index.php?a=search&tag='.$row.'">#'.$row.'</a></strong></div>';
				} else {
					$output .= '<div class="sidebar-link"><a href="'.$this->url.'/index.php?a=search&tag='.$row.'">#'.$row.'</a></div>';
				}
				$i++;
			}
			$output .= '</div></div>';
			return $output;
		} else {
			return false;
		}
	}
	
	function getLikes($start, $type) {
		global $LNG;
		// Type 0: Return the likes count
		// Type 1: Return the liked posts
	
		if($type) {
			if($start == 0) {
				$start = '';
			} else {
				$start = 'AND `likes`.`id` < \''.$this->db->real_escape_string($start).'\'';
			}
			
			$query = sprintf("SELECT 
			`likes`.`id` as `like_id`, `likes`.`post` as `like_post`, `likes`.`by` as `like_by`, `likes`.`time` as `time`,
			`messages`.`id` as `id`, `messages`.`message` as `message`, `messages`.`type` as `type`, `messages`.`value` as `value`,
			`users`.`username` as `username`, `users`.`first_name` as `first_name`, `users`.`last_name` as `last_name`, `users`.`image` as `image`
			FROM `likes`,`messages`,`users` WHERE `likes`.`by` = '%s' AND `likes`.`post` = `messages`.`id` AND `messages`.`uid` = `users`.`idu` AND `messages`.`public` = 1 %s ORDER BY `likes`.`time` DESC LIMIT %s", $this->profile_data['idu'], $start, ($this->per_page + 1));
			
			$getLikes = $this->db->query($query);
			
			// Declare the rows array
			$rows = array();
			while($row = $getLikes->fetch_assoc()) {
				// Store the result into the array
				$rows[] = $row;
			}
			
			// Decide whether the load more will be shown or not
			if(array_key_exists($this->per_page, $rows)) {
				$loadmore = 1;
					
				// Unset the last array element because it's not needed, it's used only to predict if the Load More Messages should be displayed
				array_pop($rows);
			}

			// Start the output
			foreach($rows as $value) {
				$time = $value['time']; $b = '';
				if($this->time == '0') {
					$time = date("c", strtotime($value['time']));
				} elseif($this->time == '2') {
					$time = $this->ago(strtotime($value['time']));
				} elseif($this->time == '3') {
					$date = strtotime($value['time']);
					$time = date('Y-m-d', $date);
					$b = '-standard';
				}
			
				$output .= '<div class="message-container"><div class="message-content"><div class="message-inner">
				<a href="'.$this->url.'/index.php?a=profile&u='.$this->profile_data['username'].'">'.realName($this->profile_data['username'], $this->profile_data['first_name'], $this->profile_data['last_name']).'</a> '.sprintf($LNG['x_liked_y_post'], '<a href="'.$this->url.'/index.php?a=profile&u='.$value['username'].'"><div class="like_btn like_btn_extended" style="float: none;"><img src="'.$this->url.'/thumb.php?src='.$value['image'].'&w=25&h=25&t=a" /></div>'.realName($value['username'], $value['first_name'], $value['last_name']).'</a>', $this->url.'/index.php?a=post&m='.$value['like_post']).' - <span class="timeago'.$b.'" title="'.$time.'" style="float: none;">'.$time.'</span>
				 '.((!empty($value['message'])) ? '<div class="like_text_snippet">'.($this->parseMessage(substr($value['message'], 0, 60))).'...</div>' : '').'</div></div></div>';
			}
			
			// Display the load more button
			if($loadmore) {
				$output .= '<div class="message-container" id="more_messages">
								<div class="load_more"><a onclick="loadLikes('.$value['like_id'].', \''.$this->profile_data['idu'].'\', \''.$this->profile_data['username'].'\')">'.$LNG['view_more_messages'].'</a></div>
							</div>';
			}
			
			return $output;
		} else {
			$query = $this->db->query(sprintf("SELECT count(`likes`.`id`) FROM `likes`,`messages` WHERE `likes`.`by` = '%s' AND `likes`.`post` = `messages`.`id` AND `messages`.`public` = '1'", $this->profile_data['idu']));
			
			// Store the array results
			$result = $query->fetch_array();
			
			// Return the likes value
			return $result[0];
		}
	}
	
	function getHashtags($start, $per_page, $value, $type = null) {
		global $LNG;
		// TYPE 0: Return the messages for the queried hashtag
		// TYPE 1: Return the queries hashtags list
		if($type) {
			if($type) {
				$query = $this->db->query(sprintf("SELECT messages.tag FROM messages WHERE messages.tag LIKE '%s'", '%'.$this->db->real_escape_string($value).'%'));
			}
			
			// Store the hashtags into a string
			while($row = $query->fetch_assoc()) {
				$hashtags .= $row['tag'];
			}

			$output = '<div class="search-content"><div class="search-results"><div class="notification-inner"><a onclick="manageResults(2)"><strong>'.$LNG['view_all_results'].'</strong></a> <a onclick="manageResults(0)" title="'.$LNG['close_results'].'"><div class="delete_btn"></div></a></div>';
			// If there are no results
			if(empty($hashtags)) {
				$output .= '<div class="message-inner">'.$LNG['no_results'].'</div>';
			} else {
				// Explore each hashtag string into an array
				$explode = explode(',', $hashtags);
				
				// Merge all matched arrays into a string
				$rows = array_unique(array_map('strtolower', $explode));

				foreach($rows as $row) {
					if(stripos($row, $value) !== false) {
						$output .= '<div class="hashtag">
										<a href="'.$this->url.'/index.php?a=search&tag='.$row.'">
											<div class="hashtag-inner">
												#'.$row.'
											</div>
										</a>
									</div>';
					}
				}
			}
			$output .= '</div></div>';
		} else {
			// If the $start value is 0, empty the query;
			if($start == 0) {
				$start = '';
			} else {
				// Else, build up the query
				$start = 'AND messages.id < \''.$this->db->real_escape_string($start).'\'';
			}

			$query = sprintf("SELECT * FROM `messages`, `users` WHERE `messages`.`tag` REGEXP '[[:<:]]%s[[:>:]]' AND `messages`.`uid` = `users`.`idu` %s AND `messages`.`public` = '1' ORDER BY `messages`.`id` DESC LIMIT %s", $this->db->real_escape_string($value), $start, ($this->per_page + 1));
			$value = '\''.$value.'\'';

			return $this->getMessages($query, 'loadHashtags', $value);
		}
		return $output;
	}
	
	function getSearch($start, $per_page, $value, $filter = null, $type = null) {
		// $type - switches the type for live search or static one [search page]
		global $LNG, $CONF;
		
		// Define the query type
		// Query Type 0: Normal search username, first and last naem
		// Query Type 1: Exact Email search
		if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$qt = 1;
		} else {
			$qt = 0;
		}
		
		// If the filter is male / female (alpha type)
		if($filter == 'm' || $filter == 'f') {
			if($filter == 'm') {
				$gender = 1;
			} else {
				$gender = 2;
			}
			if($qt == 1) {
				// Ignore any gender as it doesn't matter
				$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `gender` = '%s' AND `email` = '%s' LIMIT 1", $gender, $this->db->real_escape_string($value)));
			} else {
				$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `gender` = '%s' AND (`join` LIKE '%s' OR `username` LIKE '%s' OR concat_ws(' ', `first_name`, `last_name`)  LIKE '%s') ORDER BY `verified` DESC, `idu` DESC LIMIT %s, %s", $gender, '%'.$this->db->real_escape_string($value).'%', '%'.$this->db->real_escape_string($value).'%', '%'.$this->db->real_escape_string($value).'%', $this->db->real_escape_string($start), ($per_page + 1)));
			}
		} 
		// If the filter is a date range (digit type)
		elseif(ctype_digit($filter)) {
			// HERE COMES THE FILTER FOR AGE BETWEEN X & Y
		} else {
			if($qt == 1) {
				$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `email` = '%s' LIMIT 1", $this->db->real_escape_string($value)));
			} else {
				$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE `join` LIKE '%s' OR `username` LIKE '%s' OR concat_ws(' ', `first_name`, `last_name`) LIKE '%s' ORDER BY `verified` DESC, `idu` DESC LIMIT %s, %s", '%'.$this->db->real_escape_string($value).'%', '%'.$this->db->real_escape_string($value).'%', '%'.$this->db->real_escape_string($value).'%', $this->db->real_escape_string($start), ($per_page + 1)));
				
				// Sometimes the query might fail due to the fact that utf8 characters are being passed and the `username` sql field does not allow special chars
				if(!$query) {
					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE concat_ws(' ', `first_name`, `last_name`) LIKE '%s' ORDER BY `verified` DESC, `idu` DESC LIMIT %s, %s", '%'.$this->db->real_escape_string($value).'%', $this->db->real_escape_string($start), ($per_page + 1)));
				}
			}
		}

		while($row = $query->fetch_assoc()) {
			$rows[] = $row;
		}
		
		// If the query type is live, hide the load more button
		if(array_key_exists($per_page, $rows)) {
			$loadmore = 1;
			if($type) {
				$loadmore = 0;
			}
			
			// Unset the last array element because it's not needed, it's used only to predict if the Load More Messages should be displayed
			array_pop($rows);
		}
	
		// If the query type is live show the proper style
		if($type) {
			$output = '<div class="search-content"><div class="search-results"><div class="notification-inner"><a onclick="manageResults(1)"><strong>'.$LNG['view_all_results'].'</strong></a> <a onclick="manageResults(0)" title="'.$LNG['close_results'].'"><div class="delete_btn"></div></a></div>';
			// If there are no results
			if(empty($rows)) {
				$output .= '<div class="message-inner">'.$LNG['no_results'].'</div>';
			} else {
				foreach($rows as $row) {
					$output .= '<div class="message-inner">
								<div id="subscribe'.$row['idu'].'">'.$this->getSubscribe(0, array('idu' => $row['idu'], 'username' => $row['username'], 'private' => $row['private']), 1).'</div>'.$this->chatButton($row['idu'], $row['username'], 1).'
									<div class="message-avatar" id="avatar'.$row['idu'].'">
										<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">
										<img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50">
										</a>
									</div>
									<div class="message-top">
										<div class="message-author" id="author'.$row['idu'].'">
											<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.$row['username'].'</a>'.((!empty($row['verified'])) ? '<span class="verified-small"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" /></span>' : '').'
										</div>
										<div class="message-time">
											'.realName(null, $row['first_name'], $row['last_name']).'
											'.(($row['join'] !== '0000-0000') ? ' ('.$row['join'].')' : '&nbsp;').'
										</div>
									</div>
								</div>';
				}
			}
			$output .= '</div></div>';
		
		} else {
			// If there are no results
			if(empty($rows)) {
				$output .= '<div class="message-container"><div class="message-content"><div class="message-header">'.$LNG['search_title'].'</div><div class="message-inner">'.$LNG['no_results'].'</div></div></div>';
			} else {
				foreach($rows as $row) {
					$output .= '<div class="message-container">
									<div class="message-content">
										<div class="message-inner">
										<div id="subscribe'.$row['idu'].'">'.$this->getSubscribe(0, array('idu' => $row['idu'], 'username' => $row['username'], 'private' => $row['private']), 1).'</div>'.$this->chatButton($row['idu'], $row['username'], 1).'
											<div class="message-avatar" id="avatar'.$row['idu'].'">
												<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">
												<img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50">
												</a>
											</div>
											<div class="message-top">
												<div class="message-author" id="author'.$row['idu'].'">
													<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.$row['username'].'</a>'.((!empty($row['verified'])) ? '<span class="verified-small"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" /></span>' : '').'
												</div>
												<div class="message-time">
													'.realName(null, $row['first_name'], $row['last_name']).''.(($row['join'] !== '0000-0000') ? ' ('.$row['join'].')' : '&nbsp;').' 
												</div>
											</div>
										</div>
									</div>
								</div>';
				}
			}
		}
		if($loadmore) {
				$output .= '<div class="message-container" id="more_messages">
								<div class="load_more"><a onclick="loadPeople('.($start + $per_page).', \''.$value.'\', \''.$filter.'\')">'.$LNG['view_more_messages'].'</a></div>
							</div>';
		}
		
		return $output;
	}
	
	function listSubs($type = null) {
		global $LNG, $CONF;
		$rows = $this->subsList[0];
		
		if(array_key_exists($this->s_per_page, $rows)) {
			$loadmore = 1;
			
			// Unset the last array element because it's not needed, it's used only to predict if the Load More Messages should be displayed
			array_pop($rows);
		}
		
		foreach($rows as $row) {
			$output .= '<div class="message-container">
							<div class="message-content">
								<div class="message-inner">
								<div id="subscribe'.$row['idu'].'">'.$this->getSubscribe(0, array('idu' => $row['idu'], 'username' => $row['username'], 'private' => $row['private']), 1).'</div>'.$this->chatButton($row['idu'], $row['username'], 1).'
									<div class="message-avatar" id="avatar'.$row['idu'].'">
										<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">
										<img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50">
										</a>
									</div>
									<div class="message-top">
										<div class="message-author" id="author'.$row['idu'].'">
											<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'">'.$row['username'].'</a>'.((!empty($row['verified'])) ? '<span class="verified-small"><img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" /></span>' : '').'
										</div>
										<div class="message-time">
											'.realName(null, $row['first_name'], $row['last_name']).''.((!empty($row['location'])) ? ' ('.$row['location'].')' : '&nbsp;').' 
										</div>
									</div>
								</div>
							</div>
						</div>';
			$last = $row['id'];
		}
		if($loadmore) {
				$output .= '<div class="message-container" id="more_messages">
								<div class="load_more"><a onclick="loadSubs('.$last.', '.$type.', '.$this->profile_data['idu'].')">'.$LNG['view_more_messages'].'</a></div>
							</div>';
		}
		return $output;
	}
	
	function getSubs($id, $type, $start = null) {
		// Type: 0 Get the subscriptions
		// Type: 1 Get the subscribers
		if($type == 0) {
			// If the $start it set (used to list the users on dedicated profile pages)
			if(is_numeric($start)) {
				if($start == 0) {
					$start = '';
				} else {
					$start = 'AND `relations`.`id` < \''.$this->db->real_escape_string($start).'\'';
				}
				$limit = 'LIMIT '.($this->s_per_page + 1);
			}
			$query = sprintf("SELECT * FROM `relations`, `users` WHERE `relations`.`subscriber` = '%s' AND `relations`.`leader` = `users`.`idu` $start ORDER BY `relations`.`id` DESC $limit", $this->db->real_escape_string($id));
		} else {
			if(is_numeric($start)) {
				if($start == 0) {
					$start = '';
				} else {
					$start = 'AND `relations`.`id` < \''.$this->db->real_escape_string($start).'\'';
				}
				$limit = 'LIMIT '.($this->s_per_page + 1);
			}
			$query = sprintf("SELECT * FROM `relations`, `users` WHERE `relations`.`leader` = '%s' AND `relations`.`subscriber` = `users`.`idu` $start ORDER BY `relations`.`id` DESC $limit", $this->db->real_escape_string($id));
		}
		
		$result = $this->db->query($query);
		while($row = $result->fetch_assoc()) {
			$array [] = $row;
		}
		return array($array, $total = $result->num_rows);
	}
	
	function getActions($id, $likes = null, $type = null) {
		global $LNG;

		// If type 1 do the like
		if($type == 1) {
			// Verify the Like state
			$verify = $this->verifyLike($id);
			
			// Verify if message exists
			$result = $this->db->query(sprintf("SELECT * FROM `messages`, `users` WHERE `id` = '%s' AND `messages`.`uid` = `users`.`idu`", $this->db->real_escape_string($id)));
			if($result->num_rows == 0) {
				return $LNG['like_message_not_exist'];
			}
			if(!$verify) {
				// Prepare the INSERT statement
				$stmt = $this->db->prepare("INSERT INTO `likes` (`post`, `by`) VALUES ('{$this->db->real_escape_string($id)}', '{$this->db->real_escape_string($this->id)}')");

				// Execute the statement
				$stmt->execute();
				
				// Save the affected rows
				$affected = $stmt->affected_rows;

				// Close the statement
				$stmt->close();
				if($affected) {
					$this->db->query("UPDATE `messages` SET `likes` = `likes` + 1, `time` = `time` WHERE id = '{$this->db->real_escape_string($id)}'");
					
					$user = $result->fetch_assoc();
					
					// Do the INSERT notification
					$insertNotification = $this->db->query(sprintf("INSERT INTO `notifications` (`from`, `to`, `parent`, `type`, `read`) VALUES ('%s', '%s', '%s', '2', '0')", $this->db->real_escape_string($this->id), $user['uid'], $user['id']));
					
					// If email on likes is enabled in admin settings
					if($this->email_like) {
						// If user has emails on like enabled and it\'s not liking his own post
						if($user['email_like'] && ($this->id !== $user['idu'])) {
							// Send e-mail
							sendMail($user['email'], sprintf($LNG['ttl_like_email'], $this->username), sprintf($LNG['like_email'], realName($user['username'], $user['first_name'], $user['last_name']), $this->url.'/index.php?a=profile&u='.$this->username, $this->username, $this->url.'/index.php?a=post&m='.$id, $this->title, $this->url.'/index.php?a=settings&b=notifications'), $this->email);
						}
					}
				}
			} else {
				$x = 'already_liked';
			}
		} elseif($type == 2) {
			// Verify the Like state
			$verify = $this->verifyLike($id);
			
			// Verify if message exists
			$result = $this->db->query(sprintf("SELECT `id` FROM `messages` WHERE `id` = '%s'", $this->db->real_escape_string($id)));
			if($result->num_rows == 0) {
				return $LNG['like_message_not_exist'];
			}
			if($verify) {
				// Prepare the DELETE statement
				$stmt = $this->db->prepare("DELETE FROM `likes` WHERE `post` = '{$this->db->real_escape_string($id)}' AND `by` = '{$this->db->real_escape_string($this->id)}'");

				// Execute the statement
				$stmt->execute();
				
				// Save the affected rows
				$affected = $stmt->affected_rows;

				// Close the statement
				$stmt->close();
				if($affected) {
					$this->db->query("UPDATE `messages` SET `likes` = `likes` - 1, `time` = `time` WHERE id = '{$this->db->real_escape_string($id)}'");
					$this->db->query("DELETE FROM `notifications` WHERE `parent` = '{$this->db->real_escape_string($id)}' AND `type` = '2' AND `from` = '{$this->db->real_escape_string($this->id)}'");
				}
			} else {
				$x = 'already_disliked';
			}
		}

		// If likes is not defined
		if($likes == null) {
			// Get the likes
			$query = sprintf("SELECT `likes` FROM `messages` WHERE `id` = '%s'", $this->db->real_escape_string($id));
			
			// Run the query
			$result = $this->db->query($query);
			
			// Get the array element for the like
			$get = $result->fetch_row();
			
			// Set the likes value
			$likes = $get[0];
		}
		
		// Verify the Like state
		$verify = $this->verifyLike($id);
		
		if($verify) {
			$state = $LNG['dislike'];
			$y = 2;
		} else {
			$state = $LNG['like'];
			$y = 1;
		}
		
		if($this->l_per_post) {
			$query = sprintf("SELECT * FROM `likes`,`users` WHERE `post` = '%s' and `likes`.`by` = `users`.`idu` ORDER BY `likes`.`id` DESC LIMIT %s", $this->db->real_escape_string($id), $this->db->real_escape_string($this->l_per_post));
		
			$result = $this->db->query($query);
			while($row = $result->fetch_assoc()) {
				$array[] = $row;
			}
			
			// Define the $people who liked variable
			$people = '';
			if (is_array($array))
			{
				foreach($array as $row) {
					$people .= '<a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&w=25&h=25&t=a" title="'.realName($row['username'], $row['first_name'], $row['last_name']).' '.$LNG['liked_this'].'" /></a> ';
				}
			}
		}

		// Output variable
		$actions = '<a onclick="doLike('.$id.', '.$y.')" id="doLike'.$id.'">'.$state.'</a> - <a onclick="focus_form('.$id.')">'.$LNG['comment'].'</a> - <a onclick="share('.$id.')">'.$LNG['share'].'</a> <div class="like_btn" id="like_btn'.$id.'"> '.$people.$likes.'</div>';
		
		// If the current user is not empty
		if(empty($this->id)) {
			// Output variable
			$actions = '<a href="'.$this->url.'">'.$LNG['login_to_lcs'].'</a> <div class="like_btn"> '.$people.$likes.'</div>';
		}
		if(isset($x)) {
			return $LNG["$x"].' <div class="like_btn"> '.$likes.'</div>';
		}
		return $actions;
	}
	
	function verifyLike($id) {
		$result = $this->db->query(sprintf("SELECT * FROM `likes` WHERE `post` = '%s' AND `by` = '%s'", $this->db->real_escape_string($id), $this->db->real_escape_string($this->id)));
	
		// If the Message/Comment exists
		return ($result->num_rows) ? 1 : 0;
	}
	
	function getBlocked($id, $type = null) {
		// Type 0: Output the button state
		// Type 1: Block/Unblock a user
		
		$profile = $this->profileData(null, $id);
		
		// If the username does not exist, return nothing
		if(empty($profile)) {
			return false;
		} else {
			// Verify if there is any block issued for this username
			$checkBlocked = $this->db->query(sprintf("SELECT * FROM `blocked` WHERE `uid` = '%s' AND `by` = '%s'", $this->db->real_escape_string($id), $this->db->real_escape_string($this->id)));
	
			// If the Message/Comment exists
			$state = $checkBlocked->num_rows;
			
			// If type 1: Add/Remove
			if($type) {
				// If there is a block issued, remove the block
				if($state) {
					// Remove the block
					$this->db->query(sprintf("DELETE FROM `blocked` WHERE `uid` = '%s' AND `by` = '%s'", $this->db->real_escape_string($id), $this->db->real_escape_string($this->id)));
					
					// Block variable
					$y = 0;
				} else {
					// Insert the block
					$this->db->query(sprintf("INSERT INTO `blocked` (`uid`, `by`) VALUES ('%s', '%s')", $this->db->real_escape_string($id), $this->db->real_escape_string($this->id)));
					
					// Unblock variable
					$y = 1;
				}
				return $this->outputBlocked($id, $profile, $y);
			} else {
				return $this->outputBlocked($id, $profile, $state);
			}
		}
	}
	
	function outputBlocked($id, $profile, $state) {
		global $LNG;
		if($state) {
			$x = '<span class="class="unblock-button""><a onclick="doBlock('.$id.', 1)" title="Unblock '.realName($profile['username'], $profile['first_name'], $profile['last_name']).'">'.$LNG['unblock'].'</a></span>';
		} else {
			$x = '<a onclick="doBlock('.$id.', 1)" title="Block '.realName($profile['username'], $profile['first_name'], $profile['last_name']).'">'.$LNG['block'].'</a>';
		}
		return $x;
	}
	
	function postMessage($message, $image, $type, $value, $privacy) {
		global $LNG;
		list($error, $content) = $this->validateMessage($message, $image, $type, $value, $privacy);
		if($error) {
			// Randomize a number for the js function
			$rand = rand();
			$switch = ($content[2]) ? sprintf($LNG["{$content[0]}"], $content[2], $content[1]) : sprintf($LNG["{$content[0]}"], $content[1]);
			return $this->db->real_escape_string('<div class="message-container" id="notification'.$rand.'"><div class="message-content"><div class="message-inner">'.$switch.'<div class="delete_btn" title="Dismiss" onclick="deleteNotification(0, \''.$rand.'\')"></div></div></div></div>');
		} else {
			// Add the insert message
			$stmt = $this->db->prepare("$content");

			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;

			// Close the statement
			$stmt->close();
			
			// If the comment was added, return 1
			if($affected) {
				return $this->db->real_escape_string($this->getLastMessage());
			} else {
				return '<div class="message-container" id="notification'.$rand.'"><div class="message-content"><div class="message-inner">'.$LNG['unexpected_message'].'<div class="delete_btn" title="Dismiss" onclick="deleteNotification(0, \''.$rand.'\')"></div></div></div></div>';
			}
		}
	}
	
	function validateMessage($message, $image, $type, $value, $privacy) {
		// If message is longer than admitted
		if(strlen($message) > $this->message_length) {
			$error = array('message_too_long', $this->message_length);
		}
		// Define the switch variable
		$x = 0;
		if($image['name'][0]) {
			// Set the variable value to 1 if at least one image name exists
			$x = 1;
		}
		if($x == 1) {
			// If the user selects more images than allowed
			if(count($image['name']) > $this->max_images) {
				$error = array('too_many_images', count($image['name']), $this->max_images);
			} else {
				// Define the array which holds the value names
				$value = array();
				$tmp_value = array();
				foreach($image['error'] as $key => $error) {
					$allowedExt = explode(',', $this->image_format);
					$ext = pathinfo($image['name'][$key], PATHINFO_EXTENSION);
					if(!empty($image['size'][$key]) && $image['size'][$key] > $this->max_size) {
						$error = array('file_too_big', fsize($this->max_size), $image['name'][$key]); // Error Code #004
						break;
					} elseif(!empty($ext) && !in_array(strtolower($ext), $allowedExt)) {
						$error = array('format_not_exist', $this->image_format, $image['name'][$key]); // Error Code #005
						break;
					} else {
						if(isset($image['name'][$key]) && $image['name'][$key] !== '' && $image['size'][$key] > 0) {
							$rand = mt_rand();
							$tmp_name = $image['tmp_name'][$key];
							$name = pathinfo($image['name'][$key], PATHINFO_FILENAME);
							$fullname = $image['name'][$key];
							$size = $image['size'][$key];
							$ext = pathinfo($image['name'][$key], PATHINFO_EXTENSION);
							// $finalName = str_replace(',', '', $rand.'.'.$this->db->real_escape_string($name).'.'.$this->db->real_escape_string($ext));
							$finalName = mt_rand().'_'.mt_rand().'_'.mt_rand().'.'.$this->db->real_escape_string($ext);
							
							// Define the type for picture
							$type = 'picture';
							
							// Store the values into arrays
							$tmp_value[] = $tmp_name;
							$value[] = $finalName;
						}
					}
				}
				if(empty($error)) {
					foreach($value as $key => $finalName) {
						move_uploaded_file($tmp_value[$key], '../uploads/media/'.$finalName);
					}
				}
				// Implode the values
				$value = implode(',', $value);
			}
		} else {
			// Allowed types of evenets
			$allowedType = array('map', 'game', 'video', 'food', 'visited', 'movie', 'music');
			// If the user doesn't select any event, at all.
			if(empty($type)) {
				// Empty the type & value
				$type = '';
				$value = '';
			} else {
				// Verify if the event exist
				if(in_array($type, $allowedType)) {
					if($type == 'video') {
						if(substr($value, 0, 20) == "https://youtube.com/" || substr($value, 0, 24) == "https://www.youtube.com/" || substr($value, 0, 16) == "www.youtube.com/" || substr($value, 0, 12) == "youtube.com/" || substr($value, 0, 19) == "http://youtube.com/" || substr($value, 0, 23) == "http://www.youtube.com/" || substr($value, 0, 16) == "http://youtu.be/") {
						parse_str(parse_url($value, PHP_URL_QUERY), $my_array_of_vars);
							if(substr($value, 0, 16) == 'http://youtu.be/') {
								$value = str_replace('http://youtu.be/', 'yt:', $value);
							} else {
								$value = 'yt:'.$my_array_of_vars['v'];
							}
						} elseif(substr($value, 0, 17) == "http://vimeo.com/" || substr($value, 0, 21) == "http://www.vimeo.com/" || substr($value, 0, 18) == "https://vimeo.com/" || substr($value, 0, 22) == "https://www.vimeo.com/" || substr($value, 0, 14) == "www.vimeo.com/" || substr($value, 0, 10) == "vimeo.com/") {
							$value = 'vm:'.(int)substr(parse_url($value, PHP_URL_PATH), 1);
						}
					} elseif($type == 'music') {
						if(substr($value, 0, 23) == "https://soundcloud.com/" || substr($value, 0, 27) == "https://www.soundcloud.com/" || substr($value, 0, 22) == "http://soundcloud.com/" || substr($value, 0, 22) == "http://www.soundcloud.com/" || substr($value, 0, 15) == "soundcloud.com/" || substr($value, 0, 19) == "www.soundcloud.com/") {
							$value = 'sc:'.parse_url($value, PHP_URL_PATH);
						}
					}
				} else {
					$error = array('event_not_exist'); // Error Code #002
				}
			}
		}

		// Allowed types of privacy
		$allowedPrivacy = array(0, 1);
		
		if(!in_array($privacy, $allowedPrivacy)) {
			$error = array('privacy_no_exist'); // Error Code #003
		}
		
		# #001 - The message is empty
		# #002 - The event does not exist
		# #003 - The privacy value is not valid
		# #004 - The selected file is too big
		# #005 - The selected file's format is invalid
		
		if($error) {
			// Return an error
			return array('1', $error);
		} else {
			// Escape thge message and trim it to remove any extra white spaces or consecutive new lines
			$message = $this->db->real_escape_string(htmlspecialchars(trim(nl2clean($message))));

			// Match the hashtags
			preg_match_all('/(#\w+)/u', str_replace(array('\r', '\n'), ' ', $message), $matchedHashtags);

			// For each hashtag, strip the '#' tag and add a comma after it
			if(!empty($matchedHashtags[0])) {
				foreach($matchedHashtags[0] as $match) {
					$hashtag .= str_replace('#', '', $match).',';
				}
			}
			
			// Create the query
			// Add the insert message				
			$query = sprintf("INSERT INTO `messages` (`uid`, `message`, `tag`, `type`, `value`, `time`, `public`) VALUES ('%s', '%s', '%s', '%s', '%s', CURRENT_TIMESTAMP, '%s')", $this->db->real_escape_string($this->id), $message, $hashtag, $this->db->real_escape_string($type), $this->db->real_escape_string(strip_tags($value)), $this->db->real_escape_string($privacy));
			return array('0', $query);
		}
	}
	
	function postShared($id) {
		global $LNG;
		// Check if the post ID exists and it's public
		$query = $this->db->query(sprintf("SELECT * FROM `messages`,`users` WHERE `messages`.`id` = '%s' AND `messages`.`public` = '1' AND `messages`.`uid` = `users`.`idu`", $this->db->real_escape_string($id)));
		$result = $query->fetch_assoc();
		
		// If a message is found
		if($result) {
			// Insert the shared message
			
			// Check if the message was already shared [avoid mirror in mirror effect]
			if($result['type'] == 'shared') {
				$insert = $this->db->query(sprintf("INSERT INTO `messages` (`uid`, `message`, `type`, `value`, `time`, `public`) VALUES ('%s', '%s', 'shared', '%s', CURRENT_TIMESTAMP, '1');", $this->db->real_escape_string($this->id), $this->db->real_escape_string($result['message']), $this->db->real_escape_string($result['value'])));
			} else {
				$insert = $this->db->query(sprintf("INSERT INTO `messages` (`uid`, `message`, `type`, `value`, `time`, `public`) VALUES ('%s', '%s', 'shared', '%s', CURRENT_TIMESTAMP, '1');", $this->db->real_escape_string($this->id), $this->db->real_escape_string($result['message']), $this->db->real_escape_string($result['id'].':'.$result['username'])));
			}
			
			// Do the INSERT notification
			$selectShared = $this->db->query(sprintf("SELECT * FROM `messages`,`users` WHERE `messages`.`uid` = '%s' AND `messages`.`type` = 'shared' AND `messages`.`uid` = `users`.`idu` ORDER BY `messages`.`id` DESC", $this->db->real_escape_string($this->id)));
			$resultShared = $selectShared->fetch_assoc();
			
			$insertNotification = $this->db->query(sprintf("INSERT INTO `notifications` (`from`, `to`, `parent`, `child`, `type`, `read`) VALUES ('%s', '%s', '%s', '%s', '3', '0')", $this->db->real_escape_string($this->id), $result['uid'], $result['id'], $resultShared['id']));
			
			return sprintf($LNG['shared_success'], $this->url.'/index.php?a=timeline');
		} else {
			return $LNG['no_shared'];
		}
	}
}

?>