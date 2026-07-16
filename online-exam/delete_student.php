<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = $id AND role='student'";
    mysqli_query($conn, $query);
}
header('Location: admin_dashboard.php');
exit;
?>