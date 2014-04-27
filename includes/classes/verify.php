<?php
class verify{
	public $db; 					// Database Property
	public $url; 					// Installation URL Property
	public $fname;					// The inserted username
	//public $mname;					// The inserted password
	public $course;					// The inserted email
	public $branch;	
	public $join;				// The inserted captcha
	public $enrollno;				// The inserted enrollno
	public $born;
	public $name;

	
	function process() {
		global $LNG;

		$arr = $this->validate_values(); // Must be stored in a variable before executing an empty condition
		if(empty($arr)) { // If there is no error message then execute the query;
			//$this->query();
			
			// Set a session and log-in the user
			$_SESSION['enrollno'] = $this->enrollno;			
			$_SESSION['name'] = $this->name;		
			$_SESSION['course'] = $this->course;
			$_SESSION['branch'] = $this->branch;
			$_SESSION['born'] = $this->born;
			$_SESSION['join'] = $this->join;
				
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
	
	
	function verify_if_enrollno_exists() {
		$query = sprintf("SELECT `enroll_no` FROM `tbl_students_data` WHERE `enroll_no` = '%s'", $this->db->real_escape_string($this->enrollno));
		$result = $this->db->query($query);

		return ($result->num_rows == 0) ? 0 : 1;
	}

	function verify_if_name_exists() {
		$query = sprintf("SELECT `student_name` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `student_name` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string(strtolower($this->name)));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}
	
	function verify_if_fname_exists() {
		$query = sprintf("SELECT REPLACE(father_name, '.', '') AS `fname` FROM `tbl_students_data` WHERE `enroll_no` = '%s'", $this->db->real_escape_string($this->enrollno));
		$result = $this->db->query($query);

		$row = $result->fetch_assoc();
		$fresult = (strtolower($row['fname']) == strtolower($this->fname)) ? 1 : 0;

		$query = sprintf("SELECT `father_name` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `father_name` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string(strtolower($this->fname)));
		$result = $this->db->query($query);
		$oresult = ($result->num_rows != 0) ? 1 : 0;		

		return ($fresult == 1 || $oresult == 1) ? 1 : 0;

	}


	function verify_if_course_exists() {
		$query = sprintf("SELECT `course` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `course` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string($this->course));
		$result = $this->db->query($query);
		return ($result->num_rows == 0) ? 0 : 1;
	}


	function verify_if_branch_exists() {
		$query = sprintf("SELECT `branch` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `branch` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string($this->branch));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}

	function verify_if_join_exists() {
		$query = sprintf("SELECT `batch` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `batch` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string($this->join));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}

	function verify_if_born_exists() {
		$query = sprintf("SELECT `dob` FROM `tbl_students_data` WHERE `enroll_no` = '%s' AND `dob` = '%s'", $this->db->real_escape_string($this->enrollno), $this->db->real_escape_string($this->born));
		$result = $this->db->query($query);
		
		return ($result->num_rows == 0) ? 0 : 1;
	}

	function validate_values() {
		// Create the array which contains the Language variable
		$error = array();
		if(empty($this->enrollno) || empty($this->name) || empty($this->fname) || empty($this->course) || empty($this->born) || empty($this->join)) {
			$error[] .= 'all_fields';
		}
		if($this->course == 'btech' && empty($this->branch)){
			$error[] .= 'all_fields';
		}
		if(strlen($this->enrollno) < 10 || strlen($this->enrollno) > 11) {
			$error[] .= 'enrollno_too_short';
		}		
		if(!ctype_digit($this->enrollno)) {
			$error[] .= 'enrollno_digit';
		}
		// Define the Language variable for each type of error
		if($this->verify_if_enrollno_exists() == 0) {
			$error[] .= 'enrollno_exists';
		}
		if($this->verify_if_fname_exists() == 0) {
			$error[] .= 'fname_exists';
		}
		if($this->verify_if_name_exists() == 0) {
			$error[] .= 'name_exists';
		}
		if($this->verify_if_course_exists() == 0) {
			$error[] .= 'course_exists';
		}
		if($this->verify_if_branch_exists() == 0) {
			$error[] .= 'branch_exists';
		}
		if($this->verify_if_born_exists() == 0) {
			$error[] .= 'born_exists';
		}
		if($this->verify_if_join_exists() == 0) {
			$error[] .= 'join_exists';
		}
		return $error;
	}
	
}
?>