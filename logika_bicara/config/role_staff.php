<?php

include("auth.php");

if(
$_SESSION['role']!="staff"
){

header(
"Location:../login/login.php"
);

exit();

}
?>