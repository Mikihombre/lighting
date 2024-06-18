<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
