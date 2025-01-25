<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rejestracja - Rover4Me">
    <meta name="author" content="Maciej Pilarski">
    <title>Rejestracja - Rover4Me</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="public/styles/register.css">
    <script>
        document.getElementById('terms').addEventListener('change', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = !this.checked;
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row small">
            <div class="left">
                <a href="dashboard"><img src="public/assets/logo.png" alt="Rover4Me"></a>
            </div>
            <div class="center">
                <p>Rover4Me to aplikacja która pozwoli ci na szybkie wynajęcie roweru, odbiór w najbliższym punkcie, a po skończonej jeździe jego zwrot.</p>
                <p>Nie musisz posiadać by skorzystać</p>
            </div>
            <div class="right">
                <a href="login"><button>Logowanie</button></a>
            </div>
        </div>
        <div class="row large">
            <form class="register-form" action="signup" method="POST">
                <div class="messages">
                        <?php if(isset($messages)){
                            foreach($messages as $message)
                            echo $message;
                        }
                        ?> 
                </div>
                <h2>Rejestracja</h2>

                <label for="first-name">Imię:</label>
                <input type="text" id="first-name" name="first-name" required>

                <label for="last-name">Nazwisko:</label>
                <input type="text" id="last-name" name="last-name" required>

                <label for="age">Wiek:</label>
                <input type="number" id="age" name="age" min="18" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>

                <div class="checkbox-container">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Akceptuję regulamin</label>
                </div>

                <button type="submit">Zarejestruj</button>
            </form>
        </div>
    </div>
</body>
</html>
