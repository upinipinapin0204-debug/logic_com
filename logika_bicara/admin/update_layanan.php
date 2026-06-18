<?php

include("../config/koneksi.php");

$id=$_POST['id'];

$judul=$_POST['judul'];

$deskripsi=$_POST['deskripsi'];

$stmt=$conn->prepare(

"UPDATE layanan

SET

judul=?,
deskripsi=?

WHERE id=?"

);

$stmt->bind_param(
"ssi",
$judul,
$deskripsi,
$id
);

$stmt->execute();

header(
"Location:layanan.php"
);

?>