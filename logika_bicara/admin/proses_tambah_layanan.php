<?php

include("../config/koneksi.php");

$judul=$_POST['judul'];

$deskripsi=$_POST['deskripsi'];

$stmt=$conn->prepare(

"INSERT INTO layanan(
judul,
deskripsi
)

VALUES(
?,
?
)"

);

$stmt->bind_param(

"ss",

$judul,
$deskripsi

);

$stmt->execute();

header(
"Location:layanan.php"
);

?>