<?php
/**if (password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    
    // Redirect based on role
    if ($user['role'] === 'admin') {
        header("Location: ../public/dashboard_admin.php");
    } else {
        header("Location: ../public/dashboard_officer.php");
    }
    exit;
}**/

// Redirect user if not logged in
function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: ../public/login.php");
        exit;
    }
}

// Redirect based on role
function requireRole($role) {
    requireLogin();
    if ($_SESSION['user']['role'] !== $role) {
        die("Access denied.");
    }
}


?>