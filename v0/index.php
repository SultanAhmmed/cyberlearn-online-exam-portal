# index.php

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberLearn - Online Examination Portal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #0f172a;
            color: #fff;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 90%;
            max-width: 1300px;
            margin: auto;
        }

        /* Navbar */
        .navbar {
            width: 100%;
            background: rgba(15, 23, 42, 0.95);
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #38bdf8;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-links a {
            color: #cbd5e1;
            transition: 0.3s;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: #38bdf8;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background: #38bdf8;
            color: #0f172a;
        }

        .btn-primary:hover {
            background: #0ea5e9;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #38bdf8;
            color: #38bdf8;
        }

        .btn-outline:hover {
            background: #38bdf8;
            color: #0f172a;
        }

        /* Hero */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)),
            url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600&auto=format&fit=crop') center/cover;
            text-align: center;
            padding: 50px 20px;
        }

        .hero-content h1 {
            font-size: 60px;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content h1 span {
            color: #38bdf8;
        }

        .hero-content p {
            color: #cbd5e1;
            max-width: 800px;
            margin: auto;
            font-size: 18px;
            margin-bottom: 35px;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Cards */
        .section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #94a3b8;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: #1e293b;
            border-radius: 20px;
            padding: 30px;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: #38bdf8;
        }

        .card i {
            font-size: 45px;
            margin-bottom: 20px;
            color: #38bdf8;
        }

        .card h3 {
            margin-bottom: 15px;
            font-size: 22px;
        }

        .card p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 14px;
        }

        /* Forms */
        .forms-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .form-card {
            background: #1e293b;
            padding: 35px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .form-card h3 {
            margin-bottom: 20px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #334155;
            background: #0f172a;
            color: white;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #38bdf8;
        }

        /* Exam Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 20px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 18px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        table th {
            background: #0f172a;
            color: #38bdf8;
        }

        table tr:hover {
            background: rgba(56, 189, 248, 0.08);
        }

        /* Search Section */
        .search-box {
            background: #1e293b;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .search-flex {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .search-flex input {
            flex: 1;
            min-width: 250px;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #334155;
            background: #0f172a;
            color: white;
        }

        /* Footer */
        footer {
            background: #020617;
            padding: 40px 0;
            text-align: center;
            color: #94a3b8;
            margin-top: 80px;
        }

        footer .socials {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        footer .socials a {
            width: 45px;
            height: 45px;
            background: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
        }

        footer .socials a:hover {
            background: #38bdf8;
            color: #0f172a;
        }

        /* Badge */
        .badge {
            display: inline-block;
            background: rgba(56,189,248,0.15);
            color: #38bdf8;
            padding: 8px 15px;
            border-radius: 999px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media(max-width: 768px) {
            .hero-content h1 {
                font-size: 38px;
            }

            .nav-links {
                display: none;
            }

            .section-title h2 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-wrapper">
            <div class="logo">CyberLearn</div>

            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#login">Login</a>
                <a href="#register">Register</a>
                <a href="#exams">Exam List</a>
                <a href="#search">Search</a>
                <button class="btn btn-primary">Admin Panel</button>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="badge">Cyber Security Learning Project</div>
            <h1>Online <span>Examination Portal</span></h1>
            <p>
                A modern examination portal UI designed for learning cyber security concepts.
                This front-end includes login systems, registration forms, search functionality,
                exam management pages, student profiles, downloadable papers, admin dashboard previews,
                notifications, and more.
            </p>

            <div class="hero-buttons">
                <button class="btn btn-primary">Start Learning</button>
                <button class="btn btn-outline">Explore Features</button>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Portal Features</h2>
                <p>Useful modules for future cyber security testing and development.</p>
            </div>

            <div class="grid">
                <div class="card">
                    <i class="fa-solid fa-user-lock"></i>
                    <h3>Authentication</h3>
                    <p>Login, registration, forgot password, role management, session handling, and user profile systems.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-file-lines"></i>
                    <h3>Exam Management</h3>
                    <p>Create exams, edit exam schedules, upload papers, and manage results from admin dashboard.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h3>Search Functions</h3>
                    <p>Search students by ID, search exam papers, search results, and search notices dynamically.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-chart-line"></i>
                    <h3>Student Dashboard</h3>
                    <p>View marks, rankings, exam schedules, attendance, notifications, and downloadable resources.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h3>Security Lab Ready</h3>
                    <p>Perfect structure for future learning of authentication flaws, input validation, SQL testing, and more.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-server"></i>
                    <h3>Admin Controls</h3>
                    <p>Admin panel UI with analytics, logs, announcements, exam creation forms, and user monitoring.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Forms -->
    <section class="section" id="login">
        <div class="container">
            <div class="section-title">
                <h2>User Authentication</h2>
                <p>Login and registration interface for students and admins.</p>
            </div>

            <div class="forms-wrapper">

                <!-- Login -->
                <div class="form-card">
                    <h3>Login</h3>

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="student@example.com">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <label>Login As</label>
                            <select>
                                <option>Student</option>
                                <option>Teacher</option>
                                <option>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width:100%;">
                            Login Account
                        </button>
                    </form>
                </div>

                <!-- Register -->
                <div class="form-card" id="register">
                    <h3>Create Account</h3>

                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" placeholder="Enter full name">
                        </div>

                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" placeholder="20260001">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" placeholder="example@mail.com">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Create password">
                        </div>

                        <div class="form-group">
                            <label>Department</label>
                            <select>
                                <option>CSE</option>
                                <option>EEE</option>
                                <option>BBA</option>
                                <option>LAW</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline" style="width:100%;">
                            Register Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Exam List -->
    <section class="section" id="exams">
        <div class="container">
            <div class="section-title">
                <h2>Exam List</h2>
                <p>Upcoming and active exams available on the portal.</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Exam Name</th>
                        <th>Course Code</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Web Security Mid Exam</td>
                        <td>CSE-403</td>
                        <td>20 June 2026</td>
                        <td>2 Hours</td>
                        <td>Upcoming</td>
                    </tr>

                    <tr>
                        <td>Database Fundamentals</td>
                        <td>CSE-207</td>
                        <td>25 June 2026</td>
                        <td>3 Hours</td>
                        <td>Active</td>
                    </tr>

                    <tr>
                        <td>Operating System Quiz</td>
                        <td>CSE-302</td>
                        <td>27 June 2026</td>
                        <td>1 Hour</td>
                        <td>Closed</td>
                    </tr>

                    <tr>
                        <td>Cyber Security Lab Test</td>
                        <td>CSE-505</td>
                        <td>30 June 2026</td>
                        <td>2 Hours</td>
                        <td>Upcoming</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Search Section -->
    <section class="section" id="search">
        <div class="container">
            <div class="section-title">
                <h2>Search Portal</h2>
                <p>Search students, exam papers, notices, and results.</p>
            </div>

            <div class="search-box">
                <h3 style="margin-bottom:20px;">Search Student By ID</h3>

                <div class="search-flex">
                    <input type="text" placeholder="Enter student ID">
                    <button class="btn btn-primary">Search Student</button>
                </div>
            </div>

            <div class="search-box">
                <h3 style="margin-bottom:20px;">Search Exam Papers</h3>

                <div class="search-flex">
                    <input type="text" placeholder="Search by course name or code">
                    <button class="btn btn-outline">Search Papers</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Dashboard Preview</h2>
                <p>Future modules you can connect with PHP and MySQL.</p>
            </div>

            <div class="grid">
                <div class="card">
                    <i class="fa-solid fa-bell"></i>
                    <h3>Notifications</h3>
                    <p>Display upcoming exam reminders, announcements, and teacher notices.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-download"></i>
                    <h3>Download Center</h3>
                    <p>Allow students to download admit cards, question papers, and result sheets.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-chart-pie"></i>
                    <h3>Performance Analytics</h3>
                    <p>Generate charts and score analytics for students and administrators.</p>
                </div>

                <div class="card">
                    <i class="fa-solid fa-users"></i>
                    <h3>User Roles</h3>
                    <p>Manage admin, teacher, examiner, and student permissions separately.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <h2>CyberLearn Examination Portal</h2>
            <p>
                Developed for educational and cyber security learning purposes.
            </p>

            <div class="socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>
```