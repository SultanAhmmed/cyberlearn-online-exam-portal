<?php
include 'db.php';
if (!isset($_GET['exam_id'])) {
    die("Exam ID missing.");
}
$exam_id = (int)$_GET['exam_id'];
$query = "SELECT * FROM exams WHERE id = $exam_id";
$result = mysqli_query($conn, $query);
$exam = mysqli_fetch_assoc($result);
if (!$exam) {
    die("Exam not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <a href="student_dashboard.php" class="btn btn-outline-light"><i class="bi bi-arrow-left"></i> Back</a>
            </div>
        </div>
    </nav>

    <div class="exam-header text-center">
        <div class="container">
            <span class="hero-kicker"><i class="bi bi-journal-bookmark-fill"></i> Exam workspace</span>
            <h1 class="hero-title mb-3"><?php echo htmlspecialchars($exam['title']); ?></h1>
            <p class="lead mb-0"><?php echo htmlspecialchars($exam['description']); ?></p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="exam-card text-center">
                    <div class="dashboard-toolbar mb-3">
                        <span class="badge-soft"><i class="bi bi-info-circle"></i> Exam brief</span>
                        <span class="pill"><i class="bi bi-stopwatch"></i> Guided experience</span>
                    </div>
                    <div id="message" class="alert alert-info"></div>
                    <script>
                        // DOM XSS: reads hash from URL and inserts directly
                        var hash = window.location.hash.substring(1);
                        if (hash) {
                            document.getElementById('message').innerHTML = hash;
                        } else {
                            document.getElementById('message').innerHTML = 'Ready to start the exam?';
                        }
                    </script>
                    <div class="info-grid text-start my-4">
                        <div class="info-card">
                            <h6 class="fw-bold">Instructions</h6>
                            <p class="text-muted mb-0">This screen is styled like a production exam landing page and can later host timed questions, section rules, and submission controls.</p>
                        </div>
                        <div class="info-card">
                            <h6 class="fw-bold">Assessment flow</h6>
                            <p class="text-muted mb-0">Students can review the exam brief, enter the assessment page, and return to their dashboard from here.</p>
                        </div>
                    </div>
                    <p class="text-muted"><i class="bi bi-info-circle"></i> This is a sample exam. In a real system, questions would appear here.</p>
                    <a href="student_dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Back to Dashboard</a>
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