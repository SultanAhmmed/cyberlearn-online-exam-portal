<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
    <h2>Admin Login</h2>
    <form method="GET" action="">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Login">
    </form>
    <hr>
    <?php
    if (isset($_GET['username']) && isset($_GET['password'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];

        // VULNERABLE: string concatenation
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<p style='color:green;'>Login successful! Welcome " . htmlspecialchars($username) . "</p>";
        } else {
            echo "<p style='color:red;'>Invalid credentials.</p>";
        }
        // Uncomment to show query for demonstration:
        // echo "<p>Query: " . $query . "</p>";
    }
    ?>
</body>
</html>
