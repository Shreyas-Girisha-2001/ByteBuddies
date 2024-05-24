<?php // changepassword.php
require "database.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_SESSION['username'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	$secq1= $_POST['securityquestion1'];
	$seca1= $_POST['securityanswer1'];
	$secq2= $_POST['securityquestion2'];
	$seca2= $_POST['securityanswer2'];
	$SecQNA= getResetPassInfo($username);

	if($username===-1){
		echo "<script type='text/javascript'>
		    alert('You need to login first');
		    </script>";
		header("Refresh:0; url=loginform.php");
		die();
	}
	
	if(usernameExists($username)===false){
		echo "<script type='text/javascript'>
		    alert('username not found');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	} if($password!=$rpassword){
		echo "<script type='text/javascript'>
		    alert('Password does not match');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}
	if($SecQNA['question1']!=$secq1){
		echo "<script type='text/javascript'>
		    alert('Security question number 1 that you chose is wrong , try again .');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}else if($SecQNA['answer1']!=$seca1){
		echo "<script type='text/javascript'>
		    alert('Answer for security question 1 is wrong try again');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}else if($SecQNA['question2']!=$secq2){
		echo "<script type='text/javascript'>
		    alert('Security question number 2 that you chose is wrong , try again .');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}else if($SecQNA['answer2']!=$seca2){
		echo "<script type='text/javascript'>
		    alert('Answer for security question 2 is wrong try again');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}
	if($SecQNA['question1']===$secq1 && $SecQNA['question2']===$secq2 && $SecQNA['answer1']===$seca1 && $SecQNA['answer2']===$seca2){
		$result=changepassword($username,$password);
		echo "<script type='text/javascript'>
		    alert('Password does not match');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}else{
		echo "<script type='text/javascript'>
		    alert('Security questions and answers mismatched, Change password operation failed');
		    </script>";
		header("Refresh:0; url=changepasswordform.php");
		die();
	}
}
?>

