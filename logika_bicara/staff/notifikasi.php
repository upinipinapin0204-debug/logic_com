<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$data=mysqli_query($conn,"
SELECT * FROM notifications
WHERE role_target='staff'
ORDER BY id DESC
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

<title>Notifikasi Staff</title>

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

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:20px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.topbar h2{
font-weight:800;
margin:0;
}

.text-soft{
color:#8ea3b8;
}

.table-dark-custom{
width:100%;
color:#dce8f4;
}

.table-dark-custom th{
padding:14px;
font-size:13px;
color:#9fb2c5;
border-bottom:1px solid #203244;
}

.table-dark-custom td{
padding:14px;
border-bottom:1px solid #132332;
vertical-align:middle;
}

.btn-open{
background:#a6ff4d;
color:#06101a;
font-weight:700;
padding:8px 14px;
border-radius:10px;
text-decoration:none;
}

.btn-open:hover{
background:#90e63f;
color:#06101a;
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

<a href="ticket.php">
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

<a href="notifikasi.php" class="active">
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
<h2>Notifikasi Staff</h2>
<p class="text-soft mb-0">
Semua aktivitas dan pemberitahuan yang masuk untuk staff.
</p>
</div>

</div>

<div class="panel">

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

<td>
<?= $row['pesan']; ?>
</td>

<td>

<?php if($row['is_read']==0){ ?>

<span class="badge bg-danger">
Belum Dibaca
</span>

<?php } else { ?>

<span class="badge bg-success">
Sudah Dibaca
</span>

<?php } ?>

</td>

<td>
<?= $row['created_at']; ?>
</td>

<td>

<a href="baca_notifikasi.php?id=<?= $row['id']; ?>"
class="btn-open">
Buka
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>