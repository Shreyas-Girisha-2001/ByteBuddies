<?php // session_auth.php
// Set a variable for each parameter
$lifetime = 10 * 60; // 10 minutes
$path = '/lab6';
$domain = 'udshrey'; // replace with your domain
$secure = true; // cookie should only be sent over secure connections
$httponly = true; // cookie will only be accessible over the HTTP protocol
// Set the session cookie parameters
session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
session_start();
// session is not authenticated
if (!$_SESSION["logged"]) {
	echo "<script>alert('You have to login first!');</script>";
	session_destroy();
	header("Refresh:0; url=form.php");
	die();
}
// a session hijacking attack because it comes from a different browser
if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]) {
	echo "<script>alert('Session hijacking is detected! Use your own username and password to log in!');</script>";
	session_destroy();
	header("Refresh:0; url=form.php");
	die();
}
?>
