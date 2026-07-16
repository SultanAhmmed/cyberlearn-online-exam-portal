<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    // No escaping on insert – we escape to avoid SQL errors but keep original for XSS
    $safe_comment = mysqli_real_escape_string($conn, $comment);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $insert = "INSERT INTO comments (user_id, comment) VALUES ($user_id, '$safe_comment')";
    mysqli_query($conn, $insert);
    header('Location: discussion.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-mortarboard-fill"></i> Exam Portal</a>
            <div class="ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="navbar-text text-white me-3"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="btn btn-outline-light"><i class="bi bi-box-arrow-right"></i> Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="forum-header text-center">
        <div class="container">
            <span class="hero-kicker"><i class="bi bi-chat-dots"></i> Student community</span>
            <h1 class="hero-title mb-3">Discussion Forum</h1>
            <p class="lead mb-0">Share thoughts, ask questions, and keep the academic conversation active.</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-4">
                <div class="content-card sticky-top" style="top: 1rem;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-search"></i> Search</span>
                            <h4 class="section-heading mt-2 mb-0">Threads</h4>
                        </div>
                        <a href="index.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-house-door"></i></a>
                    </div>
                    <input type="text" class="form-control mb-3" placeholder="Search discussion threads...">
                    <div class="d-grid gap-2">
                        <span class="filter-pill active">All</span>
                        <span class="filter-pill">Doubt</span>
                        <span class="filter-pill">Announcement</span>
                        <span class="filter-pill">Study Group</span>
                    </div>
                    <div class="mt-4">
                        <div class="notification-item mb-2">
                            <div class="notification-dot info"></div>
                            <div><strong>Pinned announcement</strong><p class="text-muted mb-0">Exam timetable is updated for this week.</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="comment-card mb-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                        <div>
                            <span class="badge-soft"><i class="bi bi-pencil-square"></i> New thread</span>
                            <h5 class="section-heading mt-2 mb-1">Post a comment</h5>
                            <p class="section-subtitle mb-0">Write a short update, question, or class note for other students.</p>
                        </div>
                        <span class="pill"><i class="bi bi-lightbulb"></i> One level reply</span>
                    </div>
                    <form method="POST" action="discussion.php" class="comment-form">
                        <div class="mb-3">
                            <textarea name="comment" rows="4" class="form-control" placeholder="Start a new thread..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="pill-group">
                                <span class="filter-pill active">Doubt</span>
                                <span class="filter-pill">Announcement</span>
                                <span class="filter-pill">General</span>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Post Comment</button>
                        </div>
                    </form>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="feature-card text-center"><div class="metric-icon mx-auto"><i class="bi bi-people"></i></div><h5 class="mb-1">Community first</h5><p class="text-muted mb-0">A calm forum layout with clear thread cards.</p></div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card text-center"><div class="metric-icon mx-auto"><i class="bi bi-megaphone"></i></div><h5 class="mb-1">Pinned updates</h5><p class="text-muted mb-0">Admin posts can sit at the top as announcements.</p></div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card text-center"><div class="metric-icon mx-auto"><i class="bi bi-chat-left-text"></i></div><h5 class="mb-1">Nested replies</h5><p class="text-muted mb-0">Replies are visually grouped for real discussion flow.</p></div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4 mb-3">
                    <div>
                        <span class="badge-soft"><i class="bi bi-chat-left-text"></i> Live feed</span>
                        <h4 class="section-heading mt-2 mb-0">All comments</h4>
                    </div>
                    <span class="pill"><i class="bi bi-clock-history"></i> Updated in real time</span>
                </div>
                <?php
                $query = "SELECT comments.*, users.username FROM comments LEFT JOIN users ON comments.user_id = users.id ORDER BY posted_at DESC";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // VULNERABLE: Stored XSS – direct echo of comment
                        echo '<div class="comment-card mb-3">';
                        echo '<div class="d-flex gap-3 align-items-start">';
                        echo '<div class="metric-icon"><i class="bi bi-chat-dots"></i></div>';
                        echo '<div class="flex-grow-1">';
                        echo '<div class="d-flex justify-content-between align-items-center mb-2"><strong>' . htmlspecialchars($row['username'] ?? 'Anonymous') . '</strong><span class="pill"><i class="bi bi-heart"></i> 12</span></div>';
                        echo '<div class="comment-body mb-3">' . $row['comment'] . '</div>';
                        echo '<div class="comment-meta text-muted mb-3"><i class="bi bi-clock"></i> ' . $row['posted_at'] . '</div>';
                        echo '<div class="border-start ps-3 ms-2"><small class="text-muted">Reply</small><div class="notification-item mt-2"><div class="notification-dot success"></div><div><strong>Peer reply</strong><p class="text-muted mb-0">That exam tip is useful. Thanks for sharing.</p></div></div></div>';
                        echo '</div></div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-muted">No comments yet. Be the first!</p>';
                }
                ?>
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