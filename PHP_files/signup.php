<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Basic validation
  if (empty($username) || empty($email) || empty($password)) {
    $error = "All fields are required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } else {
    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
      $success = "User registered successfully";
    } else {
      $error = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
$conn->close();
?>
