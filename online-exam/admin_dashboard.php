<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_exam'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO exams (title, description, created_by) VALUES ('$title', '$description', {$_SESSION['user_id']})";
    mysqli_query($conn, $query);
    header('Location: admin_dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <span class="navbar-text text-white me-3">Admin: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="profile.php" class="btn btn-outline-light me-2"><i class="bi bi-person-circle"></i> Profile</a>
                <a href="logout.php" class="btn btn-outline-light"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="dashboard-header text-center">
        <div class="container">
            <span class="hero-kicker"><i class="bi bi-shield-lock"></i> Administration console</span>
            <h1 class="hero-title mb-3">Admin Dashboard</h1>
            <p class="lead mb-0">Manage students, exams, and content from a professional operations center.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-people-fill"></i></div>
                    <div class="metric-label">Students</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='student'");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Registered learner accounts</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div class="metric-label">Exams</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM exams");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Published assessments</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-chat-fill"></i></div>
                    <div class="metric-label">Comments</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM comments");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Forum messages and activity</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card metric-card text-center">
                    <div class="metric-icon mx-auto"><i class="bi bi-award-fill"></i></div>
                    <div class="metric-label">Grades</div>
                    <div class="metric-value"><?php 
                        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM grades");
                        $row = mysqli_fetch_assoc($count);
                        echo $row['total']; 
                    ?></div>
                    <div class="metric-note">Recorded marks across subjects</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4 dashboard-panel">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0"><i class="bi bi-people"></i> Manage Students</h5>
                            <span class="pill"><i class="bi bi-person-lines-fill"></i> Directory</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM users WHERE role='student'";
                                    $result = mysqli_query($conn, $query);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                            echo '<td><a href="delete_student.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Delete student?\')"><i class="bi bi-trash"></i></a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" class="text-muted">No students.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm mb-4 dashboard-panel">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Manage Exams</h5>
                            <span class="pill"><i class="bi bi-pencil-square"></i> Content</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM exams";
                                    $result = mysqli_query($conn, $query);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                                            echo '<td><a href="delete_exam.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Delete exam?\')"><i class="bi bi-trash"></i></a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="2" class="text-muted">No exams.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h6 class="section-heading">Create New Exam</h6>
                        <p class="text-muted small">Add a new exam card for the student dashboard and homepage listing.</p>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Exam Title" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="description" class="form-control" placeholder="Description" rows="2"></textarea>
                            </div>
                            <button type="submit" name="create_exam" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-7">
                <div class="content-card h-100">
                    <span class="badge-soft"><i class="bi bi-clipboard-data"></i> Operations</span>
                    <h4 class="section-heading mt-2">Management overview</h4>
                    <p class="section-subtitle">The admin area now reads like a control panel with clear sections, higher contrast cards, and stronger visual hierarchy.</p>
                    <div class="info-grid mt-4">
                        <div class="info-card">
                            <h6 class="fw-bold">Student records</h6>
                            <p class="text-muted mb-0">Track accounts and remove entries from the management table.</p>
                        </div>
                        <div class="info-card">
                            <h6 class="fw-bold">Exam publishing</h6>
                            <p class="text-muted mb-0">Create exams and surface them instantly in the portal experience.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="content-card h-100">
                    <span class="badge-soft"><i class="bi bi-list-check"></i> Admin notes</span>
                    <h4 class="section-heading mt-2">Current portal focus</h4>
                    <ul class="check-list mt-3">
                        <li><i class="bi bi-check-circle-fill"></i><span>Student roster is visible as a searchable management table.</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Exam creation is available from this screen for fast updates.</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Forum and grade data are surfaced through the rest of the site.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer" style="background: #2d3748; color: #cbd5e0; padding: 20px 0; text-align: center; margin-top: 30px;">
        <div class="container">
            <p class="small">&copy; 2026 Online Examination Portal. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>