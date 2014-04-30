<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;

				$dir = new alumnidir();
				$dir->db = $db;
				$dir->url = $CONF['url'];
				$dir->per_page = $settings['uperpage'];

			if(isset($_POST['search'])) {
				// Verification usage
				$dir->name = $_POST['name'];
				$dir->course = $_POST['course'];
				$dir->branch = $_POST['branch'];
				$dir->tyear = $_POST['tyear'];
				//$dir->dob = $settings['captcha'];

				$searchdata = "";

				if(!empty($_POST['name'])){
					$searchdata .= "concat_ws(' ', `first_name`, `last_name`) LIKE '%$dir->name%' AND ";
				}
				if(!empty($_POST['course'])){
					$searchdata .= "`course`='$dir->course' AND ";	
				}
				if(!empty($_POST['branch'])){
					$searchdata .= "`branch`='$dir->branch' AND ";
				}
				if(!empty($_POST['tyear'])){
					$searchdata .= "`join` LIKE '_____%$dir->tyear%' AND ";	
				}
				if($searchdata != "") $searchdata = " WHERE ".substr($searchdata,0,-5)." LIMIT 0 , 10";
					else $searchdata = $searchdata ." LIMIT 0 , 10";
				$dir->searchdata = $searchdata;
				$TMPL['users'] = $dir->dirgetSearch();
			}else{

				$TMPL['users'] = $dir->dirgetUsers(0);	
			}					
				$skin = new skin('welcome/directory'); $page = '';
			

				$TMPL['jyear'] = generateDateForm(0, $join[0]);
				$TMPL['tyear'] = generateDateForm(0, $join[1]);

				$TMPL['url'] = $CONF['url'];
				$TMPL['title'] = $LNG['Directory'].' - '.$settings['title'];
				// Save the array returned into a list
											
				return $skin->make();
				

}