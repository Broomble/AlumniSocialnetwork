<?php
class logInAdmin {
	public $db; 		// Database Property
	public $url; 		// Installation URL Property
	public $username;	// Username Property
	public $password;	// Password Property
	
	function in() {
		global $LNG;
		
		// If an user is found
		if($this->queryLogIn() == 1) {
			// Set session
			$_SESSION['usernameAdmin'] = $this->username;
			$_SESSION['passwordAdmin'] = md5($this->password);
			
			// Redirect the user to his personal profile
			// header("Location: ".$this->url."/index.php?a=feed");
		} else {
			// If wrong credentials are entered, unset everything
			$this->logOut();
			
			return notificationBox('error', $LNG['error'], $LNG['invalid_user_pw']);
		}
	}
	
	function queryLogIn() {
		$query = sprintf("SELECT * FROM `admin` WHERE `username` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), md5($this->db->real_escape_string($this->password)));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function logOut() {
		unset($_SESSION['usernameAdmin']);
		unset($_SESSION['passwordAdmin']);
	}
}
?>