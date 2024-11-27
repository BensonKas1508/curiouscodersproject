<?php
include 'navbar.php';
include 'sidebar.php';
include 'db_connection.php'; // Database connection
session_start();

// Fetch current user's data
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_data = null;
if ($user_id) {
    $user_query = "SELECT first_name, last_name, email, userID, role FROM users WHERE userID = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user_data = $user_result->fetch_assoc();
    }
}

// Default queries for groups and events
$groups_query = "SELECT groupName, groupID FROM groupInfo";
$groups_result = $conn->query($groups_query);

$events_query = "SELECT eventName, dateScheduled, location FROM createEvent";
$events_result = $conn->query($events_query);

// Handle search for Groups
if (isset($_POST['search_groups'])) {
    $searchTerm = $_POST['group_search'];
    if (!empty($searchTerm)) {
        // Search both groupName and groupDescription in the groupInfo table
        $searchTerm = "%" . $searchTerm . "%";
        $groups_query = "SELECT groupName, groupID FROM groupInfo WHERE groupName LIKE ? OR groupDescription LIKE ?";
        $stmt = $conn->prepare($groups_query);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $groups_result = $stmt->get_result();
    }
}

// Handle search for Events
if (isset($_POST['search_events'])) {
    $searchTerm = $_POST['event_search'];
    if (!empty($searchTerm)) {
        // Search both eventName and purpose in the createEvent table
        $searchTerm = "%" . $searchTerm . "%";
        $events_query = "SELECT eventName, dateScheduled, location FROM createEvent WHERE eventName LIKE ? OR purpose LIKE ?";
        $stmt = $conn->prepare($events_query);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $events_result = $stmt->get_result();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Academic Clan</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- User Profile Section -->
            <section id="profile-section" class="section">
                <h1>User Profile</h1>
                <div class="profile-details">
                    <img src="OIP.jpeg" alt="User Image" class="profile-img">
                    <div class="profile-info">
                        <?php if ($user_data): ?>
                            <h2><?php echo htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name']); ?></h2>
                            <p>Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
                            <p>Student ID: <?php echo htmlspecialchars($user_data['userID']); ?></p>
                            <p>Role: <?php echo htmlspecialchars($user_data['role']); ?></p>
                        <?php else: ?>
                            <p>User data not available.</p>
                        <?php endif; ?>
                        <div class="profile-actions">
                            <a href="profilepage.php" class="btn btn-primary">Edit</a>
                            <a href="login.php" class="btn btn-signout">Sign Out</a>
                            <a href="deleteaccount.php" class="btn btn-danger">Delete Account</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Groups Section -->
            <section id="groups-section" class="section">
                <h1>Groups</h1>
                <div class="group-actions">
                    <a href="creategroup.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create Group</a>
                    <a href="joingroup.php" class="btn btn-secondary"><i class="fas fa-sign-in-alt"></i> Join Group</a>
                    <form method="post" class="search-form">
                        <input type="text" name="group_search" placeholder="Search groups..." class="search-input">
                        <button type="submit" name="search_groups" class="btn btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="group-list">
                    <?php if ($groups_result->num_rows > 0): ?>
                        <?php while ($group = $groups_result->fetch_assoc()): ?>
                            <div class="group-item">
                                <h2><?php echo htmlspecialchars($group['groupName']); ?></h2>
                                <a href="viewgroup.php?groupID=<?php echo htmlspecialchars($group['groupID']); ?>" class="btn btn-secondary">View Group</a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No groups found.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Events Section -->
            <section id="events-section" class="section">
                <h1>Events</h1>
                <div class="event-actions">
                    <a href="editevents.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create Event</a>
                    <form method="post" class="search-form">
                        <input type="text" name="event_search" placeholder="Search events..." class="search-input">
                        <button type="submit" name="search_events" class="btn btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <ul class="event-list">
                    <?php if ($events_result->num_rows > 0): ?>
                        <?php while ($event = $events_result->fetch_assoc()): ?>
                            <li><i class="fas fa-calendar-alt"></i> 
                                <?php echo htmlspecialchars($event['eventName']); ?> 
                                at <?php echo htmlspecialchars($event['location']); ?> 
                                on <?php echo date("F j, Y", strtotime($event['dateScheduled'])); ?>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li>No events found.</li>
                    <?php endif; ?>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>
