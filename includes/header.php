<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fayida Verification System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
     <style>
 /* Layout Wrapper */
.layout {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 220px;
    background-color: #002244;
    color: white;
    padding: 20px;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    height: 100vh;
}

.sidebar-title {
    font-size: 1.5em;
    margin-bottom: 30px;
    text-align: center;
    color: #ffffff;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
}

.sidebar nav ul li {
    margin: 15px 0;
}

.sidebar nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    display: block;
}

.sidebar nav ul li a:hover {
    text-decoration: underline;
}

/* Main Content */
.main-content {
    flex-grow: 1;
    padding: 30px;
    background: #f4f6f9;
    min-height: 100vh;
}

/* Adjust footer */
footer {
    background-color: #002244;
    color: white;
    text-align: center;
    padding: 10px;
}


    </style>

</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <h2 class="sidebar-title">Fayida</h2>
        <nav>
            <ul>
                <li><a href="../dashboard_admin.php">🏠 Dashboard</a></li>
                <li><a href="../admin/add_user.php">➕ Add User</a></li>
                <li><a href="../admin/users.php">👥 View Users</a></li>
                <li><a href="../dashboard_officer.php">🔍 Officer Interface</a></li>
                <li><a href="../logout.php">🚪 Logout</a></li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
