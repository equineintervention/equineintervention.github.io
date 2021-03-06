<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Emailing Form Data</title>
<style type="text/css">
code {color:#F00C4D;font-weight:bold;font-size:1.2em}
i {color: #6D0CF0}
th, td {padding:.1em;border:1px solid blue;text-align:left}
</style>
</head>
<body>


<?php
//This is a very simple PHP script that outputs the name of each bit of information (that corresponds to the <code>name</code> attribute for that field) along with the value that was sent with it right in the browser window, and then sends it all to an email address (once you've added it to the script).

if (empty($_POST)) {
	print "<p>No data was submitted.</p>";
	print "</body></html>";
	exit();
}

//Creates function that removes magic escaping, if it's been applied, from values and then removes extra newlines and returns to foil spammers. Thanks Larry Ullman!
function clear_user_input($value) {
	if (get_magic_quotes_gpc()) $value=stripslashes($value);
	$value= str_replace( "\n", '', trim($value));
	$value= str_replace( "\r", '', $value);
	return $value;
	}


if ($_POST['comments'] == 'Please share any comments you have here') $_POST['comments'] = '';	

//Create body of message by cleaning each field and then appending each name and value to it

$body ="Here is the data that was submitted:\n";

foreach ($_POST as $key => $value) {
	$key = clear_user_input($key);
	$value = clear_user_input($value);
	if ($key=='extras') {
		
	if (is_array($_POST['extras']) ){
		$body .= "$key: ";
		$counter =1;
		foreach ($_POST['extras'] as $value) {
				//Add comma and space until last element
				if (sizeof($_POST['extras']) == $counter) {
					$body .= "$value\n";
					break;}
				else {
					$body .= "$value, ";
					$counter += 1;
					}
				}
		} else {
		$body .= "$key: $value\n";
		}
	} else {

	$body .= "$key: $value\n";
	}
}

extract($_POST);
//removes newlines and returns from $email and $name so they can't smuggle extra email addresses for spammers
$email = clear_user_input($email);
$name = clear_user_input($name);

//Create header that puts email in From box along with name in parentheses and sends bcc to alternate address
$from='From: Equine_Intervention'. $email . "(" . $name . ")" . "\r\n" . 'Bcc: horsedoctor@bellsouth.net' . "\r\n";


//Creates intelligible subject line that also shows me where it came from
$subject = 'Potential Client: Equine Intervention, LLC';

//Sends mail to me, with elements created above
mail ('horsedoctor@bellsouth.net', $subject, $body, $from);

header("Location: thankyou.html");
?>



</body>
</html>
