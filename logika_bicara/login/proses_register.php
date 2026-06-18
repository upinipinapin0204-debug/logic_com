<?php

include("../config/koneksi.php");

$nama=$_POST['nama'];

$email=$_POST['email'];

$password=password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$role=$_POST['role'];

$query=mysqli_query(

$conn,

"INSERT INTO users(
nama,
email,
password,
role
)

VALUES(

'$nama',
'$email',
'$password',
'$role'

)"

);

if($query){

header(
"Location:login.php"
);

}

?>