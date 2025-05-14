<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_crud_video";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>