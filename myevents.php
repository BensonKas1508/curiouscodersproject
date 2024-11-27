<?php
// Include necessary files
include 'navbar.php';
include 'sidebar.php';
include 'db_connection.php'; // Database connection

// Start session to access user data (assuming session is used for login)
session_start();

// Get the current user's ID from session (assuming user ID is stored in session)
$userId = $_SESSION['user_id']; 

// Query to get the events created by the logged-in user
$query = "SELECT eventName, duration, purpose, location, dateScheduled, membertype 
          FROM createEvent 
          WHERE hostedBy = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId); // Bind the user ID parameter
$stmt->execute();
$result = $stmt->get_result(); // Get the result of the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events | Academic Clan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="main-content">
        <div class="section">
            <h1>My Events</h1>
            <a href="editevents.php" type="options" class="btn btn-primary">Add</a>
            <a href="editevents.php" type="options" class="btn btn-secondary">Edit</a>
            
            <!-- Event List -->
            <div class="events-container">
                <?php
                // Check if the user has events
                if ($result->num_rows > 0) {
                    // Loop through the events and display them
                    while ($row = $result->fetch_assoc()) {
                        // Format the date to a more readable format
                        $formattedDate = date("F j, Y, g:i a", strtotime($row['dateScheduled']));
                        
                        echo '<div class="events-item">';
                        echo '<h2>' . htmlspecialchars($row['eventName']) . '</h2>';
                        echo '<p><strong>Date & Time:</strong> ' . $formattedDate . '</p>';
                        echo '<p><strong>Duration:</strong> ' . htmlspecialchars($row['duration']) . '</p>';
                        echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</p>';
                        echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['purpose']) . '</p>';
                        echo '<p><strong>Member Type:</strong> ' . htmlspecialchars($row['membertype']) . '</p>';
                        echo '<button class="btn btn-secondary">View Details</button>';
                        echo '</div>';
                    }
                } else {
                    // Message if no events are found
                    echo '<p>No events found. Create a new event!</p>';
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>
