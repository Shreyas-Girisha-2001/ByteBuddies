<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Log In - ByteBuddies</title>
  <script>
    function togglePasswordVisibility() {
            var passwordField1 = document.getElementById("password"); 
            if (passwordField1.type === "password") {
                passwordField1.type = "text"; 
            } 
            else {
                passwordField1.type = "password"; 
            }
        } 
  </script>
  </head>
  <body>
    <div class="container">
        <div class="content">
            <form method="post" action="login.php">
                <h1>Sign In</h1>
                <input class="textform" type="text" id="username" name="username" placeholder="Username" required><br><br>
                <input class="textform" type="password" id="password" name="password" placeholder="Password" required><br><br>
                <div class="checkbox-container">
                    <input type="checkbox" onclick="togglePasswordVisibility()"><label class="showpassword">Show Password</label><br><br>
                </div>
                <button type="submit"><span>Sign In</span></button>
            </form>
        </div>
    </div>
  </body>
  </html>
