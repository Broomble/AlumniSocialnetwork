<?php

class loggedInAdmin {
	public $db;			// Database Property
	public $url;		// Installation URL Property
	public $username; 	// Username Property
	public $password; 	// Password Property
	
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
		$query = sprintf("SELECT * FROM `admin` WHERE `username` = '%s' AND `password` = '%s'", $this->db->real_escape_string($this->username), $this->db->real_escape_string($this->password));

		$result = $this->db->query($query);
		return ($result->num_rows == 0) ? 0 : $result;
	}

	function logOut() {
		unset($_SESSION['usernameAdmin']);
		unset($_SESSION['passwordAdmin']);
	}
}

?>