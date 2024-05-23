<?php
session_start();

include("connection.php");

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to admin login page if not logged in
    exit;
}

// Function to safely delete a user
function deleteUser($con, $userId) {
    $userId = mysqli_real_escape_string($con, $userId); // Sanitize the input
    $query = "DELETE FROM users WHERE user_id = '$userId'";
    mysqli_query($con, $query);
}

// Check if a user delete request is made
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['user_id'])) {
    deleteUser($con, $_GET['user_id']);
    // Redirect back to the same page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

// Function to modify username and password
function modifyUser($con, $userId, $newUsername, $newPassword, $newEmail) {
    $userId = mysqli_real_escape_string($con, $userId); // Sanitize the input
    $newUsername = mysqli_real_escape_string($con, $newUsername); // Sanitize the input
    $newPassword = mysqli_real_escape_string($con, $newPassword); // Sanitize the input
    $newEmail = mysqli_real_escape_string($con, $newEmail); // Sanitize the input
    $query = "UPDATE users SET user_name = '$newUsername', password = '$newPassword', email = '$newEmail' WHERE user_id = '$userId'";
    mysqli_query($con, $query);
}

// Check if a username/password modification request is made
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifyUser']) && isset($_POST['userId']) && isset($_POST['newUsername']) && isset($_POST['newPassword']) && isset($_POST['newEmail'])) {
    modifyUser($con, $_POST['userId'], $_POST['newUsername'], $_POST['newPassword'], $_POST['newEmail']);
    // Redirect back to the same page after modification
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

// Fetch all user data from the database
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .nav {
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .nav h1 {
            color: #333;
            margin: 0;
        }

        .nav .right-links {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav .right-links li {
            display: inline-block;
            margin-right: 10px;
        }

        .nav .right-links li:last-child {
            margin-right: 0;
        }

        .nav .right-links a {
            text-decoration: none;
            color: #111;
            padding: 8px 15px;
            background-color: rgb(235, 119, 6);
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav .right-links a:hover {
            background-color: #ffd;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .modify-form {
            display: none;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 350px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background: rgb(235, 119, 6);
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background: rgb(235, 119, 6);
        }
    </style>
</head>
<body>

<div class="nav">
    <h1 class="title">Welcome to Admin Panel</h1>
    <!-- Add links to different admin functionalities -->
    <ul class="right-links">
        <li><a href="index.php" class="btn">Logout</a></li>
    </ul>
</div>

<h2>User Information</h2>
<table>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <!-- Add more columns as needed -->
    </tr>
    <?php

    // Display user data in table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        // Start of table row
        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>"; // Displaying User ID in a table cell
        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>"; // Displaying Username in a table cell
        echo "<td>" . htmlspecialchars($row['password']) . "</td>"; // Displaying Password in a table cell
        echo "<td>" . htmlspecialchars($row['email']) . "</td>"; // Displaying Email in a table cell
        // Actions column with icons for delete
        echo "<td>";
        echo "<a href='{$_SERVER['PHP_SELF']}?action=delete&user_id=" . htmlspecialchars($row['user_id']) . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><img src='trash_icon.png' alt='Delete' title='Delete' width='20' height='20'></a> ";
        // Add update button
        echo "<a href='#' onclick='showModifyForm(" . htmlspecialchars($row['user_id']) . ")'><img src='modify_icon.png' alt='Modify' title='Modify' width='20' height='20'></a>";
        echo "</td>";
        echo "</tr>"; // End of table row
    }
    ?>
</table>
<!-- Modify Form -->
<div class="modify-form" id="modifyForm" style="display: none;">
    <h2>Modify User</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" id="userId" name="userId">
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername" required><br>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required><br>
        <label for="newEmail">New Email:</label>
        <input type="email" id="newEmail" name="newEmail" required><br>
        <input type="submit" name="modifyUser" value="Modify">
    </form>
</div>
<script>
    function showModifyForm(userId) {
        var form = document.getElementById('modifyForm');
        var userIdField = document.getElementById('userId');
        userIdField.value = userId;
        form.style.display = 'block';
    }
</script>
</body>
</html>
