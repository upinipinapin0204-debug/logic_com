<?php

include("auth.php");

if(
$_SESSION['role']!="admin"
){

header(
"Location:../login/login.php"
);

exit();

}
?>