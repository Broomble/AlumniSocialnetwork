<?php

class manageUsers {
	public $db;			// Database Property
	public $url;		// Installation URL Property
	public $per_page;	// Limit per page
	
	function getUsers($start) {
		global $LNG;
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'WHERE `idu` < \''.$this->db->real_escape_string($start).'\'';
		}
		// Query the database and get the latest 20 users
		// If load more is true, switch the query for the live query

		$query = sprintf("SELECT * FROM `users` %s ORDER BY `idu` DESC LIMIT %s", $start, $this->db->real_escape_string($this->per_page + 1));
		
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
			$users .= '
			<div class="admin-rows" id="user'.$row['idu'].'">
				<div class="table-id columns">'.$row['idu'].'</div>
				<div class="table-user columns"><img src="'.$this->url.'/thumb.php?src='.$row['image'].'&t=a&w=50&h=50" /><a href="'.$this->url.'/index.php?a=profile&u='.$row['username'].'" target="_blank">'.$row['username'].'</a></div>
				<div class="table-mail columns">'.$row['email'].'</div>
				<div class="table-edit columns"><a href="'.$this->url.'/index.php?a=admin&b=users&e='.$row['idu'].'" title="'.$LNG['admin_ttl_edit_profile'].'">'.$LNG['admin_ttl_edit'].'</a></div>
				<div class="table-delete columns"><a onclick="delete_user('.$row['idu'].')" title="'.$LNG['admin_ttl_delete_profile'].'">'.$LNG['admin_ttl_delete'].'</a></div>
			</div>';
			$last = $row['idu'];
		}
		if($loadmore) {
			$users .= '<div class="admin-load-more"><div class="message-container" id="more_users">
					<div class="load_more"><a onclick="manage_the('.$last.', 0)">'.$LNG['view_more_messages'].'</a></div>
				</div></div>';
		}
		
		// Return the array set
		return $users;
	}
	
	function getUser($id, $profile = null) {
		if($profile) {
			$query = sprintf("SELECT `idu`, `username`, `email`, `first_name`, `last_name`, `course`, `branch`, `join`, `enrollno`, `location`, `website`, `bio`, `facebook`, `twitter`, `gplus`, `born`, `verified` FROM `users` WHERE `username` = '%s'", $this->db->real_escape_string($profile));
		} else {
			$query = sprintf("SELECT `idu`, `username`, `email`, `first_name`, `last_name`, `course`, `branch`, `join`, `enrollno`, `location`, `website`, `bio`, `facebook`, `twitter`, `gplus`, `born`, `verified` FROM `users` WHERE `idu` = '%s'", $this->db->real_escape_string($id));
		}
		$result = $this->db->query($query);

		// If the user exists
		if($result->num_rows > 0) {
			
			$row = $result->fetch_assoc();

			return $row;
		} else {
			return false;
		}
	}
	
	function deleteUser($id) {
		// Prepare the statement to delete the user from the database
		$stmt = $this->db->prepare("DELETE FROM `users` WHERE `idu` = '{$this->db->real_escape_string($id)}'");

		// Execute the statement
		$stmt->execute();
		
		// Save the affected rows
		$affected = $stmt->affected_rows;
		
		// Close the statement
		$stmt->close();
		
		// If the user was returned
		if($affected) {
			// Delete the messages, comments, likes, relations and reports of the deleted user
			$this->db->query("DELETE FROM `messages` WHERE `uid` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `comments` WHERE `uid` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `likes` WHERE `by` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `reports` WHERE `by` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `relations` WHERE `subscriber` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `relations` WHERE `leader` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `chat` WHERE `from` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `chat` WHERE `to` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `blocked` WHERE `uid` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `blocked` WHERE `by` = '{$this->db->real_escape_string($id)}'");
			$this->db->query("DELETE FROM `notifications` WHERE `to` = '{$this->db->real_escape_string($id)}'");
			return 1;
		} else {
			return 0;
		}
	}



function dirgetUsers($start) {
		global $LNG;
		// If the $start value is 0, empty the query;
		if($start == 0) {
			$start = '';
		} else {
			// Else, build up the query
			$start = 'WHERE `idu` < \''.$this->db->real_escape_string($start).'\'';
		}
		// Query the database and get the latest 20 users
		// If load more is true, switch the query for the live query

		$query = sprintf("SELECT * FROM `users` %s ORDER BY `idu` DESC LIMIT %s", $start, $this->db->real_escape_string($this->per_page + 1));
		
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
			if($row['course'] == 'btech') {
				$course = 'Bachelor Of Technology';
			} elseif($row['course'] == 'mca') {
				$course = 'Master of Computer Applications';
			} elseif($row['course'] == 'mba') {
				$course = 'Master of Business Administration"';
			} 

			if($row['branch'] == 'ece') {
				$branch  = 'Electronics and Communication Engineering';
			} elseif($row['branch'] == 'cse') {
				$branch  = 'Computer Science Engineering';
			} elseif($row['branch'] == 'mae') {
				$branch  = 'Mechanical and Automation Engineering';
			} elseif($row['branch'] == 'eee') {
				$branch  = 'Electrical and Electronics Engineering';
			} elseif($row['branch'] == 'it') {
				$branch  = 'Information and Technology';
			} elseif($row['branch'] == 'ce') {
				$branch  = 'Civil Engineering';
			}elseif($row['branch'] == 'ene') {
				$branch  = 'Environmental Engineering';
			}
			$users .= '
				<div class="dir-card">
					<div id="dir-card">
				<div class="dir-card-cover"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['cover'])) ? $row['cover'] : 'default.png').'&w=900&h=300&t=c"></div>
			<div class="dir-card-avatar">
				<a href="'.$this->url.'/'.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['image'])) ? $row['image'] : 'default.png').'&t=a&w=112&h=112" /></a>
			</div>
			<div class="dir-card-info">
				<a href="'.$this->url.'/'.$row['username'].'"><span id="author'.$row['idu'].$row['username'].'"></span><span id="time'.$row['idu'].$row['username'].'"></span><div class="cover-username">'.realName($row['username'], $row['first_name'], $row['last_name']).''.((!empty($row['verified'])) ? '<img src="'.$this->url.'/'.$CONF['theme_url'].'/images/icons/verified.png" title="'.$LNG['verified_user'].'" />' : '').'</div></a>
			</div><div class="dir-card-divider"></div>
			'.((!empty($row['course'])) ? '<div class="dir-card-bio">'.$course.'<br>'.((!empty($row['branch'])) ? $branch : '').'<br>'.((!empty($row['join'])) ? $row['join'] : '').'</div>' : '').'</div></div>';
			$last = $row['idu'];
		}
		if($loadmore) {
				$users .= '<div class="admin-load-more"><div class="message-container" id="more_dirusers">
					<div class="load_more"><a onclick="manage_the_dir('.$last.')">'.$LNG['view_more_messages'].'</a>				
					</div>
				</div></div>';
		}
		
		// Return the array set
		return $users;
	}

}

?>