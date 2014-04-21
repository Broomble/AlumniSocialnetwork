<?php

class recover {

	public $db;			// Database Property
	public $url;		// Installation URL Property
	public $username;	// The username to recover
	
	function checkUser() {
		// Query the database and check if the username exists
		$query = sprintf("SELECT `username`,`email` FROM `users` WHERE `username` = '%s'", $this->db->real_escape_string(strtolower($this->username)));
		$result = $this->db->query($query);

		// If a valid username is found
		if ($result->num_rows > 0) {
		
			// Generate the salt for that username
			$generateSalt = $this->generateSalt($this->username);
			
			// If the salt was generated
			if($generateSalt) {
				// Fetch Associative values
				
				$assoc = $result->fetch_assoc();
				// Return the username, email and salted code
				return array($assoc['username'], $assoc['email'], $generateSalt);
			}
		}
	}
	
	function generateSalt($username) {
		// Generate the salted code
		$salt = md5(mt_rand());
		
		// Prepare to update the database with the salted code
		$stmt = $this->db->prepare("UPDATE `users` SET `salted` = '{$this->db->real_escape_string($salt)}' WHERE `username` = '{$this->db->real_escape_string(strtolower($username))}'");
		
		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;
		
		// Close the query
		$stmt->close();

		// If there was anything affected return 1
		if($affected)
			return $salt;
		else 
			return false;
	}
	
	function changePassword($username, $password, $salt) {
		// Query the database and check if the username and the salted code exists
		$query = sprintf("SELECT `username` FROM `users` WHERE `username` = '%s' AND `salted` = '%s'", $this->db->real_escape_string(strtolower($username)), $this->db->real_escape_string($salt));
		$result = $this->db->query($query);
		
		// If a valid match was found
		if ($result->num_rows > 0) {
			
			// Change the password
			$stmt = $this->db->prepare("UPDATE `users` SET `password` = md5('{$password}'), `salted` = '' WHERE `username` = '{$this->db->real_escape_string(strtolower($username))}'");
		
			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;
			
			// Close the query
			$stmt->close();
			if($affected) {
				return true;
			} else {
				return false;
			}
		}
	}
}

?>