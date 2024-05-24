<?php
require "database.php";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $firstname = test_input($_POST['firstname']);
    $middlename = test_input($_POST['middlename']);
    $lastname = test_input($_POST['lastname']);
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $cpassword = test_input($_POST['cpassword']);
    $bio = test_input($_POST['bio']);
    $superuser=0;
    $securityQuestion1 = test_input($_POST['securityquestion1']);
    $securityAnswer1 = test_input($_POST['securityanswer1']);
    $securityQuestion2 = test_input($_POST['securityquestion2']);
    $securityAnswer2 = test_input($_POST['securityanswer2']);

    // Validation for bio
    if (strlen($bio) > 200) {
        // Display an alert message if bio exceeds 200 characters
        echo "<script>alert('Bio must be 200 characters or less');</script>";
        header ("Refresh:0; url=signup.html");
	    die();
    }

    // Validation for first name
    if (empty($firstname)) {
        // Display an alert message if first name is empty
        echo "<script>alert('First Name is required');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }
    
    if(strlen($firstname)>50) {
    // Display an alert message if first name is empty
        echo "<script>alert('First Name should be less then 50 characters');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }
    
    if(empty($middlename)){
    	$middlename=NULL;
    }
    
    if(strlen($middlename)>50) {
    // Display an alert message if first name is empty
        echo "<script>alert('Middle Name should be less then 50 characters');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }

    // Validation for last name
    if (empty($lastname)) {
        // Display an alert message if last name is empty
        echo "<script>alert('Last Name is required');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }
    
    if(strlen($lastname)>50) {
    // Display an alert message if first name is empty
        echo "<script>alert('Last Name should be less then 50 characters');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }

    // Validation for username
    if (empty($username)) {
        // Display an alert message if username is empty
        echo "<script>alert('Username is required');</script>";
        header("Refresh:0; url=signup.html");
        die();
    }else if (usernameExists($username)) {
        // Username is already in use
        echo "<script>alert('Username is already in use');</script>";
        header("Refresh:0; url=signup.html");
        die();
    } 
    else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
        // Display an alert message if username contains invalid characters
        echo "<script>alert('Only letters, numbers, and underscores are allowed in the username');</script>";
        header("Refresh:0; url=signup.html");
        die();
    }
    else if (strlen($username) < 3 || strlen($username) > 20) {
        // Display an alert message if username length is not within the specified range
        echo "<script>alert('Username must be between 3 and 20 characters long');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }
    
    // Validation for email
    if (empty($email)) {
        // Display an alert message if email is empty
        echo "<script>alert('Email is required');</script>";
        header ("Refresh:0; url=signup.html");
	    die();
    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Display an alert message if email format is invalid
        echo "<script>alert('Invalid email format');</script>";
        header ("Refresh:0; url=signup.html");
	    die();
    }else if (emailExists($email)) {
        // Email is already in use
        echo "<script>alert('Email is already in use.');</script>";
        header("Refresh:0; url=signup.html");
        die();
    }

    // Validation for password
    if (empty($password)) {
        // Display an alert message if password is empty
        echo "<script>alert('Password is required');</script>";
        header ("Refresh:0; url=signup.html");
	    die();
    } 
    else if (strlen($password) < 8 && strlen($password) > 32) {
        // Display an alert message if password length is less than 8 characters
        echo "<script>alert('Password must be at least 8 characters long and less then 32 characters');</script>";
        header ("Refresh:0; url=signup.html");
	    die();
    } 
    else if (!preg_match("/[a-zA-Z]/", $password) || !preg_match("/\d/", $password)) {
        // Display an alert message if password does not contain at least one letter and one number
        echo "<script>alert('Password must contain at least one letter and one number');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }

    // Validation for confirm password
    if ($password != $cpassword) {
        // Display an alert message if passwords do not match
        echo "<script>alert('Passwords do not match');</script>";
        header("Refresh:0; url=signup.html");
	    die();
    }
    
    if (empty($securityQuestion1) || empty($securityAnswer1) || empty($securityQuestion2) || empty($securityAnswer2)) {
        echo "<script>alert('Security questions and answers cannot be empty');</script>";
        header("Refresh:0; url=signup.html");
        die();
    } elseif ($securityQuestion1 == $securityQuestion2) {
        echo "<script>alert('Security questions cannot be the same');</script>";
        header("Refresh:0; url=signup.html");
        die();
    }

    // If all validations pass, proceed to insert into database
    if(empty($error)){
        // Hash the password before storing it in the database
        $passwordHash = md5($password);
        // Get the current date and time
        $registeredAt = date('Y-m-d H:i:s');
	$restricted=0;

	$result=adduser($firstname,$middlename,$lastname,$username,$email,$passwordHash,$registeredAt,$bio,$restricted,$superuser,$securityQuestion1,strtolower($securityAnswer1),$securityQuestion2,strtolower($securityAnswer2));
	
	if($result){
	    // Display a success message if user is registered successfully
              session_start();
              $_SESSION['username']=$username;
              echo "<script>alert('User registered successfully');</script>";
              header("Refresh:0; url=normaluserpage.php");
              die();
	}
	else{
            // Display an error message if there is an error during database operation
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            header("Refresh:0; url=signup.html");
	        die();
        } 
    }
}

// Close the database connection
$conn->close();

// Function to sanitize input data
function test_input($data){
    // Remove leading and trailing whitespace
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}
?>

