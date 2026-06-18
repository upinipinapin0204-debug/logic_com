<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$project_id=$_POST['project_id'];
$judul_progress=$_POST['judul_progress'];
$deskripsi=$_POST['deskripsi'];
$persentase=$_POST['persentase'];

$stmt=$conn->prepare("
INSERT INTO project_progress
(project_id,judul_progress,deskripsi,persentase)
VALUES(?,?,?,?)
");

$stmt->bind_param(
"issi",
$project_id,
$judul_progress,
$deskripsi,
$persentase
);

$stmt->execute();

header("Location:progress_project.php?id=".$project_id);
?>