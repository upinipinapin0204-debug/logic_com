<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_GET['id'];
$link=urldecode($_GET['link']);

$stmt=$conn->prepare("
UPDATE notifications
SET is_read=1
WHERE id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location:".$link);
?>