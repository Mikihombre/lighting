<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];
    $user_id = $_SESSION['user_id'];

    if ($action == 'toggle') {
        $state = $_POST['value'];
        $query = "UPDATE lights SET status = !status WHERE id = $id AND user_id = $user_id";
        
        // Aktualizacja statusu w bazie danych
        if ($conn->query($query) === TRUE) {
            // Wysłanie żądania do skryptu Python
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://<adres_ip_raspberry_pi>:5000/light_control');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'state=' . $state);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action == 'brightness') {
        $value = $_POST['value'];
        $query = "UPDATE lights SET brightness = $value WHERE id = $id AND user_id = $user_id";
    } elseif ($action == 'schedule_days') {
        $value = $_POST['value'];
        $query = "UPDATE lights SET schedule_days = '$value' WHERE id = $id AND user_id = $user_id";
    } elseif ($action == 'start_time') {
        $value = $_POST['value'];
        $query = "UPDATE lights SET start_time = '$value' WHERE id = $id AND user_id = $user_id";
    } elseif ($action == 'end_time') {
        $value = $_POST['value'];
        $query = "UPDATE lights SET end_time = '$value' WHERE id = $id AND user_id = $user_id";
    }

    if ($conn->query($query) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
