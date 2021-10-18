
    <!doctype html>
    <html lang="en">
       <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Reset Password</title>
          <!-- CSS -->
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="style.css">
		<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
		<style>
		    
.copy {
  	width: 100%;
  	padding: 15px;
 	
  	background-color: #3274d6;
  	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
  	
}
.copy:hover {
	background-color: #2868c7;
  	transition: background-color 0.2s;
}
.copy1 {
  	width: 100%;
  	padding: 15px;
 	
  	background-color: #3274d6;
  	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
  	border-radius: 0 0 15px 15px;
}
.copy1:hover {
	background-color: #ff0000;
  	transition: background-color 0.2s;
}
.login{
    border-radius:15px 15px 20px 20px;
}
center{
    padding-bottom:20px;
}
	    .validation-error {
    background-color: #ff0000 !important;
    
}

/* Success styling */
.validation-success {
    background-color: #00ff00 !important;
    
}

		</style>
			<script>
	function checkNames() {
    // Find the validation image div
    var validationElement1 = document.getElementById('checking1');
   var validationElement2 = document.getElementById('checking2');
    // Get the form values
    var name1 = document.forms["check"]["password"].value;
    var name2 = document.forms["check"]["cpassword"].value;
    // Reset the validation element styles
    
    
    validationElement1.className = 'validation-color1';
  validationElement2.className = 'validation-color2';
    // Check if name2 isn't null or undefined or empty
    if (name2) {
        // Show the validation element
       
        // Choose which class to add to the element
            validationElement1.className += (name1 == name2 ? ' validation-success' : ' validation-error');
            validationElement2.className += (name1 == name2 ? ' validation-success' : ' validation-error');
            
           
    }
    if(name1!==name2){
        document.getElementById("myBtn").disabled = true; 
    }
    else{
        document.getElementById("myBtn").disabled = false; 
    }
}
		</script>
       </head>
       <body>
          <div class="animate__animated animate__flipInX">
		<div class="login">
			<h1>Reset Password</h1>

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
               <form action="change-password.php" name="check" method="post">
                  <input type="hidden" name="email" value="<?php echo $email;?>">
                  <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
                  
                  
                  <label for="password" id="checking1" class="validation-color1">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" onblur="checkNames()" class="form-control" required>
				<label for="password" id="checking2" class="validation-color2" >
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="cpassword" placeholder="Password again" id="cpassword" onblur="checkNames()" class="form-control" required>
                      
                      
                      
                  <!--   <label for="exampleInputEmail1"></label>-->
                  <!--   					<i class="fas fa-lock"></i>-->
                  <!--   <input type="password" name='password' class="form-control">-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--   <label for="exampleInputEmail1"></label>-->
                  <!--   					<i class="fas fa-lock"></i>-->
                  <!--   <input type="password" name='cpassword' class="form-control">-->
                  <!--</div>-->
                  <input type="submit" id="myBtn" name="new-password" value="Submit Password!" class="copy1 btn btn-primary">
               </form>
               <?php 
                      
                  } }
                      
                   else{
                      echo '<center><strong>expired<strong></center>';
                  }
                  
                  }

                  ?>
            </div>
         </div>
      </div>
   </body>
    </html>