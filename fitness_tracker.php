<?php
session_start();
include 'db.php';

// Save new entry to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $activity = $_POST['activity'];
    $duration = $_POST['duration'];
    $calories_burned = $_POST['calories_burned'];
    $comments = $_POST['comments'];

    $stmt = $conn->prepare("INSERT INTO fitness_entries (user_id, date, activity, duration, calories_burned, comments) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssis", $user_id, $date, $activity, $duration, $calories_burned, $comments);
    $stmt->execute();
    $stmt->close();
}

// Fetch user entries for display
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM fitness_entries WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$entries = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker</title>
    <link rel="stylesheet" href="css/fitness.css">
</head>
<body>
<div class="fitness-container">
    <h2>Fitness Tracker</h2>
    
    <form method="POST" class="fitness-form">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="activity">Activity:</label>
        <input type="text" id="activity" name="activity" placeholder="e.g., Running, Yoga" required>
        
        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>
        
        <label for="calories_burned">Calories Burned:</label>
        <input type="number" id="calories_burned" name="calories_burned">
        
        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" placeholder="Add any notes about your workout..."></textarea>
        
        <button type="submit">Add Entry</button>
    </form>

    <div class="tips-section">
        <h3>Fitness & Wellness Tips</h3>
        <ul>
            <li>Take short breaks while studying to stretch and refocus.</li>
            <li>Drink water before, during, and after exercise.</li>
            <li>Set small fitness goals to stay motivated and consistent.</li>
            <li>Try meditation or breathing exercises for mental clarity.</li>
        </ul>
    </div>

    <div class="entries-section">
        <h3>Your Workout History</h3>
        <?php while ($row = $entries->fetch_assoc()): ?>
            <div class="entry">
                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                <p><strong>Activity:</strong> <?php echo $row['activity']; ?></p>
                <p><strong>Duration:</strong> <?php echo $row['duration']; ?> mins</p>
                <p><strong>Calories Burned:</strong> <?php echo $row['calories_burned']; ?></p>
                <p><strong>Comments:</strong> <?php echo $row['comments']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
</div>
</body>
</html>
