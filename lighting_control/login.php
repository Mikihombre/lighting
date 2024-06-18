<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging: Wyświetl zapytanie SQL
    $query = "SELECT * FROM users WHERE username = '$username'";
    echo "<pre>$query</pre>";

    $result = $conn->query($query);

    // Debugging: Wyświetl błąd MySQL, jeśli zapytanie nie powiodło się
    if (!$result) {
        echo "Błąd zapytania SQL: " . $conn->error;
        exit();
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: user_panel.php");
            exit();
        } else {
            echo "Nieprawidłowe hasło.";
        }
    } else {
        echo "Nie znaleziono użytkownika.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Logowanie</h1>
        <form method="POST" action="">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>
