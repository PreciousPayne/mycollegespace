<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $password = $_POST['password'];
    $mood = $_POST['mood'];

    // Handle image upload (optional)
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/"; // Ensure this directory exists
        $imagePath = $targetDir . basename($_FILES['image']['name']);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "Error uploading file.";
            exit;
        }
    }

    // Prepare SQL based on whether an image was uploaded
    if ($imagePath === null) {
        $stmt = $conn->prepare("INSERT INTO diary_entries (title, content, password, mood) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("MySQL prepare error: " . $conn->error);
        }
        $stmt->bind_param("ssss", $title, $content, $password, $mood);
    } else {
        $stmt = $conn->prepare("INSERT INTO diary_entries (title, content, password, mood, image) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("MySQL prepare error: " . $conn->error);
        }
        $stmt->bind_param("sssss", $title, $content, $password, $mood, $imagePath);
    }

    // Execute the statement and redirect with success message
    if ($stmt->execute()) {
        header("Location: personal_diary.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
