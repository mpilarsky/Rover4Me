<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel użytkownika Rover4Me">
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="public/styles/dashboard.css">
    <script type="text/javascript" src="./public/scripts/script.js" defer></script>
    <title>Panel użytkownika - Rover4Me</title>
</head>
<body>
    <div class="container">
        <div class="row small">
            <div class="left">
                <a href="/userDashboard"><img src="public/assets/logo.png" alt="Rover4Me"></a>
            </div>
            <div class="center">
                <p>Witaj w swoim panelu użytkownika, tu znajdziesz szczegóły swoich rezerwacji rowerów.</p>
            </div>
            <div class="right">
                <div class="add-reservation-container">
                    <a href="/reservation" class="btn-add-reservation">
                        <button>Dodaj nową rezerwację</button>
                    </a>
                </div>
                <div class="add-reservation-container">
                    <form action="/logout" method="POST" style="display: inline;">
                        <button type="submit">Wyloguj się</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="row large">
            <div class="arrow left" onclick="prevSlide()">&#9664;</div>
            <div class="reservation-container">

            <?php

                require_once __DIR__.'/../../DatabaseConnector.php';
                $connect = new DatabaseConnector();
                $db = $connect->connect();
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $userId = $_SESSION['user_id'];

                $query = $db->prepare("SELECT name, location, frame_size, theme, reservation_date, start_time, end_time, bike_type FROM reservations WHERE user_id = :userId");
                $query->bindParam(':userId', $userId, PDO::PARAM_INT);
                $query->execute();
                $reservations = $query->fetchAll(PDO::FETCH_ASSOC);

                if (empty($reservations)) {
                    echo "<p>Brak rezerwacji do wyświetlenia.</p>";
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
                        <h3>Nazwa: {$reservation['name']}</h3>
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
                $connect=null;
            ?>
            </div>
            <div class="arrow right" onclick="nextSlide()">&#9654;</div>
        </div>
    </div>

</body>
</html>
