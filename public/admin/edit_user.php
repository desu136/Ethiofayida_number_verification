<?php
session_start();
require '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}

$id = $_GET['id'] ?? null;
if (!$id) die("No user ID.");

$stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) die("User not found.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username=?, role=?, password=? WHERE userid=?");
        $stmt->bind_param("sssi", $username, $role, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE userid=?");
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    $stmt->execute();
    header("Location: users.php");
    exit;
}

include '../../includes/header.php';
?>

<h2>Edit User</h2>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>

    <label>Role:</label>
    <select name="role">
        <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
        <option value="viewer" <?= $user['role'] === 'viewer' ? 'selected' : '' ?>>Viewer</option>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br>

    <label>New Password (leave blank to keep existing):</label>
    <input type="password" name="password"><br><br>

    <button type="submit">Update User</button>
</form>

<?php include '../../includes/footer.php'; ?>
