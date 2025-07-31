<?php
// Fetch criminal records linked to a Fayida number
function getCriminalRecords($conn, $fayida_number) {
    $stmt = $conn->prepare("SELECT * FROM criminal_records WHERE fayida_number = ?");
    $stmt->bind_param("s", $fayida_number);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
