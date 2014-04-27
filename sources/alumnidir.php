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

				$dir->jyear = $_POST['jyear'];
				$dir->tyear = $_POST['tyear'];
				//$dir->dob = $settings['captcha'];

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