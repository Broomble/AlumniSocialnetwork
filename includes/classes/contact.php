<?php
class contact{
	public $db; 					// Database Property
	public $url; 					// Installation URL Property
	public $phone;					
	public $email;					
	public $address;
	public $city;	
	public $state;				
	public $country;

	function process() {
		global $LNG;

		$arr = $this->validate_values(); // Must be stored in a variable before executing an empty condition
		if(empty($arr)) { // If there is no error message then execute the query;
			$this->query();
			$this->query1();
			// Set a session and log-in the user


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

	function verify_if_phone_exist() {
			$query = sprintf("SELECT `phone` FROM `contacts` WHERE `phone` = '%s'", $this->db->real_escape_string($this->phone));
			$result = $this->db->query($query);

			return ($result->num_rows == 0) ? 0 : 1;
	}

	function verify_if_email_exists() {
			$query = sprintf("SELECT `email` FROM `contacts` WHERE `email` = '%s'", $this->db->real_escape_string(strtolower($this->email)));
			$result = $this->db->query($query);

			return ($result->num_rows == 0) ? 0 : 1;
	}

	function queryEnroll() {
		// If the username input string is an e-mail, switch the query
		if(isset($_SESSION['username'])){
			if(filter_var($_SESSION['username'], FILTER_VALIDATE_EMAIL)) {
				$query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `password` = '%s'", $_SESSION['username'], $_SESSION['password']);
			} else {
				$query = sprintf("SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'", $_SESSION['username'], $_SESSION['password']);
			}
		}elseif(isset($_COOKIE['username'])){
			if(filter_var($_COOKIE['username'], FILTER_VALIDATE_EMAIL)) {
				$query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `password` = '%s'", $_COOKIE['username'], $_COOKIE['password']);
			} else {
				$query = sprintf("SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'", $_COOKIE['username'], $_COOKIE['password']);
			}
		}	
		$result = $this->db->query($query);		

		while($row = $result->fetch_assoc()) {
			return $row['enrollno'];	
		}

	}

	function validate_values() {
		// Create the array which contains the Language variable
		$error = array();
				// Define the Language variable for each type of error
		if($this->verify_if_phone_exist() !== 0) {
			$error[] .= 'phone_exists';
		}
		if($this->verify_if_email_exists() !== 0) {
			$error[] .= 'email_exists';
		}
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$error[] .= 'invalid_email';
		}		
		if (!preg_match('/^[0-9+-]*$/', $this->phone)){
			$error[] .= 'phone_no_error';
		}
		if (!preg_match('/^[a-zA-Z\s]*$/', $this->city)){
			$error[] .= 'city_name_error';
		}
		if(empty($this->phone) || empty($this->email) || empty($this->city) || empty($this->state) || empty($this->country)) {
			$error[] .= 'all_fields';
		}
		return $error;
	}

	function query() {
		$query = sprintf("INSERT into `contacts` (`enrollno`, `phone`, `email`, `perma_addr`, `city`, `state`, `country`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');", $this->queryEnroll(), $this->db->real_escape_string($this->phone), $this->db->real_escape_string($this->email),  $this->db->real_escape_string($this->address), $this->db->real_escape_string($this->city), $this->db->real_escape_string($this->state), $this->db->real_escape_string($this->country));
		$this->db->query($query);
		// return ($this->db->query($query)) ? 0 : 1;
	}

	function query1() {
		$query = sprintf("UPDATE `users` SET `status`=1 WHERE `enrollno` = '%s'",  $this->queryEnroll());
		$this->db->query($query);		
	}	

}
?>