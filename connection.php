<?php
$servername = "localhost";
$username = "root";
$password ="";
$database ="projet";

// Attempt to establish a connection
$con = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>