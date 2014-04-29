<?php

function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;

			if(isset($_POST['contactus'])) {
				// Verification usage
				$contu = new contactus();
				$contu->db = $db;
				$contu->url = $contuF['url'];
				$contu->name = $_POST['name'];
				$contu->email = $_POST['email'];		
				$contu->enrollno = $_POST['enrollno'];	
				$contu->course = $_POST['course'];	
				$contu->branch = $_POST['branch'];
				$contu->message = $_POST['message'];
				$contu->join = $_POST['jyear'].'-'.$_POST['tyear'];
				$TMPL['contactusMsg'] = $contu->process();
				$mailmsg = '';
				$mailmsg .= "Name: $this->name \n";
				$mailmsg .= "Email: $this->email \n";
				$mailmsg .= "Course: $this->course \n";		
				$mailmsg .= "Branch: $this->branch \n";
				$mailmsg .= "Batch: $this->batch \n";
				$mailmsg .= "Enroll No: $this->enrollno \n";
				$mailmsg .= "Message: $this->message \n";

				if($TMPL['contactusMsg'] == 1) {
					sendMail($settings['email'], sprintf($LNG['ttl_admin_email'], $this->name), $mailmsg, $this->email);

					header("Location: ".$CONF['url']."/index.php?a=contactus");
				}
			}

	$TMPL['jyear'] = generateDateForm(0, $join[0]);
	$TMPL['tyear'] = generateDateForm(0, $join[1]);

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = 'Contact Us - '.$settings['title'];

	$TMPL['ad'] = $settings['ad1'];

	$skin = new skin('welcome/contactus');
	return $skin->make();
}
?>