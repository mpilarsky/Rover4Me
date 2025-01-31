<?php
require_once __DIR__.'/../../DatabaseConnector.php';
$connect = new DatabaseConnector();
$db = $connect->connect();

$stmt = $db->prepare("SELECT id, name, surname, email FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel administratora Rover4Me">
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="public/styles/dashboard.css">
    <title>Panel administratora - Rover4Me</title>
</head>
<body>
    <div class="container">
        <div class="row small">
            <div class="left">
                <a href="/adminDashboard"><img src="public/assets/logo.png" alt="Rover4Me"></a>
            </div>
            <div class="center">
                <p>Witaj w panelu administratora. Możesz zarządzać użytkownikami i ich danymi.</p>
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
            <h3>Lista użytkowników</h3>
            <form id="deleteUserForm" method="POST">
                <?php
                foreach ($users as $user) {
                    echo "<div class='user-item'>
                            <input type='checkbox' name='delete_user[]' value='{$user['id']}'> 
                            {$user['name']} {$user['surname']} - {$user['email']}
                          </div>";
                }
                ?>
                <button type="submit" id="deleteButton" class="delete-button">Usuń wybranych użytkowników</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('deleteUserForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const selectedUsers = [];
        document.querySelectorAll('input[name="delete_user[]"]:checked').forEach(function(checkbox) {
            selectedUsers.push(checkbox.value);
        });

        if (selectedUsers.length > 0) {
            fetch('/src/controllers/DeleteController.php', {
                method: 'POST',
                body: JSON.stringify({ users: selectedUsers }),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Użytkownicy zostali usunięci.');
                    location.reload();
                } else {
                    alert('Wystąpił błąd przy usuwaniu użytkowników.');
                }
            })
            .catch(error => {
                console.error('Błąd:', error);
                alert('Wystąpił problem z połączeniem.');
            });
        } else {
            alert('Nie wybrano użytkowników do usunięcia.');
        }
    });
    </script>
</body>
</html>
