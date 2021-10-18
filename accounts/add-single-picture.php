<?php
	session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
	
}

// $DATABASE_HOST = '127.0.0.1';
// $DATABASE_USER = 'u998276591_bruh';
// $DATABASE_PASS = 'MJhaynes10';
// $DATABASE_NAME = 'u998276591_bruh';
// // Try and connect using the info above.
// $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	/*-- we included connection files--*/
	include "connection.php";

	/*--- we created a variables to display the error message on design page ------*/
	$error = "";
// $stmt = $con->prepare('SELECT unique_folder FROM accounts WHERE email = ?');

	if (isset($_POST["btn_upload"]) == "Upload")
	{
	        
		$file_tmp = $_FILES["fileImg"]["tmp_name"];
// 		$file_name = $_FILES["fileImg"]["name"];
		
		$file_name2 = $_FILES["fileImg"]["name"];
        $file_name = md5($file_name2);
        $file_name .= $_FILES["fileImg"]["name"];
		/*image name variable that you will insert in database ---*/
		$image_name = $_POST["img-name"];
		$randomid = uniqid();
	
          $uniquefolder = md5("$randomid");
	      mkdir("photo/$uniquefolder");   
		//image directory where actual image will be store
		$file_path = "photo/$uniquefolder/".$file_name;	

	/*---------------- php textbox validation checking ------------------*/
	if($image_name == "") 
	{
		$error = "Please enter Image name.";
     
	}

	/*-------- now insertion of image section has start -------------*/
	else
	{
		if(file_exists($file_path))
		{
			$error = "Sorry,The <b>".$file_name."</b> image already exist.";
		}
			else
			{
			    $error1 = "$unique_folder";
				$result = mysqli_connect($host, $uname, $pwd) or die("Connection error: ". mysqli_error());
				mysqli_select_db($result, $db_name) or die("Could not Connect to Database: ". mysqli_error());
				mysqli_query($result,"INSERT INTO image_table(img_name,img_path)
				VALUES('$image_name','$file_path')") or die ("image not inserted". mysqli_error());
				move_uploaded_file($file_tmp,$file_path);
				$error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";
			
			}
		}
	}
		
	?>
	
	<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1.0"/>
	<title>Image Upload - Campuslife</title>
	<style>
	
		html, body{background: #ececec; height: 100%; margin: 0; font-family: Arial;}
		.main{height: 100%; display: flex; justify-content: center;}
		.main .image-box{width:300px; margin-top: 30px;}
		.main h2{text-align: center; color: #4D4D4D;}
		.main .tb{width: 100%; height: 40px; margin-bottom: 5px; padding-left: 5px;}
		.main .file_input{margin-top: 10px; margin-bottom: 10px;}
		.main .btn{width: 100%; height: 40px; border: none; border-radius: 3px; background: #27a465; color: #f7f7f7;}
		.main .msg{color: red; text-align: center;}
	
	</style>
	
	</head>

	<body>
	<!-------------------Main Content------------------------------>
	<div class="container main" >
		<div class="image-box">
			<h2> <a href="show.php"style="text-decoration:none;">Image Upload</a></h2>
			<form method="POST" name="upfrm" action="" enctype="multipart/form-data">
				<div>
					<input type="text" placeholder="Enter image name" name="img-name" class="tb" />
					<input type="file" name="fileImg" class="file_input" />
					<input type="submit" value="Upload" name="btn_upload" class="btn" />
				</div>
			</form>
			
			<div class="msg">
<strong>
		<?php if(isset($error)){echo $error;}?>
	</strong>
			</div><div class="msg">
<strong>
		<?php if(isset($error1)){echo $error1;}?>
	</strong>
			</div>
		</div>
	</div>
	
	
	
	</body>
	</html>