<?php
include("../config/koneksi.php");

$nama = $_POST['nama'];
$email = $_POST['email'];
$role = $_POST['role'];

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("
INSERT INTO users (nama, email, password, role)
VALUES (?, ?, ?, ?)
");

$stmt->bind_param("ssss", $nama, $email, $password, $role);

$stmt->execute();

header("Location: users.php");
?>