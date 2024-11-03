<?php
// Include database connection
include 'db.php';

// Check if entry_id is set in POST data
if (isset($_POST['entry_id'])) {
    // Sanitize the entry_id to prevent SQL injection
    $entry_id = intval($_POST['entry_id']);

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM diary_entries WHERE id = ?");
    $stmt->bind_param("i", $entry_id);

    if ($stmt->execute()) {
        // Redirect back to the view diary page with a success message
        header("Location: view_entries.php?message=Entry deleted successfully");
    } else {
        // Redirect back with an error message if deletion failed
        header("Location: view_entries.php?message=Error deleting entry");
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back with an error if entry_id was not found
    header("Location: view_diary.php?message=Invalid entry");
}
exit;
?>
