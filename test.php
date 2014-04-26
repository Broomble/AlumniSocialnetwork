	<?php

include("/includes/config.php");
include("/includes/classes.php");
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");
		
/*		$query = $this->db->query(sprintf("SELECT `father_name` FROM `tbl_students_data` WHERE `enroll_no` = '%s'", $this->db->real_escape_string($this->enrollno)));
		$result = $query->fetch_assoc();
		$fna = $result['father_name'];
		$query1 = sprintf("SELECT REPLACE('%s',  '.',  '') AS fname", $fna);
		$result1 = $this->db->query($query1);
		$data = $result1->fetch_assoc();
		return ($data['fname'] == $this->db->real_escape_string(strtolower($this->fname))) ? 1 : 0;*/


/*		$fna = 'Rakesh. Pandey.';
		$query1 = sprintf("SELECT REPLACE('%s',  '.',  '') AS fname", $fna);
		$result1 = $db->query($query1);
		$data = $result1->fetch_assoc();
		echo ($data['fname'] == $db->real_escape_string(strtolower('Rakesh Pandey'))) ? 0 : 1;
	*/
	
		$query = $db->query("SELECT father_name AS fname FROM `tbl_students_data` WHERE `enroll_no` = '16615602710'");
		$result = $query->fetch_assoc();
		$data = $result['fname'];
		echo $data;
		echo ($data == $db->real_escape_string(strtolower('Rakesh Pandey'))) ? 1 : 0;
	



	?>