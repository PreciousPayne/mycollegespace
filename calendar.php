<?php
session_start(); // Start session if using user-specific IDs

// Include database connection
include 'db.php';

// Set current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Function to display calendar days
function buildCalendar($month, $year) {
    $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $dayOfWeek = $dateComponents['wday'];

    // Get today's date for comparison
    $today = date('Y-m-d');

    $calendar = "<table class='calendar'>";
    $calendar .= "<tr class='header'>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th>$day</th>";
    }
    $calendar .= "</tr><tr>";

    // Fill in the blanks for days before the first day of the month
    if ($dayOfWeek > 0) {
        $calendar .= str_repeat('<td></td>', $dayOfWeek);
    }

    $currentDay = 1;
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        // Format date string for the current day
        $dateString = sprintf('%04d-%02d-%02d', $year, $month, $currentDay);
        
        // Check if the current date matches today's date
        $isToday = ($dateString == $today) ? 'today' : '';

        $calendar .= "<td class='$isToday'><span class='date' data-date='$dateString'>$currentDay</span></td>";
        
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= str_repeat('<td></td>', $remainingDays);
    }

    $calendar .= "</tr></table>";
    return $calendar;
}

// Save reminder
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming user ID is in session
    $reminder_date = $_POST['reminder_date'];
    $reminder_text = $_POST['reminder_text'];
    
    $stmt = $conn->prepare("INSERT INTO reminders (user_id, reminder_date, reminder_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $reminder_date, $reminder_text);
    $stmt->execute();
    $stmt->close();
}

// Fetch reminders
function fetchReminders($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT reminder_date, reminder_text FROM reminders WHERE user_id = ? ORDER BY reminder_date ASC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reminders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $reminders;
}

$reminders = fetchReminders($_SESSION['user_id']); // Get reminders for logged-in user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Calendar</title>
    <link rel="stylesheet" href="css/calendar.css">
</head>
<body>
    <div class="calendar-container">
        <h2>Calendar - <?php echo date('F Y', strtotime("$year-$month-01")); ?></h2>
        
        <div class="month-nav">
            <a href="?month=<?php echo $month - 1; ?>&year=<?php echo $year; ?>">Prev</a>
            <a href="?month=<?php echo $month + 1; ?>&year=<?php echo $year; ?>">Next</a>
        </div>
        
        <?php echo buildCalendar($month, $year); ?>
        
        <div class="reminder-form">
            <h3>Set Reminder</h3>
            <form method="POST">
                <label for="reminder_date">Date:</label>
                <input type="date" id="reminder_date" name="reminder_date" required>
                
                <label for="reminder_text">Reminder:</label>
                <input type="text" id="reminder_text" name="reminder_text" required>
                
                <button type="submit">Add Reminder</button>
            </form>
        </div>

        <div class="reminder-list">
            <h3>Your Reminders</h3>
            <ul>
                <?php foreach ($reminders as $reminder): ?>
                    <li><?php echo $reminder['reminder_date']; ?> - <?php echo $reminder['reminder_text']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
    
    <script src="calendar.js"></script>
</body>
</html>
