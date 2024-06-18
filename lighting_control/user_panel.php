<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['device_name'])) {
    $user_id = $_SESSION['user_id'];
    $device_name = $_POST['device_name'];
    $brightness = 0;
    $status = 0;
    $schedule_days = '';
    $start_time = '00:00:00';
    $end_time = '23:59:59';

    $query = "INSERT INTO lights (room_name, brightness, status, schedule_days, start_time, end_time, user_id) VALUES ('$device_name', $brightness, $status, '$schedule_days', '$start_time', '$end_time', $user_id)";
    if ($conn->query($query) === TRUE) {
        echo "Urządzenie zostało dodane!";
    } else {
        echo "Błąd: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="user_panel.php">Panel użytkownika</a></li>
                <li><a href="logout.php">Wyloguj</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Witaj w panelu użytkownika!</h1>
        <div class="user-panel">
            <div class="user-panel-item">
                <a href="contact.php">
                    <img src="assets/images/contact.png" alt="Kontakt z administratorem">
                    <p>Kontakt z administratorem</p>
                </a>
            </div>
            <div class="user-panel-item">
                <a href="control_panel.php">
                    <img src="assets/images/control.png" alt="Sterowanie oświetleniem">
                    <p>Sterowanie oświetleniem</p>
                </a>
            </div>
            <div class="user-panel-item">
                <a href="profile.php">
                    <img src="assets/images/profile.png" alt="Profil użytkownika">
                    <p>Profil użytkownika</p>
                </a>
            </div>
            <div class="user-panel-item">
                <a href="statistics.php">
                    <img src="assets/images/stats.png" alt="Statystyki">
                    <p>Statystyki</p>
                </a>
            </div>
        </div>
        <div class="add-device">
            <h2>Dodaj nowe urządzenie</h2>
            <form method="POST" action="">
                <input type="text" name="device_name" placeholder="Nazwa urządzenia" required>
                <button type="submit">Dodaj urządzenie</button>
            </form>
        </div>
        <div class="logout-button">
            <a href="logout.php">
                <img src="assets/images/logout.png" alt="Wyloguj">
                <p>Wyloguj</p>
            </a>
        </div>
    </div>
</body>
</html>
