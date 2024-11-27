<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Search | Academic Clan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>
    <main class="main-content">
        <section class="section">
            <h1>Groups Search</h1>
            
            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search courses or groups...">
                <button class="btn btn-primary">Search</button>
            </div>

            <!-- Create New Group Button -->
            <div class="create-group">
                <i class="fas fa-plus"></i> <a href="creategroup.php" class="btn btn-primary" >Create New Group</a>
            </div>

            <!-- Course Sections -->
            <div class="courses-container">
                <!-- Example Course Section -->
                <div class="course-section">
                    <h2>Introduction to Programming (Computer Science)</h2>
                    <div class="groups">
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>Java Enthusiasts</h3>
                            <p>Dive deep into Java programming with peers.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 8 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>CS101 Study Buddies</h3>
                            <p>Collaborate and learn programming concepts together.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 12 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>Java Enthusiasts</h3>
                            <p>Dive deep into Java programming with peers.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 8 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>CS101 Study Buddies</h3>
                            <p>Collaborate and learn programming concepts together.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 12 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        
                        <!-- Add more groups as needed -->
                    </div>
                </div>

                <!-- Another Course Section -->
                <div class="course-section">
                    <h2>Calculus I (Elective)</h2>
                    <div class="groups">
                        <div class="group-item">
                            <h3>Math Geniuses</h3>
                            <p>Focus on solving challenging calculus problems.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 15 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <div class="group-item">
                            <h3>Engineering Math Wizards</h3>
                            <p>Apply calculus in engineering-related problems.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 10 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <div class="group-item">
                            <h3>Math Geniuses</h3>
                            <p>Focus on solving challenging calculus problems.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 15 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <div class="group-item">
                            <h3>Engineering Math Wizards</h3>
                            <p>Apply calculus in engineering-related problems.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 10 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                    </div>
                </div>
                <div class="course-section">
                    <h2>Introduction to Programming (Computer Science)</h2>
                    <div class="groups">
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>Java Enthusiasts</h3>
                            <p>Dive deep into Java programming with peers.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 8 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>CS101 Study Buddies</h3>
                            <p>Collaborate and learn programming concepts together.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 12 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>Java Enthusiasts</h3>
                            <p>Dive deep into Java programming with peers.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 8 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        <!-- Example Group -->
                        <div class="group-item">
                            <h3>CS101 Study Buddies</h3>
                            <p>Collaborate and learn programming concepts together.</p>
                            <div class="group-meta">
                                <i class="fas fa-users"></i> 12 Members
                            </div>
                            <button class="btn btn-secondary">Join Group</button>
                        </div>
                        
                        <!-- Add more groups as needed -->
                    </div>
                </div>
                <!-- Add more course sections dynamically -->
            </div>
        </section>
    </main>
</body>
</html>

