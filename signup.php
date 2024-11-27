<?php
session_start();

include 'navbar.php';
include 'db_connection.php'; // Database connection

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs server-side
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@ashesi.edu.gh')) {
        $error_message = 'Please enter a valid Ashesi email address.';
    } else if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d{3,}/', $password) || !preg_match('/[@#$%^&+=!]/', $password)) {
        $error_message = 'Password must be at least 8 characters, contain an uppercase letter, three digits, and a special character.';
    } else {
        // Check if email already exists
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = 'This email is already registered.';
        } else {
            // Insert the new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (userID, first_name, last_name, gender, email, password, role, majorId) VALUES (?, ?, ?, ?, ?, ?, 'Student', null)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isssss", $studentID, $firstName, $lastName, $gender, $email, $hashedPassword);

            if ($stmt->execute()) {
                $success_message = 'Account created successfully! You can now <a href="login.php">login</a>.';
            } else {
                $error_message = 'An error occurred. Please try again.';
            }
        }
    }
}
?>

<script>
        function validateSignUpForm(event){
            event.preventDefault();

            const firstName = document.getElementById('first-name');
            const lastName = document.getElementById('last-name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const namePattern = /^[A-Za-z-]+$/;
            const emailPattern = /^[a-z0-9._]+@ashesi\.edu\.gh$/;
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d{3,})(?=.*[@#$%^&+=!]).{8,}$/;

            let isValid = true;

            if(!namePattern.test(firstName.value)) {
                showError('first-name-error', 'Please enter a valid first name (letters only).');
                isValid = false;
            } else {
                clearError('first-name-error');
            }

            if(!namePattern.test(lastName.value)) {
                showError('last-name-error', 'Please enter a valid last name (letters only).');
                isValid = false;
            } else {
                clearError('last-name-error');
            }

            if (!emailPattern.test(email.value)) {
                showError('email-error', 'Please use your Ashesi email');
                isValid = false;
            } else {
                clearError('email-error');
            }

            if (!passwordPattern.test(password.value)){
                showError('password-error', 'Password must be at least 8 characters, contain an uppercase letter, three digits, and a special character. ');
                isValid = false;
            } else{
                clearError('password-error');
            }

            if (isValid){
                window.location.href = "dashboard.html";
            }
        }

        function showError(elementId, message){
            const errorElement = document.getElementById(elementId);
            errorElement.innerText = message;
            errorElement.style.display = 'block';
        }

        function clearError(elementId){
            const errorElement = document.getElementById(elementId);
            errorElement.innerText = '';
            errorElement.style.display = 'none';
        }
    </script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Academic Clan</title>
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="form-page">
        <div class="form-container">
            <h1>Sign Up</h1>
            <?php if (!empty($error_message)): ?>
                <p class="error-message" style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <p class="success-message" style="color:green;"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form id="signUpForm" action="signup.php" method="post">
                <div class="input-group">
                    <label for="studentID">Student ID</label>
                    <input type="text" id="studentID" name="studentID" placeholder="Enter your student ID" required>
                </div>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Ashesi email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
        </div>
    </main>
</body>
</html>
