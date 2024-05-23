<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change password</title>
<link rel="stylesheet" href="style.css"> 
<script>
function togglePasswordVisibility() {
            var passwordField1 = document.getElementById("password"); 
            var passwordField2 = document.getElementById("rpassword");
            if (passwordField1.type === "password") {
                passwordField1.type = "text"; 
                passwordField2.type = "text"; 
            } 
            else {
                passwordField1.type = "password"; 
                passwordField2.type = "password";
            }
        } 
        document.addEventListener("DOMContentLoaded", function() {
            var textFields = document.querySelectorAll('.textfield.small');

            textFields.forEach(function(textField) {
                textField.addEventListener('focus', function() {
                    this.classList.remove('small');
                    this.classList.add('large');
                });

                textField.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.classList.remove('large');
                        this.classList.add('small');
                    }
                });
            });
        });
</script> 
</head> 
	<body>
	<div class="container">
	<div class="content">
		<form action="changepassword.php" method="post">
		<center>
		<?php 
		require "database.php";
		session_start(); 
		echo "<h1>Change your password " . htmlspecialchars(getFirstName($_SESSION['username'])) .".</h1>"; ?>
		 <div class="nameflex">
		    <div class="dropdown">
		    	<p class="lbl">Make sure that you remember your security questions, If not contact superuser to update password</p><br><br>
			<p class="lbl">Security Question 1:</p>
			<select class="item5 textform" name="securityquestion1" id="securityquestion1" required>
			    <option value="" selected disabled hidden>Choose here</option>
			    <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
			    <option value="What is the name of your first pet?">What is the name of your first pet?</option>
			    <option value="What city were you born in?">What city were you born in?</option>
			    <option value="What is your favorite movie?">What is your favorite movie?</option>
			    <option value="What is the name of your favorite teacher?">What is the name of your favorite teacher?</option>
			</select><br>
			<input class="textform" type="text" id="securityanswer1" name="securityanswer1" placeholder="Enter Answer for Security Question 1" required><br>
		    </div>
		    <div class="dropdown">
			<p class="lbl">Security Question 2:</p>
			<select class="item5 textform" name="securityquestion2" id="securityquestion2" required>
			    <option value="" selected disabled hidden>Choose here</option>
			    <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
			    <option value="What is the name of your first pet?">What is the name of your first pet?</option>
			    <option value="What city were you born in?">What city were you born in?</option>
			    <option value="What is your favorite movie?">What is your favorite movie?</option>
			    <option value="What is the name of your favorite teacher?">What is the name of your favorite teacher?</option>
			</select><br>
			<input class="textform" type="text" id="securityanswer2" name="securityanswer2" placeholder="Enter Answer for Security Question 2" required><br>
		    </div>
		</div>
		<input class="textform" type="password" id="password" name="password" placeholder="Enter password" required 
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"
                title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase, and 1
UPPERCASE"
                onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: ''); form.repassword.pattern = this.value;"><br>
                <input class="textform" type="password" id="rpassword" name="rpassword" placeholder="Re-enter Password" required 
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"
                title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase, and 1
UPPERCASE"
                onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: ''); form.repassword.pattern = this.value;"><br>
		<input type="checkbox" onclick="togglePasswordVisibility()"> <label class="showpassword">Show Password</label><br>
		<button type="submit"><span>Change Password</span></button>
		</form>
		</center>
	</div>
	</div> 
	</body>
</html>


