<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dodaj rezerwację">
    <meta name="author" content="Maciej Pilarski">
    <title>Dodaj Rezerwację</title>
    <link rel="stylesheet" href="/public/styles/style.css">
    <link rel="stylesheet" href="/public/styles/reservation.css">
</head>
<body>
    <div class="container">
        <div class="row small">
            <div class="left">
                <a href="/userDashboard"><img src="/public/assets/logo.png" alt="Rover4Me"></a>
            </div>
            <div class="center">
                <h1>Dodaj nową rezerwację</h1>
            </div>
            <div class="right">
                <a href="/userDashboard" method="POST"><button>Wróć do panelu</button></a>
            </div>
        </div>
        <div class="row large">
            <form action="/addReservation" method="POST" class="reservation-form">
                <label for="name">Nazwa:</label>
                <input type="text" id="name" name="name" required>

                <label for="location">Lokalizacja:</label>
                <input type="text" id="location" name="location" required>

                <label for="frame_size">Wielkość ramy:</label>
                <input type="text" id="frame_size" name="frame_size" required>

                <label for="theme">Motyw:</label>
                <select id="theme" name="theme" required>
                    <option value="Damski">Damski</option>
                    <option value="Męski">Męski</option>
                </select>

                <label for="date">Data rezerwacji:</label>
                <input type="date" id="date" name="date" required>

                <label for="start_time">Godzina rozpoczęcia:</label>
                <input type="time" id="start_time" name="start_time" required>

                <label for="end_time">Godzina zakończenia:</label>
                <input type="time" id="end_time" name="end_time" required>

                <label for="bike_type">Typ roweru:</label>
                <select id="bike_type" name="bike_type" required>
                    <option value="Górski">Górski</option>
                    <option value="Trekkingowy">Trekkingowy</option>
                    <option value="Miejski">Miejski</option>
                    <option value="Elektryczny">Elektryczny</option>
                </select>

                <button type="submit">Zapisz</button>
            </form>
        </div>
    </div>
</body>
</html>
