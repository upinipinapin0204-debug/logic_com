<?php

include("../config/role_staff.php");
include("../config/koneksi.php");

$id=$_POST['id'];
$status=$_POST['status'];

$stmt=$conn->prepare("
UPDATE project
SET status=?
WHERE id=?
");

$stmt->bind_param(
"si",
$status,
$id
);

$stmt->execute();

header(
"Location:project.php"
);

?>