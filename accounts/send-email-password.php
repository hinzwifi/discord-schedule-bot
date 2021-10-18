<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id17388657_account';
$DATABASE_PASS = 'MJhaynes10MARKh3inz?';
$DATABASE_NAME = 'id17388657_accounts';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
if (empty($_POST['email'])) {
	// One or more values are empty.
	exit('You did not add anything!!!');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
	    
		// Check if email exists
		 $token = md5($_POST['email']).rand(10,9999);
     
         $expFormat = mktime(
         date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
         );
     
        $expDate = date("Y-m-d H:i:s",$expFormat);
    $emailID = ($_POST['email']);
        $update = mysqli_query($con,"UPDATE accounts set  reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $_POST['email'] . "'");
     
        // $link = "<a href='www.phpcodingstuff.com/reset-password.php?key=".$_POST['email']."&amp;token=".$token."'>Click To Reset password</a>";
//  $sql = "UPDATE accounts SET reset_link_token='bruh' WHERE id= 9 ";
//   $sql = "UPDATE accounts SET reset_link_token='noice' WHERE email=$emailID ";
if(mysqli_query($con, $update)){
    
} else {
    
}
 
 
	$from    = 'noreply@idasacommunity.tech';
$subject = 'Recovery Email';
$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
// Update the activation variable below
$activate_link = 'https://idasacommunity.tech/speedtest/email-password-verify.php?email=' . $_POST['email'] . "&amp;token=$token" ;
$message = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        h1, h4 {
            color: #232323;
        }

        .header {
            border-bottom: 2px solid #232323;
            background-color: #fff;
            text-align: center;
        }

        .footer {
            border-top: 2px solid #232323;
        }

        .footer > a {
            color: #232323;
        }

    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td align="center">
            <table width="600">
                <tr>
                    <td class="header">
                        <h1>Sinnerman Empire</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Change your password:</h2>
                        <p>Please click the following link to change your password: <br> <a href="' . $activate_link . '">' . $activate_link . '</a></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>
                        Regards,<br/>
                        Sinnerman
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        © Mark Joshua L. Haynes. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';
mail($_POST['email'], $subject, $message, $headers);
echo '<script type="text/javascript">'; 
echo 'window.location.href = "email-provider.html";';
echo '</script>'; 
} 
	
   else {
       //Shows an alert then goes back 
       echo '<script type="text/javascript">'; 
       echo 'alert("That email does not exist");';
       echo 'window.location.href = "forgot-password.html";';
       echo '</script>'; 
       
   }
}
