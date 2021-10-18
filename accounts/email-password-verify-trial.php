
    <!doctype html>
    <html lang="en">
       <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Reset Password In PHP MySQL</title>
          <!-- CSS -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
       </head>
       <body>
          <div class="container">
             <div class="card">
                <div class="card-header text-center">
                   Reset Password In PHP MySQL
                </div>
            <div class="card-body">
               <?php
              session_start();
// First we check if the email and code exists...
                  if($_GET['email'] && $_GET['token'])
                  {
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
                  $email = $_GET['email'];
                  $token = $_GET['token'];
                  $query = mysqli_query($con,
                  "SELECT * FROM `accounts` WHERE `reset_link_token`='".$token."' and `email`='".$email."';"
                  );
                  $curDate = date("Y-m-d H:i:s");
                  if (mysqli_num_rows($query) > 0) {
                  $row= mysqli_fetch_array($query);
                  if($row['exp_date'] >= $curDate){
                  ?>
               <form action="change-password.php" method="post">
                  <input type="hidden" name="email" value="<?php echo $email;?>">
                  <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Password</label>
                     <input type="password" name='password' class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Confirm Password</label>
                     <input type="password" name='cpassword' class="form-control">
                  </div>
                  <input type="submit" name="new-password" class="btn btn-primary">
               </form>
               <?php 
                      
                  } }
                      
                   else{
                      echo '<center>expired</center>';
                  }
                  
                  }

                  ?>
            </div>
         </div>
      </div>
   </body>
    </html>