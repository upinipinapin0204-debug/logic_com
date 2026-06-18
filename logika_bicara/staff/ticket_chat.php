<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$ticket_id = $_GET['id'];

$stmt=$conn->prepare("
SELECT ticket.*, users.nama AS client
FROM ticket
LEFT JOIN users ON ticket.client_id=users.id
WHERE ticket.id=?
");

$stmt->bind_param("i",$ticket_id);
$stmt->execute();

$result=$stmt->get_result();
$ticket=$result->fetch_assoc();

if(!$ticket){
echo "Ticket tidak ditemukan.";
exit;
}

$chat = mysqli_query($conn,"
SELECT * FROM ticket_chat
WHERE ticket_id='$ticket_id'
ORDER BY id ASC
");

$notifStaff = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM notifications
WHERE role_target='staff'
AND is_read=0
")
);

$notifTicket = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM ticket
WHERE status='open'
")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Staff Chat</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Arial,sans-serif;
background:#07111b;
color:#e5edf5;
}

.sidebar{
width:240px;
height:100vh;
position:fixed;
left:0;
top:0;
background:#06101a;
border-right:1px solid #172635;
padding:24px 18px;
}

.logo{
font-size:22px;
font-weight:800;
color:#b8ff5c;
margin-bottom:6px;
}

.tag{
font-size:12px;
color:#8ea3b8;
margin-bottom:35px;
}

.sidebar a{
display:flex;
justify-content:space-between;
align-items:center;
padding:12px 14px;
margin-bottom:8px;
border-radius:10px;
text-decoration:none;
color:#b8c7d6;
font-weight:600;
}

.sidebar a:hover,
.sidebar a.active{
background:#112131;
color:white;
border-left:4px solid #a6ff4d;
}

.main{
margin-left:240px;
padding:24px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:22px;
}

.topbar h2{
font-weight:800;
margin:0;
}

.text-soft{
color:#8ea3b8;
}

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:20px;
margin-bottom:18px;
}

.ticket-info{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:16px;
margin-bottom:18px;
}

.chat-box{
height:430px;
overflow-y:auto;
background:#07111b;
border:1px solid #203244;
padding:18px;
border-radius:16px;
margin-bottom:15px;
}

.msg{
padding:12px 15px;
margin-bottom:12px;
border-radius:14px;
max-width:70%;
word-wrap:break-word;
font-size:14px;
}

.client{
background:#172635;
color:#e5edf5;
}

.staff,
.admin{
background:#a6ff4d;
color:#06101a;
margin-left:auto;
}

.msg small{
font-size:11px;
opacity:.75;
}

.form-control{
background:#07111b;
border:1px solid #26394d;
color:white;
border-radius:12px;
padding:12px;
}

.form-control:focus{
background:#07111b;
color:white;
border-color:#a6ff4d;
box-shadow:none;
}

.form-control::placeholder{
color:#8ea3b8;
}

.btn-green{
background:#a6ff4d;
color:#06101a;
font-weight:800;
border:none;
border-radius:10px;
padding:10px 18px;
text-decoration:none;
display:inline-block;
}

.btn-green:hover{
background:#90e63f;
color:#06101a;
}

.btn-dark-custom{
background:#172635;
color:white;
border:1px solid #2b4054;
border-radius:10px;
padding:10px 18px;
text-decoration:none;
display:inline-block;
}

.btn-dark-custom:hover{
background:#22384c;
color:white;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">PT Logika Bicara</div>
<div class="tag">Staff Workspace</div>

<a href="dashboard.php">
<span>📊 Dashboard</span>
</a>

<a href="ticket.php" class="active">
<span>🎫 Ticket Support</span>

<?php if($notifTicket['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifTicket['total']; ?>
</span>
<?php } ?>

</a>

<a href="project.php">
<span>📁 Project</span>
</a>

<a href="notifikasi.php">
<span>🔔 Notifikasi</span>

<?php if($notifStaff['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifStaff['total']; ?>
</span>
<?php } ?>

</a>

<a href="../login/logout.php">
<span>🚪 Logout</span>
</a>

</div>

<div class="main">

<div class="topbar">

<div>
<h2>Staff Chat Ticket</h2>
<p class="text-soft mb-0">Balas percakapan support client.</p>
</div>

<a href="ticket.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<h4><?= $ticket['judul']; ?></h4>

<div class="ticket-info">

<p class="mb-1">
Client: <strong><?= $ticket['client']; ?></strong>
</p>

<p class="mb-1">
Status:
<?php
if($ticket['status']=="open"){
echo '<span class="badge bg-danger">Open</span>';
}
elseif($ticket['status']=="process"){
echo '<span class="badge bg-warning text-dark">Process</span>';
}
else{
echo '<span class="badge bg-success">Closed</span>';
}
?>
</p>

<p class="mb-0">
Tanggal: <?= $ticket['created_at']; ?>
</p>

<?php if(!empty($ticket['attachment'])){ ?>

<a href="../uploads/ticket/<?= $ticket['attachment']; ?>" target="_blank" class="btn-dark-custom mt-3">
Download Attachment
</a>

<?php } ?>

</div>

<div class="chat-box">

<div class="msg client">

<?= $ticket['pesan']; ?>

<br>

<small>
client - <?= $ticket['created_at']; ?>
</small>

</div>

<?php while($row=mysqli_fetch_assoc($chat)){ ?>

<div class="msg <?= $row['sender_role']; ?>">

<?= $row['message']; ?>

<br>

<small>
<?= $row['sender_role']; ?> - <?= $row['created_at']; ?>
</small>

</div>

<?php } ?>

</div>

<form action="send_chat.php" method="POST">

<input type="hidden" name="ticket_id" value="<?= $ticket_id; ?>">

<textarea name="message" class="form-control mb-3" rows="3" placeholder="Tulis balasan..." required></textarea>

<button class="btn-green">
Balas
</button>

</form>

</div>

</div>

</body>

</html>