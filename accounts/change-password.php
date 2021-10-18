    <?php
    
    if (isset($_POST['password']) || $_POST['reset_link_token'] || $_POST['email']) {
        $DATABASE_HOST = '127.0.0.1';
                  $DATABASE_USER = 'u998276591_bruh';
                  $DATABASE_PASS = 'MJhaynes10';
                  $DATABASE_NAME = 'u998276591_bruh';
                  // Try and connect using the info above.
                  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                  if (mysqli_connect_errno()) {
                	// If there is an error with the connection, stop the script and display the error.
                	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                  }
        $emailId  = $_POST['email'];
        $token    = $_POST['reset_link_token'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query    = mysqli_query($con, "SELECT * FROM `accounts` WHERE `reset_link_token`='" . $token . "' and `email`='" . $emailId . "'");
        $row      = mysqli_num_rows($query);
        if ($row) {
            mysqli_query($con, "UPDATE accounts set  password='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
            echo '<p>Congratulations! Your password has been updated successfully. <a href="index.html">Click here to go back</a></p>';
        } else {
            echo "<p>Something went wrong. Please try again</p>";
        }
    }
    ?>