<?php

class alumnidir {
	public $db;			// Database Property
	public $url;		// Installation URL Property
	public $per_page;	// Limit per page
	public $name;				// The inserted username
	public $branch;				// The inserted password
	public $course;					// The inserted email
	public $jyear;
	public $tyear;

function dirgetSearch() {
			global $LNG;
			$arr = $this->validate_values(); // Must be stored in a variable before executing an empty condition
			if(empty($arr)) {
				$join = $this->jyear.'-'.$this->tyear;

					$query = $this->db->query(sprintf("SELECT * FROM `users` WHERE concat_ws(' ', `first_name`, `last_name`) LIKE '%s' AND `branch` = '%s' AND `course` = '%s'  AND `join` = '%s' ORDER BY `verified` DESC", '%'.$this->db->real_escape_string($this->name).'%', $this->db->real_escape_string($this->branch), $this->db->real_escape_string($this->course), $this->db->real_escape_string($join)));

				while($row = $query->fetch_assoc()) {
					$rows[] = $row;
				}
		
			$output = ' ';
			// If there are no results
			if(empty($rows)) {
				$output .= '<div class="pin"><div class="message-inner">'.$LNG['no_results'].'</div></div>';
			} else {
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
						$output .= '
							<div class="pin">
								<div id="dir-card">
							<div class="dir-card-cover"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['cover'])) ? $row['cover'] : 'default.png').'&w=900&h=300&t=c"></div>
						<div class="dir-card-avatar">
							<a href="'.$this->url.'/'.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['image'])) ? $row['image'] : 'default.png').'&t=a&w=112&h=112" /></a>
						</div>
						<div class="dir-card-info">
							<a href="'.$this->url.'/'.$row['username'].'"><span id="author'.$row['idu'].$row['username'].'"></span><span id="time'.$row['idu'].$row['username'].'"></span><div class="cover-username">'.realName($row['username'], $row['first_name'], $row['last_name']).''.((!empty($row['verified'])) ? '<img src="'.$this->url.'/themes/skins/images/icons/verified.png" title="'.$LNG['verified_user'].'" />' : '').'</div></a>
						</div><div class="dir-card-divider"></div>
						'.((!empty($row['course'])) ? '<div class="dir-card-bio">'.$course.'<br>'.((!empty($row['branch'])) ? $branch : '').'<br>'.((!empty($row['join'])) ? $row['join'] : '').'</div>' : '').'</div></div>';
				}
			}
			$output .= '</div></div>';		
		return $output;
	}else{
			foreach($arr as $err) {
				return dirnotificationBox('transparent', $LNG['error'], $LNG["$err"], 1); // Return the error value for translation file
			}
	}
}

function validate_values() {
	// Create the array which contains the Language variable
	$error = array();
	
	if(empty($this->name) && empty($this->course) && empty($this->branch) && empty($this->jyear) && empty($this->tyear)) {
		$error[] .= 'all_fields';
	}
	if(strlen($this->name) < 4) {
		$error[] .= 'user_too_short';
	}		
	return $error;
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
			$usera = '
				<div class="pin">
					<div id="dir-card">
				<div class="dir-card-cover"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['cover'])) ? $row['cover'] : 'default.png').'&w=900&h=300&t=c"></div>
			<div class="dir-card-avatar">
				<a href="'.$this->url.'/'.$row['username'].'"><img src="'.$this->url.'/thumb.php?src='.((!empty($row['image'])) ? $row['image'] : 'default.png').'&t=a&w=112&h=112" /></a>
			</div>
			<div class="dir-card-info">
				<a href="'.$this->url.'/'.$row['username'].'"><span id="author'.$row['idu'].$row['username'].'"></span><span id="time'.$row['idu'].$row['username'].'"></span><div class="cover-username">'.realName($row['username'], $row['first_name'], $row['last_name']).''.((!empty($row['verified'])) ? '<img src="'.$this->url.'/themes/skins/images/icons/verified.png" title="'.$LNG['verified_user'].'" />' : '').'</div></a>
			</div><div class="dir-card-divider"></div>
			'.((!empty($row['course'])) ? '<div class="dir-card-bio">'.$course.'<br>'.((!empty($row['branch'])) ? $branch : '').'<br>'.((!empty($row['join'])) ? $row['join'] : '').'</div>' : '').'</div></div>';

		$users .= str_replace('"', '\'', $usera);

			$last = $row['idu'];
		}
		if($loadmore) {
				$users .= "<div class='show-more'><div class='admin-load-more'><div class='message-container' id='more_dirusers'>
					<div class='load_more' id='".$last."'><a onclick='manage_the_dir(".$last.")'>Load More</a>				
					</div>
				</div></div></div>";
		}
		
		// Return the array set
		return $users;
	}
}

?>