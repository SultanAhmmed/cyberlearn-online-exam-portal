<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Search</title></head>
<body>
    <h2>Search for anything</h2>
    <form method="GET" action="">
        <input type="text" name="q" placeholder="Enter search term">
        <input type="submit" value="Search">
    </form>
    <hr>
    <?php
    if (isset($_GET['q'])) {
        $q = $_GET['q'];
        // VULNERABLE: direct echo without encoding (reflected XSS)
        echo "<p>You searched for: " . $q . "</p>";

        // Optional: also simulate a database query (but not necessary for XSS demo)
        // For demonstration, we just reflect the input.
    }
    ?>
</body>
</html>
