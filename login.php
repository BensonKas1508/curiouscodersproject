<?php
include 'navbar.php';
include 'db_connection.php'; // Database connection

session_start();

// Handle login submission
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            header("Location: homepage.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Academic Clan</title>
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="form-page">
        <div class="form-container">
            <h1>Login</h1>
            <?php if (!empty($error_message)): ?>
                <p class="error-message" style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form id="loginForm" action="login.php" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Ashesi email" required>
                    <span id="email-error" class="error-message" style="display:none; color:red;"></span>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <span id="password-error" class="error-message" style="display:none; color:red;"></span>
                </div>
                <div class="options">
                    <label><input type="checkbox"> Remember Me</label>
                    <a href="reset-password.php">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <p class="form-footer">Don't have an account? <a href="signup.php">Register here</a></p>
            </form>
        </div>
    </main>
</body>
</html>
