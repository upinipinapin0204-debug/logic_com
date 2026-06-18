<?php

include("../config/koneksi.php");
session_start();

$client_id=$_SESSION['id'];
$judul=$_POST['judul'];
$pesan=$_POST['pesan'];

$attachment=null;

if(isset($_FILES['attachment']) && $_FILES['attachment']['error']==0){

$folder="../uploads/ticket/";

$nama_file=time()."_".$_FILES['attachment']['name'];
$tmp=$_FILES['attachment']['tmp_name'];

$path=$folder.$nama_file;

if(move_uploaded_file($tmp,$path)){
$attachment=$nama_file;
}

}

$stmt=$conn->prepare("
INSERT INTO ticket
(client_id,judul,pesan,attachment)
VALUES(?,?,?,?)
");

$stmt->bind_param(
"isss",
$client_id,
$judul,
$pesan,
$attachment
);

$stmt->execute();

// ambil id ticket terakhir
$ticket_id = $conn->insert_id;

// notifikasi untuk admin
$judul_notif = "Ticket Baru";
$pesan_notif = "Client membuat ticket baru: ".$judul;
$link_notif = "../admin/ticket_chat.php?id=".$ticket_id;

$stmtNotif=$conn->prepare("
INSERT INTO notifications
(role_target,judul,pesan,link)
VALUES('admin',?,?,?)
");

$stmtNotif->bind_param(
"sss",
$judul_notif,
$pesan_notif,
$link_notif
);

$stmtNotif->execute();

// notifikasi untuk staff
$link_staff = "../staff/ticket_chat.php?id=".$ticket_id;

$stmtNotif2=$conn->prepare("
INSERT INTO notifications
(role_target,judul,pesan,link)
VALUES('staff',?,?,?)
");

$stmtNotif2->bind_param(
"sss",
$judul_notif,
$pesan_notif,
$link_staff
);

$stmtNotif2->execute();

header("Location:ticket.php");

?>