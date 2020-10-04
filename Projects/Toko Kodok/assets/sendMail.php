<?php
$to      = 'alexander.christianb@gmail.com'; // Send email to our user
$subject = 'TOKO KODOK EMAIL VERIFICATION'; // Give the email a subject 
$message = '
 
Thanks for joining TOKO KODOK!

Please click this link to activate your account:
http://localhost/verify.php?email='.$to.'&hash='.$subject.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
echo "HAI";
?>