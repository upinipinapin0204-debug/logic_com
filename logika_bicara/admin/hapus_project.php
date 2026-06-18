<?php
include("../config/koneksi.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM project WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: project.php");
?>