<?php
session_start();
require '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied.");
}

include '../../includes/header.php';

$result = $conn->query("SELECT * FROM users");
?>

<h2>👤 Manage Users</h2>
<a href="add_user.php"><button>Add New User</button></a><br><br>

<table>
    <tr>
        <th>ID</th><th>Username</th><th>Role</th><th>Created At</th><th>Actions</th>
    </tr>
    <?php while ($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $user['userid'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user['userid'] ?>">Edit</a> |
                <a href="delete_user.php?id=<?= $user['userid'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../../includes/footer.php'; ?>
