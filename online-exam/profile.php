<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'db.php';

$user_id = $_SESSION['user_id'];
$user = null;
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
if ($result) $user = mysqli_fetch_assoc($result);

// Handle email update – CSRF vulnerable (no token)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $new_email = $_POST['email'];
    $update = "UPDATE users SET email = '$new_email' WHERE id = $user_id";
    mysqli_query($conn, $update);
    $user['email'] = $new_email;
    $message = "Email updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-outline-light me-2"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <div class="container">
            <span class="hero-kicker"><i class="bi bi-person-circle"></i> Account center</span>
            <h1 class="hero-title mb-3">My Profile</h1>
            <p class="lead mb-0">View and update your information from a polished account dashboard.</p>
        </div>
    </div>

    <div class="container" style="max-width: 980px;">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4">
                <div class="profile-card h-100 text-center">
                    <div class="profile-avatar mx-auto mb-3">
                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                    </div>
                    <span class="badge-soft mb-3"><i class="bi bi-person-badge"></i> <?php echo ucfirst($user['role']); ?></span>
                    <h3 class="section-heading mb-1"><?php echo htmlspecialchars($user['username']); ?></h3>
                    <p class="section-subtitle mb-4 text-break"><?php echo htmlspecialchars($user['email']); ?></p>
                    <div class="info-grid">
                        <div class="info-card"><div class="stat-label">Profile status</div><strong>Active</strong></div>
                        <div class="info-card"><div class="stat-label">Member since</div><strong>2026</strong></div>
                    </div>
                    <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-primary w-100 mt-3"><i class="bi bi-speedometer2"></i> Back to Dashboard</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="profile-card h-100">
                    <?php if (isset($message)): ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                        <div>
                            <span class="badge-soft"><i class="bi bi-person-lines-fill"></i> Identity</span>
                            <h4 class="section-heading mt-2 mb-0">Profile overview</h4>
                        </div>
                        <span class="pill"><i class="bi bi-shield-check"></i> Locked fields kept stable</span>
                    </div>
                    <div class="info-grid mb-4">
                        <div class="info-card">
                            <div class="stat-label">Username</div>
                            <h5 class="mb-0"><?php echo htmlspecialchars($user['username']); ?></h5>
                        </div>
                        <div class="info-card">
                            <div class="stat-label">Role</div>
                            <h5 class="mb-0"><?php echo ucfirst($user['role']); ?></h5>
                        </div>
                        <div class="info-card">
                            <div class="stat-label">Email</div>
                            <h5 class="mb-0 text-break"><?php echo htmlspecialchars($user['email']); ?></h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Completed exams</div><div class="metric-value">3</div></div></div>
                        <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Average score</div><div class="metric-value">78%</div></div></div>
                        <div class="col-md-4"><div class="summary-card text-center"><div class="metric-label">Forum posts</div><div class="metric-value">2</div></div></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-envelope"></i> Contact</span>
                            <h5 class="section-heading mt-2 mb-0">Update email</h5>
                        </div>
                        <a href="index.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-house-door"></i> Home</a>
                    </div>
                    <!-- CSRF vulnerability: no token, action uses POST -->
                    <form method="POST" action="profile.php">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Email</button>
                    </form>
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