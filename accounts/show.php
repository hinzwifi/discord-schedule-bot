<!DOCTYPE html>
	<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1.0"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<title>Gallery</title>
	<style>
	
		body{background-color: #232323;
		color: #f2f2f2;
		    
		}
		.main{
		box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
		margin-top: 10px;
		    
		}
		h3{background-color: #4294D1;
		color: #f7f7f7; padding: 15px;
		border-radius: 4px; 
		box-shadow: 0 1px 6px rgba(57,73,76,0.35);
		    
		}
		.img-box{
		    margin-top: 20px;
		    
		}
		.img-block{
		    float: left; 
		    margin-right: 5px;
		    text-align: center;
		    
		}
		p{
		    margin-top: 0;
		    
		}
		img{ 
		    margin-bottom: 10px;
		    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
		    border:6px solid #f7f7f7;
		    
		}
	</style>
        	
            
          	<link rel="stylesheet" href="css/style.css">
            
            <!--Bootstrap JS-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
            </script>
            <script src="js/pop-up.js">
            </script>
            <style>
                .thumbnail{
                    width:100px;
                    height:100px;
                }
                
            .empty-slot{
                height:auto; !important
            }
            
            </style>
            
	</head>

	<body>
		<!-------------------Main Content------------------------------>
		<div class="container main">
			<h3>Showing Images</h3>
			<div class="img-box">
			    <ul id="all-images">
<?php
	
	/*-- we included connection files--*/
	include "connection.php";

	$result = mysqli_connect($host,$uname,$pwd) or die("Could not connect to database." .mysqli_error());
	mysqli_select_db($result,$db_name) or die("Could not select the databse." .mysqli_error());
	$image_query = mysqli_query($result,"select img_name,img_path from image_table");
	while($rows = mysqli_fetch_array($image_query))
	{
		$img_name = $rows['img_name'];
		$img_src = $rows['img_path'];
	?>
	
	<!--<div class="img-block">-->
	<!--<img src="<?php echo $img_src; ?>" alt="" title="<?php echo $img_name; ?>" class="img-responsive" />-->
	<!--<p><strong><?php echo $img_name; ?></strong></p>-->
	<!--</div>-->
    <li><img class="small-image" src="<?php echo $img_src; ?>" alt="" title="<?php echo $img_name; ?>" id="<?php echo $img_src; ?>"><center><?php echo $img_name; ?></center></li>  

    
	<?php
	}
?>

<div id="show_image_popup"  style="height:auto;" class="empty-slot">
  <div class="close-btn-area">
    <button id="close-btn"class="btn btn-danger"><i class="fa fa-times"></i></button> 
  </div>
  <div id="image-show-area">
    <img id="large-image" src="" alt="">
    
  </div>
  <div class="delete-btn-area">
    <button id="close-btn1" class="btn btn-danger"><i class="fa fa-trash"></i></button>
    
  </div>
</div>
			</div>
		</div>
	</body>
	</html>