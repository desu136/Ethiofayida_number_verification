<?php
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fayida Verification System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h1>🔍 Fayida Number Verification</h1>
    <nav>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="../logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>
<main>
<nav>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="../public/logout.php">Logout</a>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            | <a href="../public/dashboard_admin.php">Admin Panel</a>
        <?php else: ?>
            | <a href="../public/dashboard_officer.php">Dashboard</a>
        <?php endif; ?>
    <?php endif; ?>
</nav>
