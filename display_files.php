<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

// Handle file deletion request
if (isset($_POST['delete_file'])) {
    $file_id = $_POST['file_id'];
    $user_id = $_SESSION['user_id'];

    // Get file path
    $stmt = $conn->prepare("SELECT file_path FROM uploads WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $file_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();
    $stmt->close();

    if ($file) {
        // Delete file from directory
        if (unlink($file['file_path'])) {
            // Delete file record from database
            $stmt = $conn->prepare("DELETE FROM uploads WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $file_id, $user_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Fetch files for the logged-in user
$stmt = $conn->prepare("SELECT id, file_name, file_path, uploaded_at FROM uploads WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$files = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Uploaded Files</title>
    <link rel="stylesheet" href="css/upload.css">
</head>
<body>
    <div class="upload-container">
        <h2>Your Files</h2>
        <div class="file-gallery">
            <?php foreach ($files as $file): ?>
                <div class="file-item">
                    <a href="<?php echo $file['file_path']; ?>" target="_blank"><?php echo $file['file_name']; ?></a>
                    <span class="file-date"><?php echo date('Y-m-d', strtotime($file['uploaded_at'])); ?></span>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="file_id" value="<?php echo $file['id']; ?>">
                        <button type="submit" name="delete_file" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
