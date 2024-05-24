<?php
// Database connection
$dbHost = "localhost";
$dbUser = "shreysai";
$dbPass = "20012002";
$dbName = "bytebuddies";

// connect to the database. Same as before
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
	exit("Connection failed: " . $conn->connect_error);
}

function adduser($firstname, $middlename, $lastname, $username, $email, $passwordHash, $registeredAt, $bio, $restricted, $superuser, $securityQuestion1, $securityAnswer1, $securityQuestion2, $securityAnswer2) {
    global $conn;
    
    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    // Define the SQL query with placeholders
    if (empty($middlename)) {
        $sql = "INSERT INTO user (firstName, lastName, username, email, passwordHash, registeredAt, bio, restricted, superuser, securityQ1, securityA1, securityQ2, securityA2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO user (firstName, middleName, lastName, username, email, passwordHash, registeredAt, bio, restricted, superuser, securityQ1, securityA1, securityQ2, securityA2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    if (empty($middlename)) {
        $stmt->bind_param("sssssssiissss", $firstname, $lastname, $username, $email, $passwordHash, $registeredAt, $bio, $restricted, $superuser, $securityQuestion1, $securityAnswer1, $securityQuestion2,$securityAnswer2);
    } else {
        $stmt->bind_param("ssssssssiissss", $firstname, $middlename, $lastname, $username, $email, $passwordHash, $registeredAt, $bio, $restricted, $superuser, $securityQuestion1, $securityAnswer1, $securityQuestion2, $securityAnswer2);
    }

    // Execute the statement
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    // Close the statement
    $stmt->close();
}


// Function to check if username exists
function usernameExists($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

// Function to check if email exists
function emailExists($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

// Function to set new password
function changepassword($username, $newpassword) {
	global $conn;
	// Using prepared statement to prevent SQL injection
	$stmt = $conn->prepare("UPDATE user SET passwordHash=md5(?) WHERE username=?;");
	$stmt->bind_param("ss", $newpassword, $username);
	$flag = $stmt->execute();
	$conn->close();
	return $flag;
}

function deleteUser($username){
    global $conn;
    $stmt = $conn->prepare("DELETE from user where username = ?");
    $stmt->bind_param("s",$username);
	$flag = $stmt->execute();
	$conn->close();
	return $flag;
}

// Function to check login credentials
function securechecklogin($username, $password) {
    global $conn;
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND passwordHash=md5(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return TRUE;
    }
    return FALSE;
}

function getFirstName($username){
	global $conn;
	$stmt = $conn->prepare("SELECT firstName FROM user WHERE username=?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result=$stmt->get_result();
	if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['firstName'];
    }
    return -1; // If user not found
}


function getUserRole($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT superuser FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['superuser'];
    }
    return -1; // If user not found
}

function getResetPassInfo($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT securityQ1, securityQ2, securityA1, securityA2 FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($question1, $question2, $answer1, $answer2);
    if ($stmt->fetch()) {
        return ['question1' => $question1, 'question2' => $question2, 'answer1' => $answer1, 'answer2' => $answer2];
    }
    return null;
}

?>
