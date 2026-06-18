<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$ticket_id=$_POST['ticket_id'];
$message=$_POST['message'];
$status=$_POST['status'];

// simpan chat admin
$stmt=$conn->prepare("
INSERT INTO ticket_chat
(ticket_id,sender_role,message)
VALUES(?, 'admin', ?)
");

$stmt->bind_param(
"is",
$ticket_id,
$message
);

$stmt->execute();

// update status ticket
$stmt2=$conn->prepare("
UPDATE ticket
SET status=?
WHERE id=?
");

$stmt2->bind_param(
"si",
$status,
$ticket_id
);

$stmt2->execute();

// cari client pemilik ticket
$ticket=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT client_id FROM ticket WHERE id='$ticket_id'
")
);

$client_id=$ticket['client_id'];

$judul_notif="Balasan Ticket";
$pesan_notif="Admin telah membalas ticket Anda.";
$link_notif="project_timeline.php";

$link_notif="ticket_chat.php?id=".$ticket_id;

$stmtNotif=$conn->prepare("
INSERT INTO notifications
(user_id,role_target,judul,pesan,link)
VALUES(?, 'client', ?, ?, ?)
");

$stmtNotif->bind_param(
"isss",
$client_id,
$judul_notif,
$pesan_notif,
$link_notif
);

$stmtNotif->execute();

header("Location:ticket_chat.php?id=".$ticket_id);

?>