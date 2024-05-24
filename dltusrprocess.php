<?php
require "database.php";
session_start();
$username = $_SESSION['username'];
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['userId'])) {
    if (deleteUser($username)) {
        $message = "User with username $username has been deleted.";
    } else {
        $message = "Failed to delete user with ID $username.";
    }
    // Redirect back to the form with a message
    header("Location: index.php?message=" . urlencode($message));
    exit;
}
?>
