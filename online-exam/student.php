<?php
include 'db.php';
if (!isset($_GET['id'])) {
    die("Student ID missing.");
}
$id = $_GET['id'];
// VULNERABLE: SQL Injection – integer concatenation
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

// Fetch grades for this student
$grades = [];
if ($student) {
    $grades_query = "SELECT * FROM grades WHERE student_id = $id";
    $grades_result = mysqli_query($conn, $grades_query);
    while ($row = mysqli_fetch_assoc($grades_result)) {
        $grades[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <a href="index.php" class="btn btn-outline-light me-2"><i class="bi bi-house-door"></i> Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-outline-light"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if ($student): ?>
        <div class="profile-header text-center">
            <div class="container">
                <?php
                    $gradeCount = count($grades);
                    $gradeTotal = 0;
                    $topSubject = 'N/A';
                    $topScore = -1;
                    foreach ($grades as $grade) {
                        $gradeTotal += (int)$grade['grade'];
                        if ((int)$grade['grade'] > $topScore) {
                            $topScore = (int)$grade['grade'];
                            $topSubject = $grade['subject'];
                        }
                    }
                    $averageGrade = $gradeCount > 0 ? round($gradeTotal / $gradeCount) : 0;
                ?>
                <span class="hero-kicker"><i class="bi bi-person-circle"></i> Student profile</span>
                <h1 class="hero-title mb-3"><?php echo htmlspecialchars($student['username']); ?></h1>
                <p class="lead mb-3"><?php echo htmlspecialchars($student['email']); ?></p>
                <span class="pill"><i class="bi bi-award"></i> <?php echo ucfirst($student['role']); ?></span>
            </div>
        </div>

        <div class="container">
            <div class="row g-4 align-items-stretch justify-content-center">
                <div class="col-lg-4">
                    <div class="profile-card h-100 text-center">
                        <?php $initial = strtoupper(substr($student['username'], 0, 1)); ?>
                        <div class="profile-avatar mx-auto mb-3"><?php echo $initial; ?></div>
                        <span class="badge-soft mb-3"><i class="bi bi-person-badge"></i> Public student card</span>
                        <h3 class="section-heading mb-1"><?php echo htmlspecialchars($student['username']); ?></h3>
                        <p class="section-subtitle mb-4 text-break"><?php echo htmlspecialchars($student['email']); ?></p>
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="summary-card text-center h-100">
                                    <div class="metric-label">Average</div>
                                    <div class="metric-value"><?php echo $averageGrade; ?>%</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="summary-card text-center h-100">
                                    <div class="metric-label">Top mark</div>
                                    <div class="metric-value"><?php echo $topScore >= 0 ? $topScore : 0; ?>%</div>
                                </div>
                            </div>
                        </div>
                        <div class="info-grid mb-4">
                            <div class="info-card"><div class="stat-label">Completed exams</div><strong><?php echo $gradeCount > 0 ? $gradeCount : 0; ?></strong></div>
                            <div class="info-card"><div class="stat-label">Top subject</div><strong><?php echo htmlspecialchars($topSubject); ?></strong></div>
                        </div>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-primary w-100"><i class="bi bi-speedometer2"></i> Back to Dashboard</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="profile-card">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <div>
                                <span class="badge-soft"><i class="bi bi-info-circle"></i> Personal information</span>
                                <h4 class="section-heading mt-2 mb-0">Student record</h4>
                            </div>
                            <span class="pill"><i class="bi bi-journal-check"></i> Gradebook</span>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4"><div class="info-card"><div class="stat-label">Username</div><h5 class="mb-0"><?php echo htmlspecialchars($student['username']); ?></h5></div></div>
                            <div class="col-md-4"><div class="info-card"><div class="stat-label">Email</div><h5 class="mb-0 text-break"><?php echo htmlspecialchars($student['email']); ?></h5></div></div>
                            <div class="col-md-4"><div class="info-card"><div class="stat-label">Role</div><h5 class="mb-0"><?php echo ucfirst($student['role']); ?></h5></div></div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Average</div><div class="metric-value"><?php echo $averageGrade; ?>%</div></div></div>
                            <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Top mark</div><div class="metric-value"><?php echo $topScore >= 0 ? $topScore : 0; ?>%</div></div></div>
                            <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Subjects</div><div class="metric-value"><?php echo $gradeCount; ?></div></div></div>
                        </div>

                        <h4 class="section-heading"><i class="bi bi-award"></i> Grades</h4>
                        <?php if (count($grades) > 0): ?>
                            <div class="mt-3">
                                <?php foreach ($grades as $grade): ?>
                                    <div class="list-card mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><strong><?php echo htmlspecialchars($grade['subject']); ?></strong></span>
                                            <span class="badge <?php echo ($grade['grade'] >= 70) ? 'bg-success' : 'bg-warning text-dark'; ?>"><?php echo $grade['grade']; ?>%</span>
                                        </div>
                                        <div class="progress" style="height: 10px; border-radius: 999px;">
                                            <div class="progress-bar <?php echo ($grade['grade'] >= 70) ? 'bg-success' : 'bg-warning'; ?>" style="width: <?php echo (int)$grade['grade']; ?>%"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No grades recorded yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Student not found.</div>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="footer mt-5" style="background: #2d3748; color: #cbd5e0; padding: 20px 0; text-align: center;">
        <div class="container">
            <p class="small">&copy; 2026 Online Examination Portal. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>