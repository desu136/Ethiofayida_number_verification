<?php
session_start();
require '../includes/db.php';
require '../includes/auth.php';

// Only 'editor' and 'admin' can insert
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'editor') {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fayida_number = $_POST['fayida_number'];
    $crime_type = $_POST['crime_type'];
    $case_reference = $_POST['case_reference'];
    $conviction_date = $_POST['conviction_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO criminal_records (fayida_number, crime_type, case_reference, conviction_date, status, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fayida_number, $crime_type, $case_reference, $conviction_date, $status, $notes);
    $stmt->execute();

    header("Location: dashboard_officer.php?fayida_number=$fayida_number");
    exit;
}
?>
