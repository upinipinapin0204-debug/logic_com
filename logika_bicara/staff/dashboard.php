<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

// Hitung total ticket
$ticket = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM ticket")
);

// Hitung total project
$project = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) as total FROM project")
);

// Badge ticket open
$notifTicket = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM ticket
WHERE status='open'
")
);

// Badge notifikasi staff
$notifStaff = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM notifications
WHERE role_target='staff'
AND is_read=0
")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Staff Dashboard</title>

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
padding:10px 18px;
text-decoration:none;
display:inline-block;
}

.btn-dark-custom:hover{
background:#22384c;
color:white;
}

.metric-card{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:20px;
height:100%;
transition:.2s;
}

.metric-card:hover{
transform:translateY(-4px);
border-color:#a6ff4d;
}

.metric-card small{
color:#9fb2c5;
}

.metric-card h2{
font-weight:800;
margin-top:8px;
color:white;
}

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:20px;
margin-bottom:18px;
}

.activity-item{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:16px;
margin-bottom:12px;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">PT Logika Bicara</div>
<div class="tag">Staff Workspace</div>

<a href="dashboard.php" class="active">
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
<h2>Staff Dashboard</h2>
<p class="text-soft mb-0">
Selamat datang, <?= $_SESSION['nama']; ?> | Role: <?= $_SESSION['role']; ?>
</p>
</div>

<a href="ticket.php" class="btn-green">
Kelola Ticket
</a>

</div>

<div class="row g-3 mb-4">

<div class="col-md-4">

<div class="metric-card">

<small>Total Ticket</small>

<h2>
<?= $ticket['total']; ?>
</h2>

<p class="text-soft mb-0">
Seluruh ticket client yang masuk.
</p>

</div>

</div>

<div class="col-md-4">

<div class="metric-card">

<small>Total Project</small>

<h2>
<?= $project['total']; ?>
</h2>

<p class="text-soft mb-0">
Project yang dapat dimonitor staff.
</p>

</div>

</div>

<div class="col-md-4">

<div class="metric-card">

<small>Ticket Open</small>

<h2>
<?= $notifTicket['total']; ?>
</h2>

<p class="text-soft mb-0">
Ticket yang perlu segera ditangani.
</p>

</div>

</div>

</div>

<div class="panel">

<h4>Aktivitas Staff</h4>

<p class="text-soft">
Kelola ticket client, balas percakapan support, update status project, dan monitor progress project perusahaan.
</p>

<div class="row">

<div class="col-md-4">
<div class="activity-item">
<h6>🎫 Ticket Support</h6>
<p class="text-soft mb-3">Lihat dan balas ticket dari client.</p>
<a href="ticket.php" class="btn-dark-custom">Buka Ticket</a>
</div>
</div>

<div class="col-md-4">
<div class="activity-item">
<h6>📁 Project</h6>
<p class="text-soft mb-3">Update status dan timeline project.</p>
<a href="project.php" class="btn-dark-custom">Buka Project</a>
</div>
</div>

<div class="col-md-4">
<div class="activity-item">
<h6>🔔 Notifikasi</h6>
<p class="text-soft mb-3">Lihat notifikasi terbaru untuk staff.</p>
<a href="notifikasi.php" class="btn-dark-custom">Buka Notifikasi</a>
</div>
</div>

</div>

</div>

</div>

</body>

</html>