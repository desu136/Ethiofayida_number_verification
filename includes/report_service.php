<?php
require_once '../includes/auth.php';
require_once '../includes/fayida_service.php';
require_once '../includes/criminal_service.php';


if (!isset($_GET['fayida_number'])) {
    die("No Fayida number.");
}

$fayida = $_GET['fayida_number'];
$citizen = getCitizenByFayida($conn, $fayida);
$records = getCriminalRecords($conn, $fayida);

// Output simple HTML (you can turn this into PDF using dompdf later)
header("Content-Type: text/html");

echo "<h2>Fayida Report</h2>";
echo "<p><strong>Fayida Number:</strong> $fayida</p>";
echo "<p><strong>Name:</strong> {$citizen['full_name']}</p>";
echo "<p><strong>DOB:</strong> {$citizen['date_of_birth']}</p>";
echo "<hr><h3>Criminal Records</h3>";

if (empty($records)) {
    echo "<p>No records found.</p>";
} else {
    echo "<ul>";
    foreach ($records as $r) {
        echo "<li>{$r['crime_type']} — {$r['case_reference']} ({$r['conviction_date']})</li>";
    }
    echo "</ul>";
}
?>
