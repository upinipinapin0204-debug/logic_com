<?php
include("../config/role_client.php");
include("../config/koneksi.php");

$user_id=$_SESSION['id'];

$notifCount=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM notifications
WHERE role_target='client'
AND user_id='$user_id'
AND is_read=0
")
);

$data=mysqli_query($conn,"
SELECT * FROM notifications
WHERE role_target='client'
AND user_id='$user_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Notifikasi Client</title>

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
padding:8px 14px;
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
padding:8px 14px;
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
max-width:450px;
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

<a href="ticket.php">
<span>🎫 Ticket Support</span>
</a>

<a href="notifikasi.php" class="active">
<span>🔔 Notifikasi</span>

<?php if($notifCount['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifCount['total']; ?>
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
<h2>Notifikasi Client</h2>
<p class="text-soft mb-0">Daftar informasi terbaru dari ticket dan aktivitas project Anda.</p>
</div>

<a href="dashboard.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h4 class="mb-1">Daftar Notifikasi</h4>
<p class="text-soft mb-0">Klik buka untuk membaca detail dan menandai notifikasi sebagai sudah dibaca.</p>
</div>

<span class="badge bg-success">
<?= $notifCount['total']; ?> belum dibaca
</span>

</div>

<?php if(mysqli_num_rows($data)>0){ ?>

<table class="table-dark-custom">

<tr>
<th>Judul</th>
<th>Pesan</th>
<th>Status</th>
<th>Tanggal</th>
<th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= $row['judul']; ?>
</td>

<td class="message-limit">
<?= $row['pesan']; ?>
</td>

<td>
<?php if($row['is_read']==0){ ?>
<span class="badge bg-danger">Belum Dibaca</span>
<?php } else { ?>
<span class="badge bg-success">Sudah Dibaca</span>
<?php } ?>
</td>

<td>
<?= $row['created_at']; ?>
</td>

<td>
<a href="baca_notifikasi.php?id=<?= $row['id']; ?>" class="btn-green">
Buka
</a>
</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="empty-box">
Belum ada notifikasi.
</div>

<?php } ?>

</div>

</div>

</body>

</html>