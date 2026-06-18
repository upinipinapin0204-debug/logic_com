<?php
include("config/koneksi.php");

$id=$_GET['id'];

$stmt=$conn->prepare("
SELECT * FROM artikel
WHERE id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

$data=$stmt->get_result();
$row=$data->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title><?= $row['judul']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f8fafc;
font-family:Arial,sans-serif;
}

.navbar{
background:#111827;
}

.article-box{
background:white;
padding:30px;
border-radius:14px;
box-shadow:0 3px 10px rgba(0,0,0,.06);
margin-top:40px;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<a href="index.php" class="navbar-brand">
PT Logika Bicara
</a>

</div>

</nav>

<div class="container">

<div class="article-box">

<h2>
<?= $row['judul']; ?>
</h2>

<p class="text-muted">
Tanggal: <?= $row['tanggal']; ?>
</p>

<?php if($row['gambar']){ ?>

<img src="uploads/artikel/<?= $row['gambar']; ?>" class="img-fluid mb-4" style="border-radius:12px;max-height:400px;width:100%;object-fit:cover;">

<?php } ?>

<hr>

<p>
<?= nl2br($row['isi']); ?>
</p>

<a href="index.php#artikel" class="btn btn-secondary mt-3">
Kembali
</a>

</div>

</div>

</body>

</html>