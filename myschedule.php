<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Schedule | Academic Clan</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="main-content">
        <section class="section">
            <h1>My Schedule</h1>

           <!-- Add Schedule Form -->
<div class="add-schedule-form">
    <h2>Add New Schedule</h2>
    <form action="add-schedule.php" method="post" class="aligned-form">
        <div class="form-group">
            <label for="schedule-title">Title</label>
            <input type="text" id="schedule-title" name="title" placeholder="Meeting, Test, etc." required>
        </div>

        <div class="form-group">
            <label for="schedule-date">Date</label>
            <input type="date" id="schedule-date" name="date" required>
        </div>

        <div class="form-group">
            <label for="schedule-time">Time</label>
            <input type="time" id="schedule-time" name="time" required>
        </div>

        <div class="form-group">
            <label for="schedule-details">Details</label>
            <textarea id="schedule-details" name="details" rows="3" placeholder="Description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Schedule</button>
    </form>
</div>

            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</body>
</html>
