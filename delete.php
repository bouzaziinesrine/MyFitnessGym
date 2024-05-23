<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit;
}

// Check if user ID is provided via GET request
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user from the database
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    mysqli_query($con, $query);
}

header("Location: admin.php"); // Redirect back to admin page after deletion
exit;
?>
