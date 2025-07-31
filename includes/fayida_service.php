<?php
// Simulate fetching citizen data using Fayida number
function getCitizenByFayida($conn, $fayida_number) {
    $stmt = $conn->prepare("SELECT * FROM fayida_citizens WHERE fayida_number = ?");
    $stmt->bind_param("s", $fayida_number);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
