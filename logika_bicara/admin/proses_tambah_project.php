<?php
include("../config/koneksi.php");

$nama_project = $_POST['nama_project'];
$client_id = $_POST['client_id'];
$status = $_POST['status'];
$deskripsi = $_POST['deskripsi'];

$stmt = $conn->prepare("
INSERT INTO project (nama_project, client_id, status, deskripsi)
VALUES (?, ?, ?, ?)
");

$stmt->bind_param("siss", $nama_project, $client_id, $status, $deskripsi);

$stmt->execute();

header("Location: project.php");
?>