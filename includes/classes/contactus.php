<?php
class contactus{
	public $db; 					// Database Property
	public $url; 					// Installation URL Property
	public $name;					
	public $email;					
	public $message;
	
	function process() {
		global $LNG;

		$arr = $this->validate_values(); // Must be stored in a variable before executing an empty condition
		if(empty($arr)) { // If there is no error message then execute the query;
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

	

	function validate_values() {
		// Create the array which contains the Language variable
		$error = array();
				// Define the Language variable for each type of error
		if(empty($this->name) || empty($this->email) || empty($this->message)) {
			$error[] .= 'star_fields';
		}
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$error[] .= 'invalid_email';
		}		

		return $error;
	}

}
?>