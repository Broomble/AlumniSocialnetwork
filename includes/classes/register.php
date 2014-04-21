<?php
class register {
	public $db; 					// Database Property
	public $url; 					// Installation URL Property
	public $username;				// The inserted username
	public $password;				// The inserted password
	public $email;					// The inserted email
	public $captcha;				// The inserted captcha
	public $enrollno;				// The inserted enrollno
	public $captcha_on;				// Store the Admin Captcha settings
	public $message_privacy;		// Store the Admin User's Message Privacy settings (Predefined, changeable)
	public $verified;				// Store the Admin Verified settings
	public $like_notification;		// Store the Admin Like Notification Settings  (Predefined, changeable)
	public $comment_notification;	// Store the Admin Comment Notification Settings (Predefined, changeable)
	public $shared_notification;	// Store the Admin Shared Message Notification Settings  (Predefined, changeable)
	public $chat_notification;		// Store the Admin Chat Notification Settings  (Predefined, changeable)
	public $friend_notification;	// Store the Admin Friend Notification Settings  (Predefined, changeable)
	public $email_like;				// The general e-mail like setting [if allowed, it will turn on emails on likes]
	public $email_comment;			// The general e-mail like setting [if allowed, it will turn on emails on comments]
	public $email_new_friend;		// The general e-mail new friend setting [if allowed, it will turn on emails on new friendships]
	public $sound_new_notification;	// The general sound settings for general notifications (top bar)
	public $sound_new_chat;			// The general sound settings for new chat messages (messages page)
	
	function process() {
		global $LNG;

		$arr = $this->validate_values(); // Must be stored in a variable before executing an empty condition
		if(empty($arr)) { // If there is no error message then execute the query;
			$this->query();
			
			// Set a session and log-in the user
			$_SESSION['username'] = $this->username;
			$_SESSION['password'] = md5($this->password);
			
			//Redirect the user to his personal profile
			//header("Location: ".$this->url."/something");
			
			// Return (int) 1 if everything was validated
			$x = 1;
			
			// return $LNG['user_success'];
		} else { // If there is an error message
			foreach($arr as $err) {
				return notificationBox('transparent', $LNG['error'], $LNG["$err"], 1); // Return the error value for translation file
			}
		}
		return $x;		
	}
	
	function verify_if_user_exist() {
		$query = sprintf("SELECT `username` FROM `users` WHERE `username` = '%s'", $this->db->real_escape_string(strtolower($this->username)));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}

	function verify_if_enrollno_exist() {
		$query = sprintf("SELECT `enrollno` FROM `users` WHERE `enrollno` = '%s'", $_SESSION['enrollno']);
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function verify_if_email_exists() {
		$query = sprintf("SELECT `email` FROM `users` WHERE `email` = '%s'", $this->db->real_escape_string(strtolower($this->email)));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function verify_captcha() {
		if($this->captcha_on) {
			if($this->captcha == "{$_SESSION['captcha']}") {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	function validate_values() {
		// Create the array which contains the Language variable
		$error = array();
		
		// Define the Language variable for each type of error
		if($this->verify_if_user_exist() !== 0) {
			$error[] .= 'user_exists';
		}
		if($this->verify_if_email_exists() !== 0) {
			$error[] .= 'email_exists';
		}
		if($this->verify_if_enrollno_exist() !== 0) {
			$error[] .= 'enrollno_exist';
		}
		if(empty($this->username) && empty($this->password) && empty($email) && empty($enrollno)) {
			$error[] .= 'all_fields';
		}
		if(strlen($this->password) <= 2) {
			$error[] .= 'password_too_short';
		}
/*		if(strlen($this->enrollno) <= 10) {
			$error[] .= 'enrollno_too_short';
		}*/
		if(!ctype_alnum($this->username)) {
			$error[] .= 'user_alnum';
		}
		if(strlen($this->username) <= 2 || strlen($this->username) >= 33) {
			$error[] .= 'user_too_short';
		}
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$error[] .= 'invalid_email';
		}
		if($this->verify_captcha() == false) {
			$error[] .= 'invalid_captcha';
		}
		
		return $error;
	}
	
	function query() {
		$query = sprintf("INSERT into `users` (`username`, `password`, `email`, `enrollno`, `date`, `image`, `privacy`, `cover`, `verified`, `online`, `notificationl`, `notificationc`, `notifications`, `notificationd`, `notificationf`, `email_comment`, `email_like`, `email_new_friend`, `sound_new_notification`, `sound_new_chat`, `born`, `join`, `course`, `branch`) VALUES ('%s', '%s', '%s', '%s', '%s', 'default.png', '%s', 'default.png', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", $this->db->real_escape_string(strtolower($this->username)), md5($this->db->real_escape_string($this->password)), $this->db->real_escape_string($this->email), $_SESSION['enrollno'], date("Y-m-d H:i:s"), $this->message_privacy, $this->verified, time(), $this->like_notification, $this->comment_notification, $this->shared_notification, $this->chat_notification, $this->friend_notification, $this->email_comment, $this->email_like, $this->email_new_friend, $this->sound_new_notification, $this->sound_new_chat, $_SESSION['born'], $_SESSION['join'], $_SESSION['course'], $_SESSION['branch']);
		$this->db->query($query);
		// return ($this->db->query($query)) ? 0 : 1;
	}
}
?>