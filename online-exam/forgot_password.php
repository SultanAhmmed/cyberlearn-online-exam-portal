<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-copy d-flex flex-column justify-content-between">
            <div>
                <span class="hero-kicker"><i class="bi bi-shield-lock"></i> Recovery flow</span>
                <h1 class="hero-title mt-3">Reset your password in a few steps.</h1>
                <p class="lead">Use the same clean portal language as the rest of the system: email, verify, then set a new password.</p>
                <div class="stepper mt-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h6 class="fw-bold text-white mb-1">Email</h6>
                        <p class="mb-0 text-white-50">Enter your registered email address to begin recovery.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h6 class="fw-bold text-white mb-1">Verify</h6>
                        <p class="mb-0 text-white-50">Confirm using a link or one-time code sent to you.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h6 class="fw-bold text-white mb-1">Set password</h6>
                        <p class="mb-0 text-white-50">Create a new password and return to login.</p>
                    </div>
                </div>
            </div>
            <div class="pill-group mt-4">
                <span class="pill"><i class="bi bi-envelope-paper"></i> Email reset</span>
                <span class="pill"><i class="bi bi-key"></i> OTP / link</span>
                <span class="pill"><i class="bi bi-lock-fill"></i> New password</span>
            </div>
        </div>

        <div class="auth-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="index.php" class="btn btn-outline-primary btn-sm">Home</a>
                    <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
                </div>
            </div>
            <div class="mb-3">
                <span class="badge-soft"><i class="bi bi-arrow-counterclockwise"></i> Password help</span>
                <h2 class="section-heading mt-2 mb-0">Forgot Password</h2>
            </div>
            <div class="alert alert-info">
                <strong>Step 1:</strong> submit your email. The next panel simulates a verification code and reset form.
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="name@example.com">
            </div>
            <button class="btn btn-primary w-100 mb-3">Send verification link</button>

            <hr class="section-divider">

            <div class="mb-3">
                <label class="form-label">OTP / link code</label>
                <input type="text" class="form-control" placeholder="Enter 6-digit code">
            </div>
            <div class="mb-3">
                <label class="form-label">New password</label>
                <input type="password" class="form-control" placeholder="New password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control" placeholder="Confirm password">
            </div>
            <button class="btn btn-primary w-100">Update password</button>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <a href="register.php">Create account</a>
                <a href="student_dashboard.php">Go to dashboard</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Design-only recovery screen. In a live system, this would connect to email/OTP validation.</p>
        </div>
    </div>
</body>
</html>