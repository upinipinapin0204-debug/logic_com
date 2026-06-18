<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_POST['id'];
$nama_project=$_POST['nama_project'];
$client_id=$_POST['client_id'];
$status=$_POST['status'];
$approval_status=$_POST['approval_status'];
$deskripsi=$_POST['deskripsi'];

if($approval_status=="approved"){
$stmt=$conn->prepare("
UPDATE project
SET
nama_project=?,
client_id=?,
status=?,
approval_status=?,
approved_at=IF(approved_at IS NULL, NOW(), approved_at),
deskripsi=?
WHERE id=?
");

$stmt->bind_param(
"sisssi",
$nama_project,
$client_id,
$status,
$approval_status,
$deskripsi,
$id
);

}else{

$stmt=$conn->prepare("
UPDATE project
SET
nama_project=?,
client_id=?,
status=?,
approval_status=?,
approved_at=NULL,
deskripsi=?
WHERE id=?
");

$stmt->bind_param(
"sisssi",
$nama_project,
$client_id,
$status,
$approval_status,
$deskripsi,
$id
);

}

$stmt->execute();

header("Location:project.php");
?>