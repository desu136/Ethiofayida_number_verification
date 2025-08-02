<?php
session_start();
require '../includes/db.php';
require '../includes/fayida_service.php';
require '../includes/criminal_service.php';
include '../includes/header.php';
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['editor', 'viewer'])) {
    die("Access denied.");
}

$role = $_SESSION['user']['role'];


?>

<div class="container">
    <h2>Officer Dashboard (<?= ucfirst($role) ?>)</h2>
    <p>Welcome, <strong><?= $_SESSION['user']['username'] ?></strong></p>

    <form method="GET" action="" class="search-form">
        <label for="fayida_number">Enter Fayida Number:</label>
        <input type="text" name="fayida_number" id="fayida_number" required>
        <button type="submit">🔍 Search</button>
    </form>

    <?php
    if (isset($_GET['fayida_number'])):
        $fayida_number = $_GET['fayida_number'];
        $citizen = getCitizenByFayida($conn, $fayida_number);
        $records = getCriminalRecords($conn, $fayida_number);
    ?>

    <hr>
    <h3>Citizen Information</h3>

    <?php if ($citizen): ?>
        <div class="citizen-info">
            <p><strong>Name:</strong> <?= $citizen['full_name'] ?></p>
            <p><strong>DOB:</strong> <?= $citizen['date_of_birth'] ?></p>
            <p><strong>Gender:</strong> <?= $citizen['gender'] ?></p>
            <p><strong>Region:</strong> <?= $citizen['region'] ?></p>
            <p><strong>Kebele:</strong> <?= $citizen['kebele'] ?></p>
            <p><img src="../assets/photos/<?= $citizen['photo'] ?>" width="140"></p>

            <a class="button" href="report.php?fayida_number=<?= $fayida_number ?>" target="_blank">
                📄 Download Report (PDF)
            </a>
        </div>

        <hr>
        <h3>Criminal Records</h3>

        <?php if (count($records) === 0): ?>
            <p class="success">No criminal records found.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Type</th><th>Case Ref</th><th>Date</th><th>Status</th><th>Notes</th>
                    <?php if ($role === 'editor'): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= $r['crime_type'] ?></td>
                        <td><?= $r['case_reference'] ?></td>
                        <td><?= $r['conviction_date'] ?></td>
                        <td><?= $r['status'] ?></td>
                        <td><?= $r['notes'] ?></td>
                        <?php if ($role === 'editor'): ?>
                            <td><a class="button" href="edit_record.php?id=<?= $r['record_id'] ?>">Edit</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php if ($role === 'editor'): ?>
            <hr>
            <h4>Add New Criminal Record</h4>
            <form method="POST" action="insert_record.php" class="form-block">
                <input type="hidden" name="fayida_number" value="<?= $fayida_number ?>">

                <label>Type:</label>
                <input type="text" name="crime_type" required>

                <label>Case Ref:</label>
                <input type="text" name="case_reference" required>

                <label>Date:</label>
                <input type="date" name="conviction_date" required>

                <label>Status:</label>
                <select name="status">
                    <option value="active">Active</option>
                    <option value="closed">Closed</option>
                </select>

                <label>Notes:</label>
                <textarea name="notes"></textarea>

                <button type="submit">➕ Insert Record</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <p class="error">No citizen found with that Fayida number.</p>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
