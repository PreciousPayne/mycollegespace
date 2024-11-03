<?php
session_start();
include 'db.php'; // Include your database connection file

$userId = $_SESSION['user_id']; // Assuming the user is logged in

// Fetch all flashcards for the user
$stmt = $conn->prepare("SELECT * FROM flashcards WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$flashcards = [];
while ($row = $result->fetch_assoc()) {
    $flashcards[] = $row;
}

if (count($flashcards) === 0) {
    $message = "You have no flashcards available for study.";
} else {
    // Select a random flashcard
    $randomFlashcard = $flashcards[array_rand($flashcards)];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = $_POST['answer'];
    $correctAnswer = $randomFlashcard['answer'];

    if (trim(strtolower($userAnswer)) === trim(strtolower($correctAnswer))) {
        $message = "Correct! Well done.";
    } else {
        $message = "Incorrect! The correct answer was: " . htmlspecialchars($correctAnswer);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study with Flashcards</title>
    <link rel="stylesheet" href="css/study_flashcards.css">
</head>
<body>
    <div class="study-container">
        <h2>Study with Flashcards</h2>

        <?php if (isset($message)): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <?php if (count($flashcards) > 0): ?>
            <div class="flashcard">
                <p><strong>Q:</strong> <?= htmlspecialchars($randomFlashcard['question']); ?></p>
                <form method="POST">
                    <input type="text" name="answer" placeholder="Your answer" required>
                    <button type="submit">Submit Answer</button>
                    <button><a href="flashcards.php">Back to Flashcards</a></button>
                </form>
            </div>
        <?php endif; ?>
        
        
    </div>
</body>
</html>
