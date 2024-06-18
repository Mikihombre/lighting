<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM lights WHERE user_id = $user_id";
$result = $conn->query($query);

$daysOfWeek = ['Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Ndz'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sterowanie Oświetleniem - LightUP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>STEROWANIE OŚWIETLENIEM</h1>
        <table class="lighting-table">
            <thead>
                <tr>
                    <th>Urządzenie</th>
                    <th>Poziom jasności</th>
                    <th>Wł/Wył</th>
                    <th>Harmonogram</th>
                    <th>Godziny</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['room_name']; ?></td>
                    <td>
                        <input type="range" min="0" max="100" value="<?php echo $row['brightness']; ?>" onchange="updateBrightness(<?php echo $row['id']; ?>, this.value)">
                        <span><?php echo $row['brightness']; ?>%</span>
                    </td>
                    <td>
                        <button onclick="toggleLight(<?php echo $row['id']; ?>)"><?php echo $row['status'] ? 'Wył' : 'Wł'; ?></button>
                        <!-- Dodane przyciski do sterowania diodą LED -->
                        <button onclick="controlLight(<?php echo $row['id']; ?>, 'on')">Włącz diodę LED</button>
                        <button onclick="controlLight(<?php echo $row['id']; ?>, 'off')">Wyłącz diodę LED</button>
                    </td>
                    <td>
                        <?php foreach ($daysOfWeek as $day): ?>
                        <label>
                            <input type="checkbox" value="<?php echo $day; ?>" <?php echo in_array($day, explode(',', $row['schedule_days'])) ? 'checked' : ''; ?> onchange="updateScheduleDays(<?php echo $row['id']; ?>)">
                            <?php echo $day; ?>
                        </label>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <input type="time" value="<?php echo $row['start_time']; ?>" onchange="updateStartTime(<?php echo $row['id']; ?>, this.value)">
                        -
                        <input type="time" value="<?php echo $row['end_time']; ?>" onchange="updateEndTime(<?php echo $row['id']; ?>, this.value)">
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="user_panel.php" class="back-button">Powrót do panelu użytkownika</a>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script>
        function updateBrightness(id, value) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=brightness&value=" + value);
        }

        function toggleLight(id) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=toggle");
        }

        function controlLight(id, state) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=toggle&value=" + state);
        }

        function updateScheduleDays(id) {
            const checkboxes = document.querySelectorAll(`input[type="checkbox"][onchange="updateScheduleDays(${id})"]`);
            let selectedDays = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedDays.push(checkbox.value);
                }
            });
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=schedule_days&value=" + selectedDays.join(','));
        }

        function updateStartTime(id, value) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=start_time&value=" + value);
        }

        function updateEndTime(id, value) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "control.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id + "&action=end_time&value=" + value);
        }
    </script>
</body>
</html>
