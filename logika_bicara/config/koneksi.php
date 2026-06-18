<?php

$host="localhost";
$user="root";
$password="";
$database="logika_bicara";

$conn=mysqli_connect(
$host,
$user,
$password,
$database
);

if(!$conn){

die("Koneksi gagal");
}

?>