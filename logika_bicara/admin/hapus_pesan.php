<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_GET['id'];

$stmt=$conn->prepare("
DELETE FROM pesan_kontak
WHERE id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location:pesan_kontak.php");
?>