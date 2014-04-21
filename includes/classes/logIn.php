<?php

class logIn {
	public $db; 		// Database Property
	public $url; 		// Installation URL Property
	public $username;	// Username Property
	public $password;	// Password Property
	public $remember;	// Option to remember the usr / pwd (_COOKIE) Property
	
	function in() {
		global $LNG;
		
		// If an user is found
		if($this->queryLogIn() == 1) {
			if($this->remember == 1) { // If checkbox, then set cookie
				setcookie("username", $this->username, time() + 30 * 24 * 60 * 60); // Expire in one month
				setcookie("password", md5($this->password), time() + 30 * 24 * 60 * 60); // Expire in one month
			} else { // Else set session
				$_SESSION['username'] = $this->username;
				$_SESSION['password'] = md5($this->password);
			}
			
			// Redirect the user to his personal profile
			header("Location: ".$this->url."/index.php?a=feed");
		} else {
			// If wrong credentials are entered, unset everything
			$this->logOut();
			
			return $LNG['invalid_user_pw'];
		}
	}
	
	function queryLogIn() {
		// If the username input string is an e-mail, switch the query
		if(filter_var($this->db->real_escape_string($this->username), FILTER_VALIDATE_EMAIL)) {
			$query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), md5($this->db->real_escape_string($this->password)));
		} else {
			$query = sprintf("SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), md5($this->db->real_escape_string($this->password)));
		}
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function logOut() {
		unset($_SESSION['name']);
		unset($_SESSION['born']);
		unset($_SESSION['join']);
		unset($_SESSION['course']);
		unset($_SESSION['branch']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['enrollno']);
		setcookie("username", '', 1);
		setcookie("password", '', 1);
	}
}