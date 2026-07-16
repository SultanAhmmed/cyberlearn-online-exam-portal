<?php
$conn = mysqli_connect("localhost", "sultan", "sultan123", "sqli");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>