<?php
$email = trim($_POST['email_register']);
$email_subject = 'Little Blessings Registration';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$message = "
<html>
<body style='text-align: center'>
<h2 style='text-align: center'>Thank you for your registration at Little Blessings.</h2>
<table rules='all' style='border-color: #666666;' cellpadding='10'>
<tr style='background: #eeeeee;'>
<th>Your username: </th>
<td>$username_register</td>
</tr>
<tr>
<th>Your email:</th>
<td>$email</td>
</tr>
<tr>
<th>Edit profile info:</th>
<td><a href='http://littleblessings.test/my_account'>Click here to change account info</a></td>
</tr>
</table>

</body>
</html>

";

mail($email, $email_subject, $message, $headers);
?>
