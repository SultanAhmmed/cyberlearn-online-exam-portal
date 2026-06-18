<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Exam Comments</title></head>
<body>
    <h2>Exam Comments</h2>
    <?php
    // Show comments for a given exam
    if (isset($_GET['exam_id'])) {
        $exam_id = (int) $_GET['exam_id']; // cast to int to avoid SQLi (not our focus here)
        $query = "SELECT * FROM comments WHERE exam_id = $exam_id";
        $result = mysqli_query($conn, $query);
        ?>
        <h3>Comments for Exam #<?php echo $exam_id; ?></h3>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // VULNERABLE: direct echo of stored comment (stored XSS)
                echo "<p>" . $row['comment'] . " <small>(" . $row['posted_at'] . ")</small></p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
    } else {
        echo "<p>Please select an exam: <a href='?exam_id=1'>Exam 1</a> | <a href='?exam_id=2'>Exam 2</a></p>";
    }
    ?>

    <hr>
    <h3>Add a comment</h3>
    <form method="POST" action="">
        <input type="hidden" name="exam_id" value="<?php echo isset($_GET['exam_id']) ? (int) $_GET['exam_id'] : 1; ?>">
        <textarea name="comment" rows="4" cols="50" placeholder="Write your comment..."></textarea><br>
        <input type="submit" name="submit_comment" value="Post Comment">
    </form>

    <?php
    if (isset($_POST['submit_comment'])) {
        $exam_id = (int) $_POST['exam_id'];
        $comment = $_POST['comment'];

        // Escape the comment to prevent SQL errors, but keep the original content
        $safe_comment = mysqli_real_escape_string($conn, $comment);
        $insert = "INSERT INTO comments (exam_id, comment) VALUES ($exam_id, '$safe_comment')";

        if (mysqli_query($conn, $insert)) {
            echo "<p style='color:green;'>Comment added! Refresh the page to see it.</p>";
        } else {
            echo "<p style='color:red;'>Insert error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</body>
</html>
