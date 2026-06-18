<?php
include("../config/koneksi.php");

$id = $_POST['id'];
$balasan = $_POST['balasan'];
$status = $_POST['status'];

$stmt = $conn->prepare("
UPDATE ticket
SET balasan=?, status=?
WHERE id=?
");

$stmt->bind_param("ssi", $balasan, $status, $id);

$stmt->execute();

header("Location: ticket.php");
?>