<?php

include("../config/koneksi.php");

$id=$_GET['id'];

$stmt=$conn->prepare(

"DELETE FROM layanan
WHERE id=?"

);

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

header(
"Location:layanan.php"
);

?>