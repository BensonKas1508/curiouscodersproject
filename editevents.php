<?php
// Include necessary files and establish database connection
include 'navbar.php';
include 'sidebar.php';
include 'db_connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $hostedBy = isset($_POST['hostedBy']) ? trim($_POST['hostedBy']) : null;
    $eventName = isset($_POST['eventName']) ? trim($_POST['eventName']) : null;
    $duration = isset($_POST['duration']) ? trim($_POST['duration']) : null;
    $purpose = isset($_POST['purpose']) ? trim($_POST['purpose']) : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;
    $dateScheduled = isset($_POST['dateScheduled']) ? trim($_POST['dateScheduled']) : null;
    $membertype = isset($_POST['membertype']) ? trim($_POST['membertype']) : null;

    // Validate inputs
    $responseMessage = "";
    if (!$hostedBy || !$eventName || !$duration || !$purpose || !$location || !$dateScheduled || !$membertype) {
        $responseMessage = "<p class='error-message'>Error: All fields are required.</p>";
    } else {
        // Prepare the SQL query to insert a new event
        $query = "
            INSERT INTO createEvent (
                hostedBy, eventName, duration, purpose, location, dateScheduled, membertype
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $responseMessage = "<p class='error-message'>Error: Failed to prepare statement: " . $conn->error . "</p>";
        } else {
            // Bind parameters
            $stmt->bind_param("issssss", $hostedBy, $eventName, $duration, $purpose, $location, $dateScheduled, $membertype);

            // Execute the query
            if ($stmt->execute()) {
                $responseMessage = "<p class='success-message'>Event created successfully.</p>";
            } else {
                $responseMessage = "<p class='error-message'>Error creating event: " . $stmt->error . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Event | Academic Clan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homepagestyle.css">
    <style>
        /* Align form elements and give them a uniform look */
        .event-form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .event-form input, .event-form select, .event-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .event-form textarea {
            resize: vertical;
        }

        .event-form button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .event-form button:hover {
            background-color: #0056b3;
        }

        .response {
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <section class="section">
            <h1>Add/Edit Event</h1>
            <?php if (isset($responseMessage)) echo $responseMessage; ?>
            <form action="" method="post" class="event-form">
                <label for="hostedBy">Hosted By</label>
                <input type="text" id="hostedBy" name="hostedBy" placeholder="Enter your User ID" required>

                <label for="eventName">Event Name</label>
                <input type="text" id="eventName" name="eventName" placeholder="Enter event name" required>

                <label for="duration">Duration</label>
                <input type="text" id="duration" name="duration" placeholder="E.g., 2 hours" required>

                <label for="purpose">Purpose</label>
                <textarea id="purpose" name="purpose" rows="4" placeholder="Describe the event's purpose" required></textarea>

                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter event location" required>

                <label for="dateScheduled">Date and Time</label>
                <input type="datetime-local" id="dateScheduled" name="dateScheduled" required>

                <label for="membertype">Member Type</label>
                <select id="membertype" name="membertype" required>
                    <option value="" disabled selected>Select member type</option>
                    <option value="student">Student</option>
                    <option value="tutor">Tutor</option>
                </select>

                <button type="submit" class="btn btn-primary">Save Event</button>
            </form>
        </section>
    </main>
</body>
</html>
