<?php
$email = $customer->email;
$email_subject = 'Little Blessings Password Reset Confirmation';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$message = "
<html>
<body style='text-align: center'>
<h2 style='text-align: center'>Password Reset Confirmation.</h2>
<table rules='all' style='border-color: #666666;' cellpadding='10'>
<tr style='background: #eeeeee;'>
<th>Your username: </th>
<td>$customer->username</td>
</tr>
<tr>
<th>Your email:</th>
<td>$customer->email</td>
</tr>
<tr>
<th colspan='2'>Password Changed Successfully </th>
</tr>
<tr>
<th colspan='2'>If this wasn't you. Please contact support. </th>
</tr>
</table>

</body>
</html>

";

mail($email, $email_subject, $message, $headers);
?>