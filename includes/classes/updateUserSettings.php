<?php
class updateUserSettings {
	public $db;		// Database Property
	public $url;	// Installation URL Property
	public $id;		// Logged in user id
	
	function validate_inputs($data) {
		if(isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return array('valid_email');
		}
		
		if(!filter_var($data['website'], FILTER_VALIDATE_URL) && !empty($data['website'])) {
			return array('valid_url');
		}
		
		if(isset($data['email']) && $this->verify_if_email_exists($this->id, $data['email'])) {
			return array('email_exists');
		}
		
		if(strlen($data['bio']) > 160) {
			return array('bio_description', 160);
		}
		
		if(isset($data['year']) || isset($data['month']) || isset($data['day'])) {
			if($data['year'] < date('Y') - 100 || $data['year'] > date('Y') || checkdate($data['month'], $data['day'], $data['year']) == false) {
				return array('incorrect_date');
			}
		}
		
		if(isset($data['password']) && strlen($data['password']) < 3) {
			return array('password_too_short');
		}
	}

	function query_array($table, $data) {
		global $LNG;
		// Validate the inputs
		$validate = $this->validate_inputs($data);
		
		if($validate) {
			return notificationBox('error', $LNG['error'], sprintf($LNG["{$validate[0]}"], $validate[1]));
		}
		
		// add the born value
		if(isset($data['day']) || isset($data['month']) || isset($data['year'])) {
			$data['born'] = date("Y-m-d", mktime(0, 0, 0, $data['month'], $data['day'], $data['year']));
		}
		
		// Unset the day/month/verified values
		unset($data['day']);
		unset($data['month']);
		unset($data['year']);

		// add the join value
		if(isset($data['jyear']) || isset($data['tyear'])) {
			$data['join'] = $data['jyear'].'-'.$data['tyear'];
		}
		
		// Unset the values
		unset($data['jyear']);
		unset($data['tyear']);
		
		// Get the columns of the query-ed table
		$available = $this->getColumns($table);
		
		foreach ($data as $key => $value) {
			// Check if password array key exist and set a variable if so
			if($key == 'password') {
				$password = true;
			}
			
			// Check if all arrays introduced are available table fields
			if(!array_key_exists($key, $available)) {
				$x = 1;
				break;
			}
		}
		
		// If the password array key exists, encrypt the password
		if($password) {
			$data['password'] = md5($data['password']);
		}
		
		// If all array keys are valid database columns
		if($x !== 1) {
			foreach ($data as $column => $value) {
				$columns[] = sprintf("`%s` = '%s'", $column, $this->db->real_escape_string($value));
			}
			$column_list = implode(',', $columns);

			// Prepare the statement
			$stmt = $this->db->prepare("UPDATE `$table` SET $column_list WHERE `idu` = '{$this->id}'");		

			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;
			
			// Close the statement
			$stmt->close();
			
			// If the SQL was executed, and the password field was set, save the new password
			if($affected && $password) {
				if(isset($_COOKIE['password'])) {
					setcookie("password", $data['password'], time() + 30 * 24 * 60 * 60); // Expire in one month
				} else {
					$_SESSION['password'] = $data['password'];
				}
			}

			// If there was anything affected return 1
			if($affected) {
				return notificationBox('success', $LNG['settings_saved'], $LNG['overall_settings_saved']);
			} else {
				return notificationBox('info', $LNG['nothing_changed'], $LNG['general_settings_unaffected']);
			}
		}
	}
	
	function getColumns($table) {
		
		$query = $this->db->query("SHOW columns FROM `$table` WHERE Field NOT IN ('idu', 'username', 'date', 'salted')");

		// Define an array to store the results
		$columns = array();
		
		// Fetch the results set
		while ($row = $query->fetch_array()) {
			// Store the result into array
			$columns[] = $row[0];
		}
		
		// Return the array;
		return array_flip($columns);
	}
	
	function queryBackgrounds($option) {
		// Available option
		$available = $this->scanBackgrounds();

		// Scan the user's option to see if it's available
		if(in_array($option, $available)) {
			
			// Prepare the statement
			$stmt = $this->db->prepare("UPDATE `users` SET `background` = '{$this->db->real_escape_string($option)}' WHERE `idu` = '{$this->id}'");

			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;
			
			// Close the statement
			$stmt->close();

			// If there was anything affected return 1
			return ($affected) ? 1 : 0;
		}
	}

	function scanBackgrounds() {
		// Set the directory location
		$imagesDir = './images/backgrounds/';
		
		// Search for pathnames matching the .png pattern
		$images = glob($imagesDir . '*.{png}', GLOB_BRACE);
		
		// Add to array the available images
		foreach($images as $img) {
			// The path to be parsed
			$path = pathinfo($img);
			
			// Add the filename into $available array
			$available[] = $path['filename'];
		}
		
		return $available;
	}
	
	function deleteAvatar($image) {
		// Prepare the statement
		$stmt = $this->db->prepare("UPDATE `users` SET `image` = 'default.png' WHERE `idu` = '{$this->id}'");

		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;
		
		// Close the statement
		$stmt->close();
		
		// If the change was made, then unlink the old image
		if($affected) {
			unlink('uploads/avatars/'.$image);
		}

		// If there was anything affected return 1
		return ($affected) ? 1 : 0;
	}
	
	function verify_if_email_exists($id, $email) {
		$query = sprintf("SELECT `idu`, `email` FROM `users` WHERE `idu` != '%s' AND `email` = '%s'", $this->db->real_escape_string($id), $this->db->real_escape_string(strtolower($email)));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function getSettings() {
		$result = $this->db->query(sprintf("SELECT * FROM `users` WHERE `idu` = '%s'", $this->db->real_escape_string($this->id)));
		
		return $result->fetch_assoc();
	}
}
?>