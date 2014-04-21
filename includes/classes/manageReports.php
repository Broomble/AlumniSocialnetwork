<?php

class manageReports {
	public $db;			// Database Property
	public $url;		// Installation URL Property
	public $per_page;	// Limit per page
	
	function getReports($start) {
		global $LNG;
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'AND `id` < \''.$this->db->real_escape_string($start).'\'';
		}
		// Query the database and get the latest 20 users
		// If load more is true, switch the query for the live query

		$query = sprintf("SELECT * FROM `reports`,`users` WHERE `reports`.`by` = `users`.`idu` AND `state` = 0 %s ORDER BY `reports`.`id` DESC LIMIT %s", $start, $this->db->real_escape_string($this->per_page + 1));
		
		$result = $this->db->query($query);
		
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		if(array_key_exists($this->per_page, $rows)) {
			$loadmore = 1;
			
			// Unset the last array element because it's not needed, it's used only to predict if the Load More Messages should be displayed
			array_pop($rows);
		}
		
		$users = '';	// Define the rows variable
		
		foreach($rows as $row) {
			if($row['type'] == 0) {
				$post = $row['parent'].'#comment'.$row['post'];
				$type = 'Comment';
			} else {
				$post = $row['post'];
				$type = 'Message';
			}
			$users .= '
			<div class="admin-rows" id="report'.$row['id'].'">
				<div class="table-report-id columns">'.$row['id'].'</div>
				<div class="table-report-message columns"><a href="'.$this->url.'/index.php?a=post&m='.$post.'">View the report</a></div>
				<div class="table-report-type columns">'.$type.'</div>
				<div class="table-user columns"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50" /><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'" target="_blank">'.$row['username'].'</a></div>
				<div class="table-report-safe columns"><a onclick="manage_report('.$row['id'].', '.$row['type'].', '.$row['post'].', 0)" title="'.$LNG['admin_reports_ttl_safe'].'">'.$LNG['admin_reports_safe'].'</a></div>
				<div class="table-report-safe columns"><a onclick="manage_report('.$row['id'].', '.$row['type'].', '.$row['post'].', 1)" title="'.$LNG['admin_reports_delete'].'">'.$LNG['admin_reports_delete'].'</a></div>
			</div>';
			$last = $row['id'];
		}
		if($loadmore) {
			$users .= '<div class="admin-load-more"><div class="message-container" id="more_reports">
					<div class="load_more"><a onclick="manage_the('.$last.', 1)">'.$LNG['view_more_messages'].'</a></div>
				</div></div>';
		}
		
		// Return the array set
		return $users;
	}
	
	function manageReport($id, $type, $post, $kind) {
		if($kind == 1) {
			// Prepare the statement to delete the message/comment from the database
			if($type == 1) {
				// Get the current type (for images deletion)
				$query = $this->db->query(sprintf("SELECT `type`, `value` FROM `messages` WHERE `id` = '%s'", $this->db->real_escape_string($post)));
				$row = $query->fetch_assoc();
				
				// Execute the deletePhotos function
				deletePhotos($row['type'], $row['value']);
			
				$stmt = $this->db->prepare("DELETE FROM `messages` WHERE `id` = '{$this->db->real_escape_string($post)}'");
			} else {
				$stmt = $this->db->prepare("DELETE FROM `comments` WHERE `id` = '{$this->db->real_escape_string($post)}'");
			}
			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;
			
			// Close the statement
			$stmt->close();
			
			$this->db->query("UPDATE `reports` SET `state` = '2' WHERE `post` = '{$this->db->real_escape_string($post)}' AND `type` = '{$this->db->real_escape_string($type)}'");
			return 1;
		} else {
			// Make the report safe
			$stmt = $this->db->prepare("UPDATE `reports` SET `state` = '1' WHERE `post` = '{$this->db->real_escape_string($post)}' AND `type` = '{$this->db->real_escape_string($type)}'");
			
			// Execute the statement
			$stmt->execute();
			
			// Save the affected rows
			$affected = $stmt->affected_rows;
			
			// Close the statement
			$stmt->close();
			
			// If the row has been affected
			return ($affected) ? 1 : 0;
		}
	}
	
}

?>