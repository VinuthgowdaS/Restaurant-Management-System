<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	
	//Sanitize the POST values
	$StreetAddress = ($_POST['sAddress']);
	$BoxNo = ($_POST['box']);
	$City = ($_POST['city']);
	$MobileNo = ($_POST['mNumber']);
	$LandlineNo = ($_POST['lNumber']);
	// check if the 'id' variable is set in URL

	// check if the 'id' variable is set in URL
	if (isset($_GET['id']))
	{
	// get id value
	$id = $_GET['id'];

	//Create INSERT query
	$qry = "INSERT INTO billing_details(member_id,Street_Address,P_O_Box_No,City,Mobile_No,Landline_No) VALUES('$id','$StreetAddress','$BoxNo','$City','$MobileNo','$LandlineNo')";
	mysqli_query($conn,$qry);
	
	//redirect to billing-success page
	header("location: billing-success.php");
	}else {
		die("Adding billing information failed! Please try again after a few minutes.");
	}
?>