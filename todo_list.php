<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];

// Handle adding a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO user_tasks (user_id, task) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();
    $stmt->close();
}

// Handle deleting a task
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM user_tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch tasks for the logged-in user
$stmt = $conn->prepare("SELECT * FROM user_tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized To-Do List</title>
    <link rel="stylesheet" href="css/todo_list.css">
</head>
<body>
    <div class="todo-container">
        <h2>Your To-Do List</h2>
        
        <form method="POST">
            <input type="text" name="task" placeholder="New task..." required>
            <button type="submit">Add Task</button>
        </form>

        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li class="task-item">
                    <span><?= htmlspecialchars($task['task']); ?></span>
                    <a href="?delete=<?= $task['id']; ?>" class="delete-btn">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
    </div>
</body>
</html>
