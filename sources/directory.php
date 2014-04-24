<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;


				$dir = new manageUsers();
				$dir->db = $db;
				$dir->url = $CONF['url'];
				$dir->per_page = $settings['uperpage'];
								
				$skin = new skin('welcome/directory'); $page = '';
			
				$TMPL['url'] = $CONF['url'];
				$TMPL['title'] = $LNG['Directory'].' - '.$settings['title'];
				// Save the array returned into a list
				$TMPL['users'] = $dir->dirgetUsers(0);				
										
return $skin->make();
				

}