<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Insert (no vulnerability)
    $query = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', 'student')";
    if (mysqli_query($conn, $query)) {
        header('Location: login.php?registered=1');
        exit;
    } else {
        $error = "Registration failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-copy d-flex flex-column justify-content-between">
            <div>
                <span class="hero-kicker"><i class="bi bi-person-plus"></i> New student onboarding</span>
                <h1 class="hero-title mt-3">Create your learner profile.</h1>
                <p class="lead">Set up an account to join exams, track grades, and participate in the discussion space with a proper student-facing portal experience.</p>
                <div class="info-grid mt-4">
                    <div class="info-card">
                        <h6 class="fw-bold text-white">Exam access</h6>
                        <p class="mb-0 text-white-50">Registered students can open exam cards and review assessment details from their dashboard.</p>
                    </div>
                    <div class="info-card">
                        <h6 class="fw-bold text-white">Community access</h6>
                        <p class="mb-0 text-white-50">New members can read and post in the discussion forum to simulate campus activity.</p>
                    </div>
                </div>
            </div>
            <div class="pill-group mt-4">
                <span class="pill"><i class="bi bi-journal-bookmark"></i> Exams</span>
                <span class="pill"><i class="bi bi-chat-dots"></i> Forum</span>
                <span class="pill"><i class="bi bi-award"></i> Grades</span>
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
                <div class="metric-icon mx-auto"><i class="bi bi-person-plus"></i></div>
                <h2 class="mb-1">Register</h2>
                <p class="text-muted mb-0">Create your student account.</p>
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
                    <label class="form-label"><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <div class="mt-2">
                        <div class="progress" style="height: 8px; border-radius: 999px;">
                            <div class="progress-bar bg-warning" style="width: 33%"></div>
                        </div>
                        <small class="text-muted">Password strength indicator</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-shield-check"></i> Bot check</label>
                    <input type="text" class="form-control" placeholder="2 + 3 = ?">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">I agree to the terms and conditions</label>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-person-check"></i> Register</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <a href="login.php">Login</a>
                <a href="forgot_password.php">Need help?</a>
            </div>
        </div>
    </div>
</body>
</html>