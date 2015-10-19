<?php
$to      = 'florenz.erstling@gmx.de';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mail= mail($to, $subject, $message, $headers);
if ($mail){
	echo "jo";
} else {
	echo "nönö";
}
?>