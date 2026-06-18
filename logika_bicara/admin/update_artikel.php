<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id=$_POST['id'];
$judul=$_POST['judul'];
$tanggal=$_POST['tanggal'];
$isi=$_POST['isi'];
$gambar_lama=$_POST['gambar_lama'];

$gambar=$gambar_lama;

// hapus gambar lama
if(isset($_POST['hapus_gambar'])){

if(!empty($gambar_lama) && file_exists("../uploads/artikel/".$gambar_lama)){
unlink("../uploads/artikel/".$gambar_lama);
}

$gambar=null;

}

// upload gambar baru
if(isset($_FILES['gambar']) && $_FILES['gambar']['error']==0){

if(!empty($gambar_lama) && file_exists("../uploads/artikel/".$gambar_lama)){
unlink("../uploads/artikel/".$gambar_lama);
}

$folder="../uploads/artikel/";
$nama_file=time()."_".$_FILES['gambar']['name'];
$tmp=$_FILES['gambar']['tmp_name'];

if(move_uploaded_file($tmp,$folder.$nama_file)){
$gambar=$nama_file;
}

}

$stmt=$conn->prepare("
UPDATE artikel
SET judul=?, tanggal=?, isi=?, gambar=?
WHERE id=?
");

$stmt->bind_param(
"ssssi",
$judul,
$tanggal,
$isi,
$gambar,
$id
);

$stmt->execute();

header("Location:artikel.php");
?>