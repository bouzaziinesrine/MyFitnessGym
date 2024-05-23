<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Update user information
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    // Update user information in the database
    $query = "UPDATE users SET user_name = '$user_name', password = '$password', age = '$age' WHERE user_id = '$user_id'";
    mysqli_query($con, $query);

    header("Location: admin.php"); // Redirect back to admin page after update
    exit;
}

// Fetch user information to pre-fill the form
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css"> <!-- Assuming you have a CSS file for styling -->
</head>
<body>
    <h1>Edit User</h1>
    <a href="admin.php">Back to Admin Panel</a> <!-- Link back to admin panel -->

    <!-- Form to edit user information -->
    <form method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <label for="user_name">Username:</label>
        <input type="text" name="user_name" id="user_name" value="<?php echo $user['user_name']; ?>" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" required><br>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="<?php echo $user['age']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
