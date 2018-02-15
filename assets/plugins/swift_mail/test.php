<?php

include_once "swift_required.php";

$subject = 'Testting email terlambat #123123123';
$from = array('no-reply@nyarievent.com' =>'no-reply');
$to = array(
 'mubasiahaan@gmail.com'  => ''
);

//$text = "Mandrill speaks plaintext";
$html = "<em>test test</em>";

$transport = Swift_SmtpTransport::newInstance('101.50.1.204', 26);
$transport->setUsername('no-reply@nyarievent.com');
$transport->setPassword('nyaripass');

$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
//$message->addPart($text, 'text/plain');
//$message->attach(Swift_Attachment::fromPath('2228.pdf'));

if ($recipients = $swift->send($message, $failures))
{
 echo 'Message successfully sent!';
} else {
 echo "There was an error:\n";
 print_r($failures);
}

?>