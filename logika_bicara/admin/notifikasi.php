<?php

include("../config/role_admin.php");
include("../config/koneksi.php");

$data=mysqli_query($conn,"
SELECT * FROM notifications
WHERE role_target='admin'
ORDER BY id DESC
");

$notifTicket=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM ticket
WHERE status='open'
")
);

$notifAdmin=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM notifications
WHERE role_target='admin'
AND is_read=0
")
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Notifikasi Admin</title>

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

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:24px;
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
border-bottom:1px solid #203244;
color:#8ea3b8;
}

.table-dark-custom td{
padding:14px;
border-bottom:1px solid #162534;
vertical-align:middle;
}

.badge-unread{
background:#dc3545;
padding:7px 12px;
border-radius:20px;
}

.badge-read{
background:#198754;
padding:7px 12px;
border-radius:20px;
}

.btn-green{
background:#a6ff4d;
border:none;
color:#06101a;
font-weight:700;
border-radius:10px;
padding:8px 15px;
text-decoration:none;
}

.btn-green:hover{
background:#91e443;
color:#06101a;
}

.btn-dark-custom{
background:#172635;
border:1px solid #22384c;
color:white;
border-radius:10px;
padding:8px 15px;
text-decoration:none;
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
<div class="tag">Admin Workspace</div>

<a href="dashboard.php">
<span>📊 Dashboard</span>
</a>

<a href="layanan.php">
<span>🛠 Layanan</span>
</a>

<a href="project.php">
<span>📁 Project</span>
</a>

<a href="users.php">
<span>👤 Users</span>
</a>

<a href="ticket.php">

<span>🎫 Ticket Support</span>

<?php if($notifTicket['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifTicket['total']; ?>
</span>
<?php } ?>

</a>

<a href="pesan_kontak.php">
<span>📩 Pesan Kontak</span>
</a>

<a href="konten.php">
<span>🌐 Konten Publik</span>
</a>

<a href="artikel.php">
<span>📰 Artikel</span>
</a>

<a href="report.php">
<span>📄 Reports</span>
</a>

<a href="notifikasi.php" class="active">

<span>🔔 Notifikasi</span>

<?php if($notifAdmin['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifAdmin['total']; ?>
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
<h2>Notifikasi Admin</h2>
<p class="text-soft mb-0">
Seluruh aktivitas sistem dan pemberitahuan admin.
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
<strong><?= $row['judul']; ?></strong>
</td>

<td>
<?= $row['pesan']; ?>
</td>

<td>

<?php if($row['is_read']==0){ ?>

<span class="badge-unread">
Belum Dibaca
</span>

<?php } else { ?>

<span class="badge-read">
Sudah Dibaca
</span>

<?php } ?>

</td>

<td>
<?= $row['created_at']; ?>
</td>

<td>

<a
href="baca_notifikasi.php?id=<?= $row['id']; ?>&link=<?= urlencode($row['link']); ?>"
class="btn-green">

Buka

</a>

</td>

</tr>

<?php } ?>

</table>

<div class="mt-4">

<a href="dashboard.php" class="btn-dark-custom">
← Kembali ke Dashboard
</a>

</div>

</div>

</div>

</body>
</html>