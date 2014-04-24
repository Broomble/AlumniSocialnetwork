<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;


				$manageUsers = new manageUsers();
				$manageUsers->db = $db;
				$manageUsers->url = $CONF['url'];
				$manageUsers->per_page = $settings['uperpage'];
				
				$skin = new skin('welcome/directory'); $page = 10;
				
				// Save the array returned into a list
				$TMPL['users'] = $manageUsers->getUsers(0);
				
				
						

				

}