<?php

$txtfirstname = trim($_POST['txtfirstname']);
$txtlastname = trim($_POST['txtlastname']);
$txtaddress = trim($_POST['txtaddress']);
$txtaddress2 = trim($_POST['txtaddress2']);
$txtcity = trim($_POST['txtcity']);
$txtstate = trim($_POST['txtstate']);
$txtzipcode = trim($_POST['txtzipcode']);
$txthomephone = trim($_POST['txthomephone']);
$txtcellphone = trim($_POST['txtcellphone']);
$txtemail = trim($_POST['txtemail']);

$other = trim($_POST['other']);

$info  = "<b>First Name:</b> $txtfirstname<br>";
$info .= "<b>Last Name:</b> $txtlastname<br>";
$info .= "<b>Address:</b> $txtaddress-$txtaddress2<br>";
$info .= "<b>City:</b> $txtcity<br>";
$info .= "<b>State:</b> $txtstate<br>";
$info .= "<b>Zip Code:</b> $txtzipcode<br>";
$info .= "<b>Home Phone:</b> $txthomephone<br>";
$info .= "<b>Cell Phone:</b> $txtcellphone<br>";
$info .= "<b>Class:</b> $class<br>";
$info .= "<b>Email Address:</b> $txtemail<br>";

$info .= "<b>Other Information:</b> $other<br>";

send_mail("Website_Contact_Form", "noreply@equineintervention.com", "kylesav713@yahoo.com", "Contact Form - Equine Intervention, LLC", $info);

header("Location: thankyou.html");

function send_mail($fromname, $fromaddress, $toaddress, $subject, $message){
	$header  = "From: $fromname <$fromaddress>\r\n";
	$header .= "Reply-to: $fromaddress\r\n";
	$header .= "X-Mailer: Formmail.php\r\n";
	$header .= "Content-type: text/html";

	mail($toaddress, $subject, $message, $header);
}

?>