<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$judul=$_POST['judul'];
$tanggal=$_POST['tanggal'];
$isi=$_POST['isi'];

$gambar=null;

if(isset($_FILES['gambar']) && $_FILES['gambar']['error']==0){

$folder="../uploads/artikel/";
$nama_file=time()."_".$_FILES['gambar']['name'];
$tmp=$_FILES['gambar']['tmp_name'];

if(move_uploaded_file($tmp,$folder.$nama_file)){
$gambar=$nama_file;
}

}

$stmt=$conn->prepare("
INSERT INTO artikel
(judul,tanggal,isi,gambar)
VALUES(?,?,?,?)
");

$stmt->bind_param(
"ssss",
$judul,
$tanggal,
$isi,
$gambar
);

$stmt->execute();

header("Location:artikel.php");
?>