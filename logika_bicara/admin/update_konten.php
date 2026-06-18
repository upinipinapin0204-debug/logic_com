<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_POST['id'];
$nama_perusahaan=$_POST['nama_perusahaan'];
$tagline=$_POST['tagline'];
$tentang=$_POST['tentang'];
$email=$_POST['email'];
$telepon=$_POST['telepon'];
$alamat=$_POST['alamat'];

$stmt=$conn->prepare("
UPDATE konten_website
SET
nama_perusahaan=?,
tagline=?,
tentang=?,
email=?,
telepon=?,
alamat=?
WHERE id=?
");

$stmt->bind_param(
"ssssssi",
$nama_perusahaan,
$tagline,
$tentang,
$email,
$telepon,
$alamat,
$id
);

$stmt->execute();

header("Location:konten.php");
?>