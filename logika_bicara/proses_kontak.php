<?php
include("config/koneksi.php");

$nama=$_POST['nama'];
$email=$_POST['email'];
$pesan=$_POST['pesan'];

$stmt=$conn->prepare("
INSERT INTO pesan_kontak
(nama,email,pesan)
VALUES(?,?,?)
");

$stmt->bind_param(
"sss",
$nama,
$email,
$pesan
);

$stmt->execute();

header("Location:index.php?status=success#contact");
?>