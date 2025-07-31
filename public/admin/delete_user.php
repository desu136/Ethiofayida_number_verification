<?php
session_start();
require '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}

$id = $_GET['id'] ?? null;
if (!$id) die("No ID provided.");

$stmt = $conn->prepare("DELETE FROM users WHERE userid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: users.php");
exit;
