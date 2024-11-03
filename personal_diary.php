<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Diary</title>
    <link rel="stylesheet" href="css/diary.css">
</head>
<body>
    <div class="diary-container">
        <h2>MY SPACE</h2>

        <!-- Display success message if redirected from add_entry.php -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p style="color: green;">New entry added successfully.</p>
        <?php endif; ?>

        <form action="add_entry.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Write your thoughts here..." required></textarea>
            <input type="password" name="password" placeholder="Set Password (optional)">
            <input type="text" name="mood" placeholder="Mood (optional)">
            <input type="file" name="image" accept="image/*">
            <button type="submit">Save Entry</button>
        </form>

        <button onclick="location.href='view_entries.php'">View Data Entries</button> <br>
        <button onclick="location.href='welcome.php'">Back to Home Page</button>
    </div>
</body>
</html>
