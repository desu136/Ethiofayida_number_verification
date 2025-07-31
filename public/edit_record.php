<?php
session_start();
require '../includes/db.php';

// Restrict to 'editor' only
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'editor') {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    die("Record ID not provided.");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM criminal_records WHERE record_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();

if (!$record) {
    die("Record not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crime_type = $_POST['crime_type'];
    $case_reference = $_POST['case_reference'];
    $conviction_date = $_POST['conviction_date'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("UPDATE criminal_records SET crime_type=?, case_reference=?, conviction_date=?, status=?, notes=? WHERE record_id=?");
    $stmt->bind_param("sssssi", $crime_type, $case_reference, $conviction_date, $status, $notes, $id);
    $stmt->execute();

    header("Location: dashboard_officer.php?fayida_number=" . $record['fayida_number']);
    exit;
}

include '../includes/header.php';
?>

<h2>Edit Criminal Record</h2>
<form method="POST">
    <label>Crime Type:</label>
    <input type="text" name="crime_type" value="<?= htmlspecialchars($record['crime_type']) ?>" required><br>

    <label>Case Reference:</label>
    <input type="text" name="case_reference" value="<?= htmlspecialchars($record['case_reference']) ?>" required><br>

    <label>Date:</label>
    <input type="date" name="conviction_date" value="<?= $record['conviction_date'] ?>" required><br>

    <label>Status:</label>
    <select name="status">
        <option value="active" <?= $record['status'] === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="closed" <?= $record['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
    </select><br>

    <label>Notes:</label>
    <textarea name="notes"><?= htmlspecialchars($record['notes']) ?></textarea><br>

    <button type="submit">Update Record</button>
</form>

<?php include '../includes/footer.php'; ?>
