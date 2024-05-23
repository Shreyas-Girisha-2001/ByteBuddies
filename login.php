<!-- Authors: Shreyas Girisha, Bala Sai Chukkapalli -->
<?php
require "database.php";

// Set session cookie parameters
$lifetime = 15 * 60; // 15 minutes
$path = '/ByteBuddies';
$domain = 'udshrey';
$secure = false; // Set to true if using HTTPS
$httponly = true;

session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
session_start();

// Function to get the greeting based on time
function loginFailed() {
    echo "<script type='text/javascript'>
    alert('Login failed. Incorrect username or password.');
    window.history.back();
    </script>";
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check login credentials
    if (securechecklogin($username, $password)) {
        // Assuming $username holds the username value
        // Check user role
        $role = getUserRole($username);
        if ($role === 0) {
            $_SESSION['username'] = $username;
            header("Location: normaluserpage.php"); // Redirect to normal user page
            exit();
        } else if ($role === 1) {
            $_SESSION['username'] = $username;
            header("Location: superuserpage.php"); // Redirect to superuser page
            exit();
        } else {
            echo "<script type='text/javascript'>
            alert('Something went wrong! Try contacting the developers about your issue.');
            window.history.back();
            </script>";
        }
    } else {
        loginFailed();
    }
}

$conn->close();
?>
