<?php
include("../config/koneksi.php");
session_start();

$ticket_id = $_POST['ticket_id'];
$message = $_POST['message'];

$stmt = $conn->prepare("
INSERT INTO ticket_chat (ticket_id, sender_role, message)
VALUES (?, 'client', ?)
");

$stmt->bind_param("is", $ticket_id, $message);

$stmt->execute();

header("Location: ticket_chat.php?id=".$ticket_id);
?>