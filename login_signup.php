<?php
session_start();

// Check if there is a signup success message
if (isset($_SESSION['signup_success'])) {
    echo "<div style='color: green;'>" . $_SESSION['signup_success'] . "</div>";
    // Unset the message so it doesn't show again on refresh
    unset($_SESSION['signup_success']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My College Space - Login / Signup</title>
<link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="container">
    <div class="form-container login-container">
        <form action="login.php" method="POST">
            <h2>Welcome Back!</h2>
            <div class="input-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    
    <div class="form-container signup-container">
        <form action="signup.php" method="POST">
            <h2>Join Us Today!</h2>
            <div class="input-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

<div class="floating-shapes">
    <div class="shape circle"></div>
    <div class="shape triangle"></div>
    <div class="shape rectangle"></div>
</div>

</body>
</html>
