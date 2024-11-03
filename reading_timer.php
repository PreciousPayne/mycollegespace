<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Timer</title>
    <link rel="stylesheet" href="css/reading_timer.css">
</head>
<body>
    <div class="timer-container">
        <h2>Reading Timer</h2>
        <form id="readingTimerForm">
            <label for="reading_time">Set Reading Time (minutes):</label>
            <input type="number" id="reading_time" name="reading_time" min="1" required>
            <button type="submit">Start Timer</button>
        </form>
        
        <div id="timerDisplay" class="hidden">
            <h3>Time Remaining: <span id="timeRemaining"></span> seconds</h3>
        </div>

        <div id="quoteDisplay" class="hidden">
            <h3>Your Motivational Quote:</h3>
            <p id="motivationalQuote"></p>
        </div>
    </div>
    <button id="back-home" onclick="location.href='welcome.php'">Back to Home Page</button>
    
    <script src="js/reading_timer.js"></script>
</body>
</html>
