<?php 
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../accounts/index.html');
	exit;
}
include('inc/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>  
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

<title>hinzwifi memory</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/ajax.js"></script>	
<link rel="stylesheet" href="../hostinger-free.css" />
<style>
body {
    background:#232323;
}
thead{
    background:white;
}
tbody{
    background:white;
}
label {
    color: #CDCDCD;
}
div.dataTables_wrapper div.dataTables_info {
    color:  #CDCDCD;
}
<?php
if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
			{
				
			}
			else
			{
				echo ".delete,.update{
					display:none;
				}";
			}


?>
</style>
</head>
<body>


<div class="container contact">	
		
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   		
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-sm-9">
				    <?php
						if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
{
	 echo "<button type='button' name='add' id='addRecord' class='btn btn-success'>Add New Meeting</button>";
}
else
{
    echo "<button type='button' class='btn btn-danger' onclick='login()'>Log in</button>";
}
?>
				</div>
			</div>
		</div>
		<table id="recordListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Subject</th>					
					<th>Teacher</th>					
					<th>Link</th>
					<th>Schedule</th>
					<th>Day</th>
					<th></th>					
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	<div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="recordForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i>Edit Record</h4>
    				</div>
    				<div class="modal-body">
						<div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Name" id="subject" required="">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Subject Teacher</label>
                        <input type="text" name="subjectT" class="form-control" placeholder="Teacher" id="subjectT" required="">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="control-label">Google Meet Link</label>
                        <input type="url" name="meetLink" class="form-control" pattern="https?://meet.google.com/.+" placeholder="https://meet.google.com/" id="meetLink" required="">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Schedule</label>
                        <input type="time" class="form-control" id="meetSched" name="meetSched"  required="">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Schedule</label>
                        
                        <select class="form-control" name="meetDay" required="" id="meetDay">
                            <option value="">Please choose an option</option>
                            <option value="mwf">MWF</option>
                            <option value="tths">TTHS</option>
                            <option value="wed">Wed</option>
                            
                        </select>
                    </div>
                    
                    
                    </div>
									
    				</div>

    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	
</div>	
<?php include('inc/footer.php');?>

<script>
function login()
{
     location.href = "../";
} 
</script>
</body>
</html>
