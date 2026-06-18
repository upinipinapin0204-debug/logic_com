<?php

include("../config/koneksi.php");

$data=mysqli_query(

$conn,

"SELECT * FROM layanan"

);

?>

<!DOCTYPE html>

<html>

<head>

<title>

Layanan

</title>

<link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h1>

Layanan Kami

</h1>

<div class="row">

<?php

while(
$row=mysqli_fetch_array(
$data
)
){

?>

<div class="col-md-4">

<div class="card p-3 mb-3">

<h3>

<?=$row['judul'];?>

</h3>

<p>

<?=$row['deskripsi'];?>

</p>

</div>

</div>

<?php } ?>

</div>

</div>

</body>

</html>