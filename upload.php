<?php
session_start();
include 'db.php'; // Include your database connection

if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $user_id = $_SESSION['user_id']; // Make sure the user is logged in
    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($file['name']);

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Insert file info into database
        $stmt = $conn->prepare("INSERT INTO uploads (user_id, file_name, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $file['name'], $filePath);
        $stmt->execute();
        $stmt->close();

        echo "File uploaded successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Work</title>
    <link rel="stylesheet" href="css/upload.css">
</head>
<body>
    <div class="upload-container">
        <h2>Upload Your Work</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit" name="upload">Upload File</button>
        </form>
        <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
        <h3>Your Uploaded Files</h3>
        <div class="file-gallery">
            <?php include 'display_files.php'; ?>
        </div>
    </div>
</body>
</html>
