<?php
include("../config/role_client.php");
include("../config/koneksi.php");

if(!isset($_GET['id'])){
header("Location:notifikasi.php");
exit;
}

$id=$_GET['id'];
$user_id=$_SESSION['id'];

$stmt=$conn->prepare("
SELECT *
FROM notifications
WHERE id=?
AND user_id=?
AND role_target='client'
");

$stmt->bind_param(
"ii",
$id,
$user_id
);

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
");

$stmtUpdate->bind_param("i",$id);
$stmtUpdate->execute();

$link=$notif['link'];

$link=str_replace("../client/","",$link);
$link=str_replace("client/","",$link);

if(empty($link)){
$link="notifikasi.php";
}

header("Location:".$link);
exit;
?>