<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

if(
!isset($_POST['ticket_id']) ||
!isset($_POST['message']) ||
trim($_POST['message'])==""
){
header("Location:ticket.php");
exit;
}

$ticket_id=$_POST['ticket_id'];
$message=trim($_POST['message']);

// simpan chat staff
$stmt=$conn->prepare("
INSERT INTO ticket_chat
(ticket_id,sender_role,message)
VALUES(?, 'staff', ?)
");

$stmt->bind_param(
"is",
$ticket_id,
$message
);

$stmt->execute();

// update status ticket menjadi process
$stmtStatus=$conn->prepare("
UPDATE ticket
SET status='process'
WHERE id=?
AND status!='closed'
");

$stmtStatus->bind_param(
"i",
$ticket_id
);

$stmtStatus->execute();

// ambil client pemilik ticket
$stmtTicket=$conn->prepare("
SELECT client_id
FROM ticket
WHERE id=?
");

$stmtTicket->bind_param(
"i",
$ticket_id
);

$stmtTicket->execute();

$resultTicket=$stmtTicket->get_result();

$ticket=$resultTicket->fetch_assoc();

if($ticket){

$client_id=$ticket['client_id'];

$judul_notif="Balasan Ticket";
$pesan_notif="Staff telah membalas ticket Anda.";
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

}

header("Location:ticket_chat.php?id=".$ticket_id);
exit;
?>