<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Przygotowane zapytanie SQL
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    
    // Sprawdzenie błędu w zapytaniu SQL
    if (!$stmt) {
        die("Błąd przygotowania zapytania: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $password, $email);
    if ($stmt->execute()) {
        echo "Rejestracja zakończona sukcesem!";
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Rejestracja</h1>
        <form method="POST" action="">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>
</body>
</html>
