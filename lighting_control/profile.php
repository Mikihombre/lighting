<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id";
    if ($conn->query($query) === TRUE) {
        echo "Profil został zaktualizowany!";
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
    <title>Profil użytkownika - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Profil użytkownika</h1>
        <form method="POST" action="profile.php">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            <button type="submit">Zaktualizuj</button>
        </form>
        <a href="user_panel.php" class="back-button">Powrót do panelu użytkownika</a>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
