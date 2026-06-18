<?php
include("../config/role_client.php");
include("../config/koneksi.php");

$project_id=$_GET['id'];
$client_id=$_SESSION['id'];

$stmt=$conn->prepare("
UPDATE project
SET approval_status='approved',
approved_at=NOW()
WHERE id=?
AND client_id=?
AND status='done'
");

$stmt->bind_param(
"ii",
$project_id,
$client_id
);

$stmt->execute();

header("Location:dashboard.php");
?>