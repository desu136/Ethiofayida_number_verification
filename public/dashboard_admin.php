
?>
<html>
    <head>
   <style>
    /* Dashboard Grid Layout */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.card {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.card h3 {
    margin-top: 0;
    color: #002244;
}

.card p {
    font-size: 0.95em;
    margin-bottom: 15px;
}

.card .button {
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 8px;
}

/* Stat Card with Icon and Colors */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: 0.3s;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 8px;
}

.bg-blue {
    background: #0077cc;
}

.bg-green {
    background: #28a745;
}

.bg-red {
    background: #dc3545;
}

.stat-card h3 {
    font-size: 2rem;
    margin: 0;
}

.stat-card p {
    font-size: 1em;
    margin: 5px 0 0;
}


    </style>
    </head>
<?php
session_start();
require '../includes/db.php';
include '../includes/header.php';

// Query total counts
$totalUsers = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$totalRecords = $conn->query("SELECT COUNT(*) as count FROM criminal_records")->fetch_assoc()['count'];
$totalOfficers = $conn->query("SELECT COUNT(*) as count FROM users WHERE role IN ('editor', 'viewer')")->fetch_assoc()['count'];
?>

<h2>📊 Admin Dashboard</h2>
<p>Welcome, <strong><?= $_SESSION['user']['username'] ?></strong> (Admin)</p>
<hr>

<!-- Existing dashboard links -->
<div class="dashboard-grid" style="margin-top: 40px;">
    <div class="card">
        <h3>👤 User Management</h3>
        <p>Manage system users.</p>
        <a class="button" href="admin/add_user.php">➕ Add User</a>
        <a class="button" href="admin/users.php">📋 View All Users</a>
    </div>
    <div class="card">
        <h3>🔍 Criminal Record Access</h3>
        <p>Access officer dashboard.</p>
        <a class="button" href="dashboard_officer.php">👮 Officer Interface</a>
    </div>
</div>
<!-- Stat Cards -->
<div class="stats-grid">
    <div class="stat-card bg-blue">
        <div class="stat-icon">👥</div>
        <h3><?= $totalUsers ?></h3>
        <p>Total Users</p>
    </div>
    <div class="stat-card bg-green">
        <div class="stat-icon">🧑‍⚖️</div>
        <h3><?= $totalOfficers ?></h3>
        <p>Total Officers</p>
    </div>
    <div class="stat-card bg-red">
        <div class="stat-icon">🕵️‍♂️</div>
        <h3><?= $totalRecords ?></h3>
        <p>Total Criminal Records</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
