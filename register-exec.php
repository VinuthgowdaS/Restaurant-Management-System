<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	//Sanitize the POST values
	$fname = ($_POST['fname']);
	$lname = ($_POST['lname']);
	$login = ($_POST['login']);
	$password = ($_POST['password']);
	$cpassword = ($_POST['cpassword']);
    $question_id = ($_POST['question']);
    $answer = ($_POST['answer']);
    
    //check whether an account with a given email exists
    $qry_select="SELECT * FROM members WHERE login='$login'";
    $result_select=mysqli_query($conn,$qry_select);
    if(mysqli_num_rows($result_select)>0){
        header("location: register-failed.php");
        exit();
    }
    else{
	    //Create INSERT query
	    $qry = "INSERT INTO members(firstname, lastname, login, passwd, question_id, answer) VALUES('$fname','$lname','$login','".md5($_POST['password'])."','$question_id','".md5($_POST['answer'])."')";
	    $result = @mysqli_query($conn,$qry);
	    
	    //Check whether the query was successful or not
	    if($result) {
		    header("location: register-success.php");
		    exit();
	    }else {
		    die("Something went wrong.\n Our team is working on it at the  moment.\n Please try again after some few minutes.");
	    }
    }
?>