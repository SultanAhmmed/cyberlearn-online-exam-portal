<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Examination Portal</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        a { display: block; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Online Examination Portal</h1>
    <p>Vulnerable Lab – DO NOT USE IN PRODUCTION</p>
    <ul>
        <li><a href="admin_login.php">Admin Login (SQLi – String)</a></li>
        <li><a href="student.php?id=1">Student Details by ID (SQLi – Integer)</a></li>
        <li><a href="search.php?q=test">Search (Reflected XSS)</a></li>
        <li><a href="exam_comments.php?exam_id=1">Exam Comments (Stored XSS)</a></li>
    </ul>
</body>
</html>
