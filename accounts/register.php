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
if (!isset($_POST['username'], $_POST['password2'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password2']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	  echo '<script type="text/javascript">'; 
       echo 'alert("Email is not valid");';
       echo 'window.location.href = "register.html";';
       echo '</script>';
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    
     echo '<script type="text/javascript">'; 
       echo 'alert("Username is not valid");';
       echo 'window.location.href = "register.html";';
       echo '</script>'; 
}
if (strlen($_POST['password2']) > 20 || strlen($_POST['password2']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
	    
		// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code, reset_link_token, unique_folder) VALUES (?, ?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password2'], PASSWORD_DEFAULT);
	$uniqid = uniqid();
	  $uniquefolder = md5($_POST['username']);
	mkdir("pictures/$uniquefolder");
	$reset_link_token = uniqid();
$stmt->bind_param('ssssss', $_POST['username'], $password, $_POST['email'], $uniqid, $reset_link_token, $uniquefolder);
	$stmt->execute();
	$from    = 'noreply@yourdomain.com';
$subject = 'Account Activation Required';
$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
// Update the activation variable below
$activate_link = 'https://insta.idasacommunity.tech/upload-ids/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
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
                        <h2>Verify Your Email Address:</h2>
                        <p>Please click the following link to active your account: <br> <a href="' . $activate_link . '">' . $activate_link . '</a></p>
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
echo 'Please check your email to activate your account!';
} 
else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement this!';
}
	}
	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>
