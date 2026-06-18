<?php

session_start();
include("../config/koneksi.php");

$email=$_POST['email'];
$password=$_POST['password'];

$stmt=$conn->prepare(
"SELECT * FROM users WHERE email=?"
);

$stmt->bind_param(
"s",
$email
);

$stmt->execute();

$result=$stmt->get_result();

if($result->num_rows>0){

$data=$result->fetch_assoc();

if(
password_verify(
$password,
$data['password']
)
){

$_SESSION['id']=$data['id'];
$_SESSION['nama']=$data['nama'];
$_SESSION['role']=$data['role'];

switch($data['role']){

case 'admin':

header(
"Location:../admin/dashboard.php"
);

break;

case 'staff':

header(
"Location:../staff/dashboard.php"
);

break;

case 'client':

header(
"Location:../client/dashboard.php"
);

break;

}

}else{

echo "Password salah";

}

}else{

echo "Email tidak ditemukan";

}
?>