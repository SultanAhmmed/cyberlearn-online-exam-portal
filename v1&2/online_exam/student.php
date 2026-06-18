<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Student Details</title></head>
<body>
    <h2>Student Information</h2>
    <p>Use URL parameter: <code>?id=</code></p>
    <hr>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // VULNERABLE: integer concatenation
        $query = "SELECT * FROM students WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "ID: " . $row['id'] . "<br>";
                echo "Name: " . $row['name'] . "<br>";
                echo "Email: " . $row['email'] . "<br>";
                echo "Course: " . $row['course'] . "<hr>";
            }
        } else {
            echo "No student found.";
        }
    } else {
        echo "Please provide an ID (e.g., ?id=1)";
    }
    ?>
</body>
</html>
