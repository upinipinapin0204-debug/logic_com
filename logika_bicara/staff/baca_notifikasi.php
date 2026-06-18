<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

if(!isset($_GET['id'])){
header("Location:notifikasi.php");
exit;
}

$id=$_GET['id'];

$stmt=$conn->prepare("
SELECT * FROM notifications
WHERE id=?
AND role_target='staff'
");

$stmt->bind_param("i",$id);
$stmt->execute();

$result=$stmt->get_result();
$notif=$result->fetch_assoc();

if(!$notif){
header("Location:notifikasi.php");
exit;
}

$stmtUpdate=$conn->prepare("
UPDATE notifications
SET is_read=1
WHERE id=?
AND role_target='staff'
");

$stmtUpdate->bind_param("i",$id);
$stmtUpdate->execute();

$link=$notif['link'];

$link=str_replace("../staff/","",$link);
$link=str_replace("staff/","",$link);

if(empty($link)){
$link="notifikasi.php";
}

header("Location:".$link);
exit;
?>