<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM statistics WHERE user_id = $user_id";
$result = $conn->query($query);

if (!$result) {
    die("Błąd zapytania SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statystyki - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>STATYSTYKI</h1>
        <table class="statistics-table">
            <thead>
                <tr>
                    <th>Urządzenie</th>
                    <th>Łączny czas działania</th>
                    <th>Łączny pobór mocy</th>
                    <th>Miesięczny pobór mocy</th>
                    <th>Miesięczny koszt</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['device']; ?></td>
                    <td><?php echo $row['total_hours']; ?> godzin</td>
                    <td><?php echo $row['total_power']; ?> kWh</td>
                    <td><?php echo $row['monthly_power']; ?> kWh</td>
                    <td><?php echo $row['monthly_cost']; ?> zł</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="user_panel.php" class="back-button">Powrót do panelu użytkownika</a>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
