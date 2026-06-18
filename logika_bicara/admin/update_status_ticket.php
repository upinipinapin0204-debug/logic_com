<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$ticket_id=$_POST['ticket_id'];
$status=$_POST['status'];

$stmt=$conn->prepare("
UPDATE ticket
SET status=?
WHERE id=?
");

$stmt->bind_param("si",$status,$ticket_id);
$stmt->execute();

header("Location:ticket_chat.php?id=".$ticket_id);
exit;
?>