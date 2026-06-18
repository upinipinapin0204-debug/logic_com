<?php
include("../config/role_client.php");
include("../config/koneksi.php");

$id = $_SESSION['id'];

$notif=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM notifications
WHERE role_target='client'
AND user_id='$id'
AND is_read=0
")
);

$data = mysqli_query($conn,"
SELECT * FROM ticket
WHERE client_id='$id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Ticket Support</title>

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
padding:7px 12px;
text-decoration:none;
font-size:13px;
}

.btn-dark-custom:hover{
background:#22384c;
color:white;
}

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:20px;
margin-bottom:18px;
}

.table-dark-custom{
width:100%;
color:#dce8f4;
}

.table-dark-custom th{
color:#9fb2c5;
font-size:13px;
padding:14px 12px;
border-bottom:1px solid #203244;
}

.table-dark-custom td{
padding:14px 12px;
border-bottom:1px solid #132332;
font-size:14px;
vertical-align:middle;
}

.empty-box{
background:#102131;
border:1px dashed #34495e;
border-radius:14px;
padding:22px;
color:#9fb2c5;
}

.message-limit{
max-width:280px;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">PT Logika Bicara</div>
<div class="tag">Client Workspace</div>

<a href="dashboard.php">
<span>📊 Dashboard</span>
</a>

<a href="ticket.php" class="active">
<span>🎫 Ticket Support</span>
</a>

<a href="notifikasi.php">
<span>🔔 Notifikasi</span>

<?php if($notif['total']>0){ ?>
<span class="badge bg-danger">
<?= $notif['total']; ?>
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
<h2>Ticket Support</h2>
<p class="text-soft mb-0">Kelola percakapan support dan laporan kendala Anda.</p>
</div>

<a href="buat_ticket.php" class="btn-green">
+ Buat Ticket
</a>

</div>

<div class="panel">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h4 class="mb-1">Daftar Ticket</h4>
<p class="text-soft mb-0">Pantau status ticket, lampiran, dan buka chat dengan tim.</p>
</div>

<a href="dashboard.php" class="btn-dark-custom">
Kembali
</a>

</div>

<?php if(mysqli_num_rows($data)>0){ ?>

<table class="table-dark-custom">

<tr>
<th>Judul</th>
<th>Status</th>
<th>Pesan</th>
<th>Balasan</th>
<th>File</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)) { ?>

<tr>

<td>
<?= $row['judul']; ?>
</td>

<td>
<?php
if($row['status']=="open"){
echo '<span class="badge bg-danger">Open</span>';
}
elseif($row['status']=="process"){
echo '<span class="badge bg-warning text-dark">Process</span>';
}
else{
echo '<span class="badge bg-success">Closed</span>';
}
?>
</td>

<td class="message-limit">
<?= $row['pesan']; ?>
</td>

<td class="message-limit">
<?= !empty($row['balasan']) ? $row['balasan'] : '-'; ?>
</td>

<td>
<?php if(!empty($row['attachment'])){ ?>

<a href="../uploads/ticket/<?= $row['attachment']; ?>" target="_blank" class="btn-dark-custom">
Download
</a>

<?php } else { ?>

<span class="text-soft">-</span>

<?php } ?>
</td>

<td>
<a href="ticket_chat.php?id=<?= $row['id']; ?>" class="btn-green">
Buka Chat
</a>
</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="empty-box">
Belum ada ticket yang dibuat.
</div>

<?php } ?>

</div>

</div>

</body>

</html>