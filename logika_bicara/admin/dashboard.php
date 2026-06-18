<?php

include("../config/role_admin.php");
include("../config/koneksi.php");

$user = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM users")
);

$project = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM project")
);

$layanan = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM layanan")
);

$pesan = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM pesan_kontak")
);

$notif = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM ticket
WHERE status='open'
")
);

$notifAdmin = mysqli_fetch_assoc(
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

<title>Admin Dashboard</title>

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
margin-bottom:25px;
}

.topbar h2{
font-weight:800;
margin-bottom:5px;
}

.text-soft{
color:#8ea3b8;
}

.metric-card{
background:#102131;
border:1px solid #22384c;
border-radius:16px;
padding:22px;
height:100%;
transition:.25s;
}

.metric-card:hover{
transform:translateY(-4px);
border-color:#a6ff4d;
}

.metric-card small{
color:#9fb2c5;
font-size:14px;
}

.metric-card h2{
font-size:38px;
font-weight:800;
margin-top:10px;
margin-bottom:0;
}

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:24px;
margin-top:20px;
}

.quick-link{
display:inline-block;
background:#172635;
color:white;
text-decoration:none;
padding:10px 16px;
border-radius:10px;
margin-right:10px;
margin-top:10px;
}

.quick-link:hover{
background:#22384c;
color:white;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">PT Logika Bicara</div>
<div class="tag">Admin Workspace</div>

<a href="dashboard.php" class="active">
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

<?php if($notif['total']>0){ ?>
<span class="badge bg-danger">
<?= $notif['total']; ?>
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

<a href="notifikasi.php">

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

<h2>Dashboard Admin</h2>

<p class="text-soft">
Selamat datang kembali, <?= $_SESSION['nama']; ?>
</p>

</div>

<div class="row g-3">

<div class="col-md-3">

<div class="metric-card">

<small>Total User</small>

<h2>
<?= $user['total']; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="metric-card">

<small>Total Project</small>

<h2>
<?= $project['total']; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="metric-card">

<small>Total Layanan</small>

<h2>
<?= $layanan['total']; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="metric-card">

<small>Pesan Kontak</small>

<h2>
<?= $pesan['total']; ?>
</h2>

</div>

</div>

</div>

<div class="panel">

<h4>Menu Cepat</h4>

<p class="text-soft">
Akses fitur yang paling sering digunakan.
</p>

<a href="project.php" class="quick-link">
📁 Kelola Project
</a>

<a href="ticket.php" class="quick-link">
🎫 Ticket Support
</a>

<a href="users.php" class="quick-link">
👤 Kelola User
</a>

<a href="artikel.php" class="quick-link">
📰 Kelola Artikel
</a>

<a href="report.php" class="quick-link">
📄 Laporan Sistem
</a>

</div>

</div>

</body>
</html>