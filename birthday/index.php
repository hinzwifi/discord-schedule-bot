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
	 echo "<button type='button' name='add' id='addRecord' class='btn btn-success'>Add New Celebrant</button>";
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
					<th>First Name</th>					
					<th>Family Name</th>					
					<th>Phone Number</th>
					<th>Month & Day</th>
					<th>Year</th>
										
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
						<div class="form-group">
							<label for="name" class="control-label">First Name</label>
										
							<input type="text" name="username" class="form-control" placeholder="Name" id="username" required>	
						</div>
						<div class="form-group">
							<label for="age" class="control-label">Surname</label>							
							<input type="text" name="surname" class="form-control" placeholder="Family Name" id="surname" required>						
						</div>	   	
						<div class="form-group">
							<label for="lastname" class="control-label">Phone Number</label>							
							<input id="usernumber" type="text" class="form-control" pattern="^\d{11}$" name="usernumber" placeholder="11-digit number"  required >							
						</div>	 
						<div class="form-group">
							<label for="address" class="control-label">Year</label>							
							<select id='year' name="useryear" class="form-control"></select>							
						</div>	
						<div class="form-group">
							<label for="address" class="control-label">Month</label>							
							<select id='month' name="usermonth" class="form-control"></select>							
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">Day</label>							
							<select id="day" name="userday" class="form-control"></select>		
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
$(document).ready(function() {
  const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  let qntYears = 10;
  let selectYear = $("#year");
  let selectMonth = $("#month");
  let selectDay = $("#day");
  let currentYear = new Date().getFullYear();

  for (var y = -50; y < qntYears; y++) {
    let date = new Date(currentYear);
    let yearElem = document.createElement("option");
    yearElem.value = currentYear
    yearElem.textContent = currentYear;
    selectYear.append(yearElem);
    currentYear--;
  }

  for (var m = 0; m < 12; m++) {
    let month = monthNames[m];
    let monthElem = document.createElement("option");
    monthElem.value = m;
    monthElem.textContent = month;
    selectMonth.append(monthElem);
  }

  var d = new Date();
  var month = d.getMonth();
  var year = d.getFullYear();
  var day = d.getDate();

  selectYear.val(year);
  selectYear.on("change", AdjustDays);
  selectMonth.val(month);
  selectMonth.on("change", AdjustDays);

  AdjustDays();
  selectDay.val(day)

  function AdjustDays() {
    var year = selectYear.val();
    var month = parseInt(selectMonth.val()) + 1;
    selectDay.empty();

    //get the last day, so the number of days in that month
    var days = new Date(year, month, 0).getDate();

    //lets create the days of that month
    for (var d = 1; d <= days; d++) {
      var dayElem = document.createElement("option");
      dayElem.value = d;
      dayElem.textContent = d;
      selectDay.append(dayElem);
    }
  }
});</script>
<script>
function login()
{
     location.href = "../";
} 
</script>
</body>
</html>