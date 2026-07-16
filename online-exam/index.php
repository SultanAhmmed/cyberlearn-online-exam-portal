<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><span class="nav-link text-white">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="student_dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php"><i class="bi bi-person-plus"></i> Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="forgot_password.php"><i class="bi bi-key"></i> Reset Password</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="page-hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="hero-kicker"><i class="bi bi-broadcast"></i> Live academic operations</span>
                    <h1 class="hero-title">Online Examination Portal</h1>
                    <p class="hero-copy mb-0">A realistic exam platform for scheduling, student profiles, grades, and community discussion. It is structured like a production learning portal with active workflows and live database content.</p>
                    <div class="hero-stat-strip">
                        <div class="hero-stat">500+ Students</div>
                        <div class="hero-stat">50+ Exams</div>
                        <div class="hero-stat">98% Uptime</div>
                    </div>
                    <div class="hero-actions">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>" class="btn btn-light btn-lg"><i class="bi bi-speedometer2"></i> Open Dashboard</a>
                            <a href="discussion.php" class="btn btn-outline-light btn-lg"><i class="bi bi-chat-dots"></i> Community Forum</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-light btn-lg"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                            <a href="register.php" class="btn btn-outline-light btn-lg"><i class="bi bi-person-plus"></i> Create Account</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="glass-card p-4 text-dark">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <div class="badge-soft mb-2"><i class="bi bi-graph-up-arrow"></i> Portal snapshot</div>
                                <h3 class="mb-1">Real-time overview</h3>
                                <p class="text-muted mb-0">The homepage now feels like a product dashboard, not a demo landing page.</p>
                            </div>
                            <span class="pill"><i class="bi bi-shield-check"></i> Active</span>
                        </div>
                        <div class="metric-grid">
                            <div class="summary-card metric-card">
                                <div class="metric-label">Students</div>
                                <div class="metric-value"><?php $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='student'"); $row = mysqli_fetch_assoc($count); echo $row['total']; ?></div>
                                <div class="metric-note">Registered learners in the system</div>
                            </div>
                            <div class="summary-card metric-card">
                                <div class="metric-label">Exams</div>
                                <div class="metric-value"><?php $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM exams"); $row = mysqli_fetch_assoc($count); echo $row['total']; ?></div>
                                <div class="metric-note">Published assessments and quizzes</div>
                            </div>
                            <div class="summary-card metric-card">
                                <div class="metric-label">Comments</div>
                                <div class="metric-value"><?php $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM comments"); $row = mysqli_fetch_assoc($count); echo $row['total']; ?></div>
                                <div class="metric-note">Forum messages and discussion threads</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-journal-text"></i></div>
                    <h5>Exam operations</h5>
                    <p class="text-muted mb-0">Browse assessments, launch exam pages, and review the structure of each test from a polished portal layout.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-chat-square-text"></i></div>
                    <h5>Student discussion</h5>
                    <p class="text-muted mb-0">The forum now looks like an active campus community with readable cards, recent activity, and writing prompts.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-person-badge"></i></div>
                    <h5>Profiles and grades</h5>
                    <p class="text-muted mb-0">Student profile pages highlight performance data, grade history, and account information like a real campus system.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="content-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-stars"></i> Campus trust</span>
                            <h4 class="section-heading mt-2 mb-0">Trusted by students and admins</h4>
                        </div>
                        <span class="pill"><i class="bi bi-shield-check"></i> Always online</span>
                    </div>
                    <div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-7">
                                        <h5 class="mb-2">"The portal feels like a real academic system."</h5>
                                        <p class="text-muted mb-0">Students can move from dashboard to exam to results without losing context.</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="summary-card text-center">
                                            <div class="metric-label">Top feedback</div>
                                            <div class="metric-value">A+</div>
                                            <div class="metric-note">Fast, clear, modern interface</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-7">
                                        <h5 class="mb-2">"Admin screens look like an actual operations tool."</h5>
                                        <p class="text-muted mb-0">Tables, cards, and analytics are positioned like a working portal, not a demo page.</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="summary-card text-center">
                                            <div class="metric-label">Operations</div>
                                            <div class="metric-value">24/7</div>
                                            <div class="metric-note">Continuous academic workflow</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-search"></i> Directory search</span>
                            <h4 class="section-heading mt-2 mb-1">Find a student profile</h4>
                            <p class="section-subtitle mb-0">Search by name or email to view a public student profile card.</p>
                        </div>
                        <span class="pill"><i class="bi bi-people"></i> Live users</span>
                    </div>
                    <form method="GET" action="index.php" class="d-flex">
                        <input type="text" name="q" class="form-control form-control-lg me-2" placeholder="Enter student name or email..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="bi bi-search"></i> Search</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <?php
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = $_GET['q'];
            // VULNERABLE: Reflected XSS – directly echoing input
            echo '<div class="alert alert-info mt-3"><i class="bi bi-info-circle"></i> You searched for: ' . $q . '</div>';

            // Query database for matching students (vulnerable to SQLi but we keep it for XSS demo)
            $sql = "SELECT * FROM users WHERE role='student' AND (username LIKE '%$q%' OR email LIKE '%$q%')";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                echo '<div class="row mt-4">';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-4 mb-3">';
                    echo '<div class="card student-card h-100">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title"><i class="bi bi-person-circle"></i> ' . htmlspecialchars($row['username']) . '</h5>';
                    echo '<p class="card-text"><i class="bi bi-envelope"></i> ' . htmlspecialchars($row['email']) . '</p>';
                    echo '<a href="student.php?id=' . $row['id'] . '" class="btn btn-outline-primary btn-sm">View Profile</a>';
                    echo '</div></div></div>';
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning mt-3"><i class="bi bi-exclamation-triangle"></i> No students found.</div>';
            }
        }
        ?>

        <hr class="section-divider my-5">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-lightning-charge"></i> Workflow</span>
                            <h4 class="section-heading mt-2 mb-0">How the portal is used</h4>
                        </div>
                        <span class="pill"><i class="bi bi-diagram-3"></i> Guided flow</span>
                    </div>
                    <div class="info-grid">
                        <div class="info-card">
                            <h6 class="fw-bold">1. Sign in</h6>
                            <p class="text-muted mb-0">Students and admins use separate dashboards with role-based navigation.</p>
                        </div>
                        <div class="info-card">
                            <h6 class="fw-bold">2. Explore</h6>
                            <p class="text-muted mb-0">View exams, browse student profiles, and read discussion activity from the homepage.</p>
                        </div>
                        <div class="info-card">
                            <h6 class="fw-bold">3. Participate</h6>
                            <p class="text-muted mb-0">Take exams, update profile details, post in discussions, and manage content from the dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-clock-history"></i> Latest content</span>
                            <h4 class="section-heading mt-2 mb-0">Recent exams and discussions</h4>
                        </div>
                        <span class="pill"><i class="bi bi-bell"></i> Updated now</span>
                    </div>
                    <?php
                        $recentExams = mysqli_query($conn, "SELECT * FROM exams ORDER BY created_at DESC LIMIT 3");
                        $recentComments = mysqli_query($conn, "SELECT comments.*, users.username FROM comments LEFT JOIN users ON comments.user_id = users.id ORDER BY posted_at DESC LIMIT 3");
                    ?>
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Upcoming exam cards</h6>
                        <?php while ($exam = mysqli_fetch_assoc($recentExams)): ?>
                            <div class="d-flex justify-content-between align-items-center border rounded-4 p-3 mb-2 bg-white">
                                <div>
                                    <strong><?php echo htmlspecialchars($exam['title']); ?></strong><br>
                                    <small class="text-muted"><?php echo htmlspecialchars($exam['description']); ?></small>
                                </div>
                                <a href="exam.php?exam_id=<?php echo $exam['id']; ?>" class="btn btn-sm btn-outline-primary">Open</a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-3">Community pulse</h6>
                        <?php while ($comment = mysqli_fetch_assoc($recentComments)): ?>
                            <div class="d-flex gap-3 align-items-start border rounded-4 p-3 mb-2 bg-white">
                                <div class="metric-icon mb-0"><i class="bi bi-chat-dots"></i></div>
                                <div>
                                    <strong><?php echo htmlspecialchars($comment['username'] ?? 'Anonymous'); ?></strong>
                                    <p class="mb-1 text-muted"><?php echo htmlspecialchars(substr($comment['comment'], 0, 100)); ?><?php echo strlen($comment['comment']) > 100 ? '...' : ''; ?></p>
                                    <small class="text-muted"><?php echo htmlspecialchars($comment['posted_at']); ?></small>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer site-footer">
        <div class="container">
            <div class="footer-grid mb-4">
                <div class="footer-card"><h5 class="text-white">Portal</h5><p class="mb-0">Exams, results, discussions, profiles.</p></div>
                <div class="footer-card"><h5 class="text-white">Quick links</h5><p class="mb-0"><a href="login.php">Login</a> · <a href="register.php">Register</a> · <a href="discussion.php">Forum</a></p></div>
                <div class="footer-card"><h5 class="text-white">Newsletter</h5><input class="form-control form-control-sm mt-2" placeholder="Email address"><button class="btn btn-light btn-sm mt-2">Subscribe</button></div>
            </div>
            <div class="text-center">
                <p class="mb-1">&copy; 2026 Online Examination Portal. All rights reserved.</p>
                <p class="small mb-0">This is a vulnerable lab for educational purposes only.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>