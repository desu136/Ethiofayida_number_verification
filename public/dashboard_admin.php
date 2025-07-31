<?php
session_start();
require '../includes/db.php';

// Redirect non-admins
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}

// Include layout
include '../includes/header.php';
?>

<h2>Admin Dashboard</h2>
<p>Welcome, <strong><?= $_SESSION['user']['username'] ?></strong> (Admin)</p>

<hr>

<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    <div>
        <h3>User Management</h3>
        <ul>
            <li><a href="admin/add_user.php">➕ Add User</a></li>
            <li><a href="admin/users.php">📋 View All Users</a></li>
        </ul>
    </div>

    <div>
        <h3>Records</h3>
        <ul>
            <li><a href="dashboard_officer.php">👮 Access Officer Interface</a></li>
        </ul>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
