<!DOCTYPE html>
<html>
<head>
    <title>Delete User Confirmation</title>
    <script type="text/javascript">
        function confirmDelete(userId) {
            var userAction = confirm("Are you sure you want to delete this user?");
            if (userAction) {
                // User clicked OK
                document.getElementById('deleteUserForm').action = "dltusrprocess.php?action=delete&userId=" + userId;
                document.getElementById('deleteUserForm').submit();
            }
        }
    </script>
</head>
<body>

<?php
// Display message based on previous action
if (isset($_GET['message'])) {
    echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
}
?>

<!-- HTML form -->
<form id="deleteUserForm" method="post">
    <input type="button" value="Delete User" onclick="confirmDelete(1)">
</form>

</body>
</html>
