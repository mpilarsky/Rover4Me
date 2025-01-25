<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Logowanie - Rover4Me">
    <meta name="author" content="Maciej Pilarski">
    <title>Logowanie - Rover4Me</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="public/styles/login.css">
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
                <a href="signup"><button>Rejestracja</button></a>
            </div>
        </div>
        <div class="row large">
            <form class="login-form" action="login" method="POST">
                <div class="messages">
                    <?php if(isset($messages)){
                        foreach($messages as $message)
                        echo $message;
                    }
                    ?>                  
                </div>
                <h2>Logowanie</h2>
                <label for="username">Login:</label>
                <input type="text" id="username" name="email" required>
                
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Zaloguj</button>
            </form>
        </div>
    </div>
</body>
</html>
