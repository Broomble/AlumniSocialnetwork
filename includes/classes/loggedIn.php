<?php
class loggedIn {
	public $db; 		// Database Property
	public $url; 		// Installation URL Property
	public $username;	// Username Property
	public $password;	// Password Property

	function verify() {
		// Set the query result into $query variable;
		$query = $this->query();		

		if(!is_int($query)) {
			// If the $query variable is not 0 (int)
			// Fetch associative array into $result variable
			$result = $query->fetch_assoc();
			return $result;
		}
	}

	function query() {
		// If the username input string is an e-mail, switch the query
		if(filter_var($this->db->real_escape_string($this->username), FILTER_VALIDATE_EMAIL)) {
			$query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), $this->db->real_escape_string($this->password));
		} else {
			$query = sprintf("SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), $this->db->real_escape_string($this->password));
		}
		$result = $this->db->query($query);
		return ($result->num_rows == 0) ? 0 : $result;
	}

	function logOut() {
		unset($_SESSION['name']);
		unset($_SESSION['born']);
		unset($_SESSION['join']);
		unset($_SESSION['course']);
		unset($_SESSION['branch']);
		unset($_SESSION['enrollno']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		setcookie("name", '', 1);
		setcookie("born", '', 1);
		setcookie("join", '', 1);
		setcookie("course", '', 1);
		setcookie("branch", '', 1);
		setcookie("enrollno", '', 1);
		setcookie("username", '', 1);
		setcookie("password", '', 1);
	}
}
?>