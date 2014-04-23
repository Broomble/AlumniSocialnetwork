<?php

function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings, $loggedIn;

	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

			header("Location: ".$CONF['url']."/index.php?a=feed");

		}else{
			if(isset($_POST['verify'])) {
				// Verification usage
				$ver = new verify();
				$ver->db = $db;
				$ver->url = $CONF['url'];
				$ver->enrollno = $_POST['enrollno'];
				$ver->name = $_POST['name'];
				$ver->fname = $_POST['fname'];		
				$ver->course = $_POST['course'];
				$ver->branch = $_POST['branch'];

				$ver->join = $_POST['jyear'].'-'.$_POST['tyear'];
				$ver->born = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
				//$ver->dob = $settings['captcha'];

				$TMPL['verificationMsg'] = $ver->process();

				if($TMPL['verificationMsg'] == 1) {
					header("Location: ".$CONF['url']."/index.php?a=verify");
				}

			}

			if(isset($_SESSION['enrollno']) || isset($_SESSION['born']) || isset($_SESSION['join']) || isset($_SESSION['course']) || isset($_SESSION['branch']) || isset($_SESSION['name'])) {		

					header("Location: ".$CONF['url']."/index.php?a=register");
					//unset($_SESSION['verify']);

			}
		}


	$TMPL['years'] = generateDateForm(0, $date[0]);
	$TMPL['months'] = generateDateForm(1, $date[1]);
	$TMPL['days'] = generateDateForm(2, $date[2]);			

	$TMPL['jyear'] = generateDateForm(0, $join[0]);
	$TMPL['tyear'] = generateDateForm(0, $join[1]);

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['Verify'].' - '.$settings['title'];

	$TMPL['ad'] = $settings['ad1'];

	$skin = new skin('register/verify');
	return $skin->make();
}

?>