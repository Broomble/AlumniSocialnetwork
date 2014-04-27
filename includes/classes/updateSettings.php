<?php

class updateSettings {
	public $db;		// Database Property
	public $url;	// Installation URL Property

	function query_array($table, $data) {
	
		// Get the columns of the query-ed table
		$available = $this->getColumns($table);

		foreach ($data as $key => $value) {
			// Check if all arrays introduced are available table fields
			if(!array_key_exists($key, $available)) {	
				$x = 1;
				return 0;
			}
		}
		
		// If all array keys are valid database columns
		if($x !== 1) {
			foreach ($data as $column => $value) {
				$columns[] = sprintf("`%s` = '%s'", $column, $this->db->real_escape_string($value));
			}
			$column_list = implode(',', $columns);
			
			// Prepare the database for specific page
			if($table == 'admin') {
				// Prepare the statement
				$stmt = $this->db->prepare("UPDATE `$table` SET `password` = md5('{$data['password']}') WHERE `username` = '{$_SESSION['usernameAdmin']}'");
				$_SESSION['passwordAdmin'] = md5($data['password']);
			} else {
				// Prepare the statement
				$stmt = $this->db->prepare("UPDATE `$table` SET $column_list");		
			}

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
	
	function getColumns($table) {
		if($table == 'admin') {
			$query = $this->db->query("SHOW columns FROM `$table` WHERE Field NOT IN ('id', 'username')");
		} else {
			$query = $this->db->query("SHOW columns FROM `$table`");
		}
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
}
?>