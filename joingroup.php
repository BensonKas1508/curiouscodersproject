<?php
include 'navbar.php';
include 'sidebar.php';
include 'db_connection.php'; // Database connection
session_start();

// Initialize variables
$error_message = '';
$success_message = '';
$user_id = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : null;

// Fetch all available groups
$group_query = "SELECT * FROM groupInfo";
$stmt = $conn->prepare($group_query);
$stmt->execute();
$group_result = $stmt->get_result();

// Handle Join Group functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id) {
    $group_id = $_POST['group_id']; // Get the group ID from the form submission
    
    // Fetch the selected group information
    $group_details_query = "SELECT * FROM groupInfo WHERE groupID = ?";
    $stmt = $conn->prepare($group_details_query);
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $group_result = $stmt->get_result();

    if ($group_result->num_rows > 0) {
        $group = $group_result->fetch_assoc();
        
        // Fetch group member count
        $member_query = "SELECT COUNT(*) as member_count FROM isAmember WHERE groupID = ?";
        $stmt = $conn->prepare($member_query);
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $member_result = $stmt->get_result();
        $members = $member_result->fetch_assoc();

        if ($members['member_count'] < $group['numLimit']) {
            // Check if the user is already a member
            $check_query = "SELECT * FROM isAmember WHERE groupID = ? AND memberId = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("ii", $group_id, $user_id);
            $stmt->execute();
            $check_result = $stmt->get_result();

            if ($check_result->num_rows === 0) {
                // Add user to the group
                $insert_query = "INSERT INTO isAmember (groupID, memberId, groupRole, membertype) VALUES (?, ?, 'Member', 'student')";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("ii", $group_id, $user_id);

                if ($stmt->execute()) {
                    $success_message = "You have successfully joined the group!";
                    header("Location: viewgroup.php?group_id=".$group_id);
                } else {
                    $error_message = "Failed to join the group. Please try again.";
                    header("Location: joingroup.php");
                }
            } else {
                $error_message = "You are already a member of this group.";
                header("Location: joingroup.php");
            }
        } else {
            $error_message = "This group has reached its member limit.";
            header("Location: joingroup.php");
        }
    } else {
        $error_message = "Group not found.";
        header("Location: joingroup.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Group | Academic Clan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="main-content">
        <section class="section">
            <?php if (!empty($error_message)): ?>
                <p class="error-message" style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <p class="success-message" style="color:green;"><?php echo $success_message; ?></p>
            <?php endif; ?>

            <h1>Available Groups</h1>

            <?php if ($group_result->num_rows > 0): ?>
                <form action="joingroup.php" method="post">
                    <div class="group-list">
                        <?php while ($group = $group_result->fetch_assoc()): ?>
                            <div class="group-item">
                                <h2><?php echo htmlspecialchars($group['groupName']); ?></h2>
                                <p><strong>Members:</strong> 
                                    <?php
                                    $group_id = $group['groupID'];
                                    $member_query = "SELECT COUNT(*) as member_count FROM isAmember WHERE groupID = ?";
                                    $stmt = $conn->prepare($member_query);
                                    $stmt->bind_param("i", $group_id);
                                    $stmt->execute();
                                    $member_result = $stmt->get_result();
                                    $members = $member_result->fetch_assoc();
                                    echo $members['member_count'] . ' / ' . $group['numLimit'];
                                    ?>
                                </p>
                                <p><strong>Description:</strong> <?php echo htmlspecialchars($group['groupDescription']); ?></p>
                                <p><strong>Schedule:</strong> <?php echo htmlspecialchars($group['meetingTimes']); ?></p>
                                <input type="radio" id="group_<?php echo $group['groupID']; ?>" name="group_id" value="<?php echo $group['groupID']; ?>" required>
                                <label for="group_<?php echo $group['groupID']; ?>">Join this group</label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Join Group</button>
                </form>
            <?php else: ?>
                <p>No groups available.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

