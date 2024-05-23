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
	
	if(usernameExists($username)===false){
		echo "<script type='text/javascript'>
		    alert('username not found');
		    </script>";
	} if($password!=$rpassword){
		echo "<script type='text/javascript'>
		    alert('Password does not match');
		    </script>";
	}
	if($SecQNA['question1']===$secq1 && $SecQNA['question2']===$secq2 && $SecQNA['answer1']===$seca1 && $SecQNA['answer2']===$seca2){
		$result=changepassword($username,$password);
		echo $result;
	}else{
		echo "<script type='text/javascript'>
		    alert('Security questions and answers mismatched, Change password operation failed');
		    </script>";
	}
}
?>

