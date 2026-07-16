<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <a href="student_dashboard.php" class="btn btn-outline-light btn-sm"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="page-hero">
        <div class="container text-center">
            <span class="hero-kicker"><i class="bi bi-award"></i> Result published</span>
            <h1 class="hero-title">Mathematics Midterm</h1>
            <p class="hero-copy mb-0">A polished result summary with score breakdown, pass badge, and next-step actions.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4">
                <div class="summary-card h-100 text-center">
                    <div class="result-score-ring">
                        <div class="inner">
                            <div>
                                <div class="result-big">78%</div>
                                <small class="text-muted">Score</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="result-badge"><i class="bi bi-patch-check-fill"></i> Pass</span>
                    </div>
                    <p class="text-muted mt-3 mb-0">Your performance is above the pass threshold and ready for review in the student dashboard.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="content-card h-100">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-bar-chart-fill"></i> Breakdown</span>
                            <h4 class="section-heading mt-2 mb-0">Question summary</h4>
                        </div>
                        <span class="pill"><i class="bi bi-calendar-check"></i> Published instantly</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4"><div class="info-card"><div class="stat-label">Correct</div><h3 class="mb-0">31</h3></div></div>
                        <div class="col-md-4"><div class="info-card"><div class="stat-label">Wrong</div><h3 class="mb-0">9</h3></div></div>
                        <div class="col-md-4"><div class="info-card"><div class="stat-label">Unanswered</div><h3 class="mb-0">5</h3></div></div>
                    </div>
                    <hr class="section-divider">
                    <div class="info-grid">
                        <div class="info-card">
                            <h6 class="fw-bold">Pass criteria</h6>
                            <p class="text-muted mb-0">Pass mark: 50%. Result badge updates automatically when the score crosses the threshold.</p>
                        </div>
                        <div class="info-card">
                            <h6 class="fw-bold">Review status</h6>
                            <p class="text-muted mb-0">Admin review can hold or release results depending on the exam settings.</p>
                        </div>
                    </div>
                    <div class="hero-actions mt-4">
                        <a href="student_dashboard.php" class="btn btn-primary"><i class="bi bi-speedometer2"></i> Back to Dashboard</a>
                        <a href="discussion.php" class="btn btn-outline-primary"><i class="bi bi-chat-dots"></i> Ask in Forum</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>