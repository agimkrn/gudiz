<?php
require 'includes/koneksi.php';

header('Content-Type: application/json');

if(empty($_GET['part_number'])) {
    die(json_encode(['error' => 'Parameter tidak valid']));
}

$partNumber = $conn->real_escape_string($_GET['part_number']);

$query = "SELECT part_number FROM barang WHERE part_number = '$partNumber'";
$result = $conn->query($query);

echo json_encode([
    'exists' => $result->num_rows > 0,
    'part_number' => $partNumber
]);

$conn->close();