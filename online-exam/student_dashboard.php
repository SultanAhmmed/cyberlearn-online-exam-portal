<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header('Location: login.php');
    exit;
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <span class="navbar-text text-white me-3">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="profile.php" class="btn btn-outline-light me-2"><i class="bi bi-person-circle"></i> Profile</a>
                <a href="logout.php" class="btn btn-outline-light"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="dashboard-header text-center">
        <div class="container">
            <span class="hero-kicker"><i class="bi bi-speedometer2"></i> Student workspace</span>
            <h1 class="hero-title mb-3">Student Dashboard</h1>
            <p class="lead mb-0">Manage your exams, grades, and discussions from one polished control center.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-journal-bookmark-fill"></i></div>
                    <div class="metric-label">Available exams</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM exams");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Open assessments ready for review</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-chat-dots-fill"></i></div>
                    <div class="metric-label">Your comments</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM comments WHERE user_id = {$_SESSION['user_id']}");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Activity you've posted in the forum</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-award-fill"></i></div>
                    <div class="metric-label">Grades recorded</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM grades WHERE student_id = {$_SESSION['user_id']}");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Subjects currently in the gradebook</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-card h-100">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-list-check"></i> Exam queue</span>
                            <h4 class="section-heading mt-2 mb-0">Your exams</h4>
                        </div>
                        <span class="pill"><i class="bi bi-journal-text"></i> Updated list</span>
                    </div>
                    <div class="exam-list">
                        <?php
                        $query = "SELECT * FROM exams ORDER BY created_at DESC";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="list-card d-flex justify-content-between align-items-center gap-3 mb-3">';
                                echo '<div><strong>' . htmlspecialchars($row['title']) . '</strong><br><small class="text-muted">' . htmlspecialchars($row['description']) . '</small></div>';
                                echo '<a href="exam.php?exam_id=' . $row['id'] . '" class="btn btn-sm btn-primary"><i class="bi bi-play-circle"></i> Take Exam</a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p class="text-muted">No exams available.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-panel mb-4">
                    <span class="badge-soft"><i class="bi bi-link-45deg"></i> Quick actions</span>
                    <h5 class="section-heading mt-2">Jump to a task</h5>
                    <div class="timeline-list mt-3">
                        <li><i class="bi bi-chat-dots"></i><span><a href="discussion.php">Open the discussion forum</a></span></li>
                        <li><i class="bi bi-search"></i><span><a href="index.php">Search student profiles</a></span></li>
                        <li><i class="bi bi-person"></i><span><a href="student.php?id=<?php echo $_SESSION['user_id']; ?>">View my profile page</a></span></li>
                    </div>
                </div>
                <div class="dashboard-panel">
                    <span class="badge-soft"><i class="bi bi-lightning"></i> Study focus</span>
                    <h5 class="section-heading mt-2">What to do next</h5>
                    <p class="text-muted">Open an exam, then use the forum to track announcements and the profile page to check your record.</p>
                    <div class="pill-group">
                        <span class="pill"><i class="bi bi-speedometer2"></i> Dashboard</span>
                        <span class="pill"><i class="bi bi-people"></i> Forum</span>
                        <span class="pill"><i class="bi bi-award"></i> Grades</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer mt-5" style="background: #2d3748; color: #cbd5e0; padding: 20px 0; text-align: center;">
        <div class="container">
            <p class="small">&copy; 2026 Online Examination Portal. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>