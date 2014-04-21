<?php
// Set the header
header("Content-type: image/jpeg");

// Start the session
session_start(); 

// Generate the 5 digits string
$text = rand(10000,99999); 

// Store the generated code into the _SESSION captcha
$_SESSION['captcha'] = $text;
 
// Define the Image Height & Width
$width = 75;
$height = 37;  

// Create the Image
$image = imagecreate($width, $height); 

// Set the background color
$black = imagecolorallocate($image, 88, 180, 22);
// Set the text color
$white = imagecolorallocate($image, 255, 255, 255);

// Set the font size
$font_size = rand(); 

// Generate noise
// for($noise = 0; $noise <= 20; $noise++) {
	// $x = mt_rand(10, $width-10);
	// $y = mt_rand(10, $height-10);
	// imageline($image, $x, $y, $x, $y, $white);
// }

// Draw the string with the given coordinates
imagestring($image, $font_size, 15, 10, $text, $white);

imageline($image, 0, mt_rand(5, $height-5), $width, mt_rand(5, $height-5), $white);
imageline($image, mt_rand(10, $width-10), 0, 0, mt_rand(10, $width-10), $white);

// Output the $image, don't save the file name, set quality
imagejpeg($image, null, 100); 
?>