<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$entryId = $data['entry_id'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT password FROM diary_entries WHERE id = ?");
$stmt->bind_param("i", $entryId);
$stmt->execute();
$result = $stmt->get_result();
$entry = $result->fetch_assoc();

if ($entry && password_verify($password, $entry['password'])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
