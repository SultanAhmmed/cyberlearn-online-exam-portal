<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // VULNERABLE: SQL Injection
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: student_dashboard.php');
        }
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-copy d-flex flex-column justify-content-between">
            <div>
                <span class="hero-kicker"><i class="bi bi-building"></i> Campus operations portal</span>
                <h1 class="hero-title mt-3">Sign in to your exam workspace.</h1>
                <p class="lead">Access dashboards, student records, discussions, and exam workflows from a portal that feels like a real institutional product.</p>
                <ul class="feature-list mt-4">
                    <li><i class="bi bi-check-circle-fill"></i><span>Role-based routes for students and administrators.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i><span>Clean scheduling, profile, and grade management screens.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i><span>Forum activity and exam content remain available in one place.</span></li>
                </ul>
            </div>
            <div class="pill-group mt-4">
                <span class="pill"><i class="bi bi-shield-check"></i> Secure access lab</span>
                <span class="pill"><i class="bi bi-journal-check"></i> Live data</span>
                <span class="pill"><i class="bi bi-people"></i> Student community</span>
            </div>
        </div>

        <div class="auth-card">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <a href="index.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-house-door"></i> Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-outline-primary btn-sm"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <?php endif; ?>
            </div>
            <div class="text-center mb-4">
                <div class="metric-icon mx-auto"><i class="bi bi-box-arrow-in-right"></i></div>
                <h2 class="mb-1">Login</h2>
                <p class="text-muted mb-0">Use your portal credentials to continue.</p>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-person"></i> Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <a href="forgot_password.php">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-arrow-right-circle"></i> Login</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <a href="register.php">Register</a>
                <a href="forgot_password.php">Forgot password?</a>
            </div>
            <p class="mt-2 text-center hint text-muted small"><i class="bi bi-info-circle"></i> Demo credentials are available in the database setup file.</p>
        </div>
    </div>
</body>
</html>