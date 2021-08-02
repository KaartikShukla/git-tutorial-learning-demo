<?php
  ini_set('SMTP','myserver');
ini_set('smtp_port',25);
$to_email = "1816514007@kit.ac.in";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: kaartikshukla77@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
