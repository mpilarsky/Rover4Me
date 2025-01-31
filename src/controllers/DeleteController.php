<?php
require_once __DIR__.'/../../DatabaseConnector.php';
$connect = new DatabaseConnector();
$db = $connect->connect();

$data = json_decode(file_get_contents('php://input'), true);
$usersToDelete = $data['users'];

if (empty($usersToDelete)) {
    echo json_encode(['success' => false, 'message' => 'Brak użytkowników do usunięcia.']);
    exit;
}

$stmt = $db->prepare("DELETE FROM users WHERE id IN (" . implode(',', array_map('intval', $usersToDelete)) . ")");
$result = $stmt->execute();

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Użytkownicy zostali usunięci.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Wystąpił błąd podczas usuwania użytkowników.']);
}

$connect = null;
?>
