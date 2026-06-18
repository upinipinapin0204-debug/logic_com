<?php

include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_POST['id'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$role=$_POST['role'];
$password=$_POST['password'];

if($password!=""){

$password_hash=password_hash($password,PASSWORD_DEFAULT);

$stmt=$conn->prepare("
UPDATE users
SET nama=?, email=?, password=?, role=?
WHERE id=?
");

$stmt->bind_param(
"ssssi",
$nama,
$email,
$password_hash,
$role,
$id
);

}else{

$stmt=$conn->prepare("
UPDATE users
SET nama=?, email=?, role=?
WHERE id=?
");

$stmt->bind_param(
"sssi",
$nama,
$email,
$role,
$id
);

}

$stmt->execute();

header("Location:users.php");
exit;
?>