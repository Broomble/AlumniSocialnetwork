<?php
class employee{
	public $db; 					// Database Property
	public $url; 					// Installation URL Property
	public $company;					
	public $hrphone;					
	public $hrname;					
	public $hremail;					
	public $joining;	
	public $offaddress;	
	public $offemail;
	public $offphone;
	public $industry;
	public $designation;
	public $department;
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
		if(empty($this->company) && empty($this->industry) && empty($this->designation) && empty($this->department) && empty($this->offaddress) && empty($state) && empty($country)) {
			$error[] .= 'all_fields';
		}
		if(isset($offemail) && !filter_var($this->offemail, FILTER_VALIDATE_EMAIL)) {
			return array('invalid_email');
		}
		return $error;
	}

	function query() {
		$query = sprintf("INSERT into `employment` (`enrollno`, `company`, `joining`, `industry`, `department`, `designation`, `office_landline`, `office_email`, `office_addr`, `state`, `country`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", $this->queryEnroll(), $this->db->real_escape_string($this->company), $this->db->real_escape_string($this->joining),  $this->db->real_escape_string($this->industry),  $this->db->real_escape_string($this->department),  $this->db->real_escape_string($this->designation),  $this->db->real_escape_string($this->offphone),  $this->db->real_escape_string($this->offemail),  $this->db->real_escape_string($this->offaddress), $this->db->real_escape_string($this->state), $this->db->real_escape_string($this->country));
		$this->db->query($query);
		// return ($this->db->query($query)) ? 0 : 1;
	}

	function query1() {
		$query = sprintf("UPDATE `users` SET `status`=2 WHERE `enrollno` = '%s'",  $this->queryEnroll());
		$this->db->query($query);		
	}	
	
}
?>