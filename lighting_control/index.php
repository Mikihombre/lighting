<?php
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LightUP - Zarządzanie Oświetleniem</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function controlLight(state) {
            $.ajax({
                url: 'http://<adres_ip_raspberry_pi>:5000/light_control',
                type: 'POST',
                data: { state: state },
                success: function(response) {
                    console.log("Dioda LED: " + state);
                },
                error: function(error) {
                    console.log("Błąd: " + error);
                }
            });
        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Witaj na naszej platformie do zarządzania oświetleniem zewnętrznym!</h1>
        <p>Nasz system oferuje wygodne i intuicyjne narzędzia do kontroli oświetlenia z dowolnego miejsca, dzięki czemu możesz łatwo dostosować atmosferę i bezpieczeństwo swojego otoczenia. Bez względu na to, czy chcesz zaplanować harmonogramy oświetlenia, monitorować zużycie energii czy po prostu szybko włączyć światła, nasza aplikacja zapewnia prosty sposób na pełną kontrolę.</p>
        <div class="image-container">
            <img src="assets/images/lightbulb.jpg" alt="Lightbulb Image">
        </div>
        <p>Dołącz do naszej społeczności i ciesz się inteligentnym zarządzaniem oświetleniem zewnętrznym, które dostosowuje się do Twoich potrzeb i stylu życia!</p>
        <p> Kliknij w przycisk <a href="register.php" class="register-link">ZAREJESTRUJ SIĘ!</a></p>
        <a href="register.php" class="register-button">ZAREJESTRUJ SIĘ!</a>

        <!-- Dodane przyciski do sterowania diodą LED -->
        <button onclick="controlLight('on')">Włącz diodę LED</button>
        <button onclick="controlLight('off')">Wyłącz diodę LED</button>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
