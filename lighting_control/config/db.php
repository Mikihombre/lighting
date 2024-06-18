<?php
$servername = "localhost";
$username = "admin";
$password = "";
$dbname = "lighting";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
