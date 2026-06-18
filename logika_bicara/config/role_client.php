<?php

include("auth.php");

if(
$_SESSION['role']!="client"
){

header(
"Location:../login/login.php"
);

exit();

}
?>