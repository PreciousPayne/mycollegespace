<?php
session_start();
include 'db.php'; // Include your database connection file

$userId = $_SESSION['user_id']; // Assuming the user is logged in and their ID is stored in session
$flashcards = [];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Adding a new flashcard
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $stmt = $conn->prepare("INSERT INTO flashcards (user_id, question, answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $question, $answer);
        if ($stmt->execute()) {
            $success = "Flashcard added successfully.";
        } else {
            $error = "Error adding flashcard.";
        }
    } elseif (isset($_POST['delete'])) {
        // Deleting a flashcard
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM flashcards WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $userId);
        $stmt->execute();
    }
}

// Fetch all flashcards for the user
$stmt = $conn->prepare("SELECT * FROM flashcards WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $flashcards[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Flashcards</title>
    <link rel="stylesheet" href="css/flashcards.css">
</head>
<body>
    <div class="flashcard-container">
        <h2>Your Flashcards</h2>
        
        <form method="POST" class="add-card-form">
            <input type="text" name="question" placeholder="Enter your question" required>
            <input type="text" name="answer" placeholder="Enter the answer" required>
            <button type="submit" name="add">Add Flashcard</button>
            <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
        </form>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <div class="flashcard-list">
            <?php foreach ($flashcards as $flashcard): ?>
                <div class="flashcard">
                    <p><strong>Q:</strong> <?= htmlspecialchars($flashcard['question']); ?></p>
                    <p><strong>A:</strong> <?= htmlspecialchars($flashcard['answer']); ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $flashcard['id']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <a href="study_flashcards.php" class="study-link">Study with Flashcards</a>
        </div>
    </div>
</body>
</html>
