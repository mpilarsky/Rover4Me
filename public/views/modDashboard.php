<?php
require_once __DIR__.'/../../DatabaseConnector.php';
$connect = new DatabaseConnector();
$db = $connect->connect();

$stmt = $db->prepare("SELECT id, name, surname FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel moderatora Rover4Me">
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="public/styles/dashboard.css">
    <link rel="stylesheet" href="public/styles/mod.css">
    <script type="text/javascript" src="./public/scripts/mods.js" defer></script>
    <title>Panel moderatora - Rover4Me</title>
</head>
<body>
    <div class="container">
        <div class="row small">
            <div class="left">
                <a href="/modDashboard"><img src="public/assets/logo.png" alt="Rover4Me"></a>
            </div>
            <div class="center">
                <p>Witaj w panelu moderatora, tu możesz przeglądać użytkowników i ich rezerwacje.</p>
            </div>
            <div class="right">
                <div class="add-reservation-container">
                    <form action="/logout" method="POST" style="display: inline;">
                        <button type="submit">Wyloguj się</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row large">
            <div class="arrow left">&#9664;</div>
            <div class="reservation-container">

            <?php
            foreach ($users as $index => $user) {
                $userId = $user['id'];
                echo "<div class='user-container' id='user-{$userId}' data-user-index='{$index}'>";
                echo "<h3>{$user['name']} {$user['surname']}</h3>";

                $stmt = $db->prepare("SELECT * FROM reservations WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
                $stmt->execute();
                $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($reservations)) {
                    echo "<p>Brak rezerwacji.</p>";
                } else {
                    foreach ($reservations as $reservation) {
                        $bikeTypeValue = 0;
                        switch ($reservation['bike_type']) {
                            case 'Trekkingowy':
                                $bikeTypeValue = 1;
                                break;
                            case 'Elektryczny':
                                $bikeTypeValue = 2;
                                break;
                            case 'Górski':
                                $bikeTypeValue = 3;
                                break;
                            case 'Miejski':
                                $bikeTypeValue = 4;
                                break;
                        }

                        echo "
                        <div class='reservation-card'>
                            <p>Nazwa: {$reservation['name']}</p>
                            <p>Lokalizacja: {$reservation['location']}</p>
                            <p>Wielkość ramy: {$reservation['frame_size']}</p>
                            <p>Motyw: " . ucfirst($reservation['theme']) . "</p>
                            <p>Typ roweru: {$reservation['bike_type']}</p>
                            <img src='public/assets/bike{$bikeTypeValue}.png' alt='Rower typu {$reservation['bike_type']}'>
                            <p>Start: {$reservation['reservation_date']} o godzinie {$reservation['start_time']}</p>
                            <p>Koniec: {$reservation['end_time']}</p>
                        </div>";
                    }
                }
                echo "</div>";
            }
            $connect=null;
            ?>
            </div>
            <div class="arrow right">&#9654;</div>
        </div>
    </div>
</body>
</html>