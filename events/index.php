<?php 
// Include calendar helper functions 
require_once 'functions.php'; 
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>hinzwifi Calendar</title>
<meta charset="utf-8">
<!-- Stylesheet file -->
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- jQuery library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- SweetAlert plugin to display alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<style>
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{display:none;}
    select {
        display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    border: .0625rem solid #ccc;
    border-radius: .25rem;
    }
    </style>
</head>
<body style="background:#232323;">
	<!-- Display event calendar -->
	<div id="calendar_div">
		<?php echo getCalender(); ?>
	</div>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

</body>
</html>