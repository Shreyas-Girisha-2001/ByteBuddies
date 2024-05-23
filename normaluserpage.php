<!-- Authors: Shreyas Girisha, Bala Sai Chukkapalli -->
<?php
session_start(); // Start the session

// Check if the session variable 'username' is set
if (!isset($_SESSION['username'])) {
    // Redirect to login page or set a default value
    header("Location: login.php"); // Redirect to login page if 'username' is not set
    exit();
}

function getGreeting() {
    date_default_timezone_set('UTC'); // Setting default timezone to UTC
    $hour = date('G');
    if ($hour >= 5 && $hour < 12) {
        return "Good morning";
    } elseif ($hour >= 12 && $hour < 18) {
        return "Good afternoon";
    } else {
        return "Good evening";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User - ByteBuddies</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="content">
      <div class="app-info">
        <?php
        require "database.php";
        echo "<h1>Hello " . htmlspecialchars(getFirstName($_SESSION['username'])) . ", ".getGreeting() . ".</h1>"; ?>
	<center>
        <p>Click on buttons below based on your functions</p>
        <a href="#">
          <button>
            <span>Check Tweets</span>
          </button>
        </a><br>
        <a href="#">
          <button>
            <span>Update Profile Info</span>
          </button>
        </a><br>
        <a href="changepasswordform.php">
          <button>
            <span>Change Password</span>
          </button>
        </a><br>
        <a href="#">
          <button>
            <span>Delete Account</span>
          </button>
        </a><br>
        <a href="#">
          <button>
            <span>Contact Superuser</span>
          </button>
        </a>
        </center>
      </div>
    </div>
  </div>
</body>
</html>

