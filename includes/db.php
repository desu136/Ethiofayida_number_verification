<?php
$conn = new mysqli("localhost", "root", "desu123", "fayidaNumber");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
