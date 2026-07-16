<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <a href="admin_dashboard.php" class="btn btn-outline-light btn-sm">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="page-hero">
        <div class="container text-center">
            <span class="hero-kicker"><i class="bi bi-graph-up-arrow"></i> Analytics</span>
            <h1 class="hero-title">Admin Analytics</h1>
            <p class="hero-copy mb-0">Charts for pass rate, average score, and exam-wise performance trends.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-4"><div class="stat-card metric-card text-center"><div class="metric-label">Pass rate</div><div class="metric-value">84%</div><div class="metric-note">Across all published exams</div></div></div>
            <div class="col-md-4"><div class="stat-card metric-card text-center"><div class="metric-label">Average score</div><div class="metric-value">76%</div><div class="metric-note">Based on recent results</div></div></div>
            <div class="col-md-4"><div class="stat-card metric-card text-center"><div class="metric-label">Completion</div><div class="metric-value">91%</div><div class="metric-note">Students finishing exams on time</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <span class="badge-soft"><i class="bi bi-pie-chart"></i> Pass rate</span>
                    <h4 class="section-heading mt-2">Result split</h4>
                    <div class="canvas-shell p-3 mt-3"><canvas id="passRateChart" height="240"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <span class="badge-soft"><i class="bi bi-graph-up"></i> Performance</span>
                    <h4 class="section-heading mt-2">Exam-wise trend</h4>
                    <div class="canvas-shell p-3 mt-3"><canvas id="performanceChart" height="240"></canvas></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-12">
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-columns-gap"></i> Overview</span>
                            <h4 class="section-heading mt-2 mb-0">What the admin sees</h4>
                        </div>
                        <span class="pill"><i class="bi bi-calendar3"></i> This week</span>
                    </div>
                    <div class="info-grid">
                        <div class="info-card"><h6 class="fw-bold">Pass rate %</h6><p class="text-muted mb-0">Track how many students clear each exam compared with the pass mark.</p></div>
                        <div class="info-card"><h6 class="fw-bold">Average score</h6><p class="text-muted mb-0">Compare class average across Math, Physics, and Chemistry style assessments.</p></div>
                        <div class="info-card"><h6 class="fw-bold">Trend review</h6><p class="text-muted mb-0">A simple graph makes the portal feel like a live operations product.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passRateCtx = document.getElementById('passRateChart');
        new Chart(passRateCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pass', 'Fail'],
                datasets: [{
                    data: [84, 16],
                    backgroundColor: ['#0f62fe', '#cbd5e1'],
                    borderWidth: 0
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } }, cutout: '72%' }
        });

        const performanceCtx = document.getElementById('performanceChart');
        new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: ['Midterm Math', 'Physics Final', 'Chemistry Quiz'],
                datasets: [{
                    label: 'Average Score',
                    data: [78, 74, 80],
                    backgroundColor: ['#0f62fe', '#00b8a9', '#3f7dff']
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, max: 100 } } }
        });
    </script>
</body>
</html>