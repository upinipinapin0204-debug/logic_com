<?php
include("../config/role_client.php");
include("../config/koneksi.php");

$id_user = $_SESSION['id'];

$notif=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM notifications
WHERE role_target='client'
AND user_id='$id_user'
AND is_read=0
")
);

$stmt = $conn->prepare("
SELECT * FROM project
WHERE client_id=?
ORDER BY id DESC
");

$stmt->bind_param("i", $id_user);
$stmt->execute();

$data = $stmt->get_result();
$totalProject = mysqli_num_rows($data);
$data->data_seek(0);
?>

<!DOCTYPE html>
<html>

<head>

<title>Client Dashboard</title>

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

.panel{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:20px;
margin-bottom:18px;
}

.metric-card{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:18px;
height:100%;
}

.metric-card small{
color:#9fb2c5;
}

.metric-card h2{
font-weight:800;
margin-top:8px;
color:white;
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

.badge-soft{
background:#203244;
color:#dce8f4;
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

.empty-box{
background:#102131;
border:1px dashed #34495e;
border-radius:14px;
padding:22px;
color:#9fb2c5;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">PT Logika Bicara</div>
<div class="tag">Client Workspace</div>

<a href="dashboard.php" class="active">
<span>📊 Dashboard</span>
</a>

<a href="ticket.php">
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
<h2>Client Dashboard</h2>
<p class="text-soft mb-0">Selamat datang, <?= $_SESSION['nama']; ?></p>
</div>

<a href="ticket.php" class="btn-green">
+ Buat Ticket
</a>

</div>

<div class="row mb-4">

<div class="col-md-4">
<div class="metric-card">
<small>Total Project</small>
<h2><?= $totalProject; ?></h2>
<p class="text-soft mb-0">Project yang terhubung dengan akun Anda.</p>
</div>
</div>

<div class="col-md-4">
<div class="metric-card">
<small>Ticket Support</small>
<h2>Helpdesk</h2>
<p class="text-soft mb-3">Ajukan kendala atau kebutuhan layanan.</p>
<a href="ticket.php" class="btn-green w-100 text-center">
Buka Ticket
</a>
</div>
</div>

<div class="col-md-4">
<div class="metric-card">
<small>Notifikasi</small>
<h2><?= $notif['total']; ?></h2>
<p class="text-soft mb-3">Notifikasi yang belum dibaca.</p>
<a href="notifikasi.php" class="btn-dark-custom">
Lihat Notifikasi
</a>
</div>
</div>

</div>

<div class="panel">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h4 class="mb-1">Project Anda</h4>
<p class="text-soft mb-0">Pantau status, timeline, dan approval project.</p>
</div>

<span class="badge bg-success">
Client View
</span>

</div>

<?php if($totalProject>0){ ?>

<table class="table-dark-custom">

<tr>
<th>Nama Project</th>
<th>Status</th>
<th>Deskripsi</th>
<th>Tanggal</th>
<th>Progress</th>
<th>Approval</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= $row['nama_project']; ?>
</td>

<td>
<?php
if($row['status']=="pending"){
echo '<span class="badge bg-secondary">Pending</span>';
}
elseif($row['status']=="progress"){
echo '<span class="badge bg-warning text-dark">Progress</span>';
}
else{
echo '<span class="badge bg-success">Done</span>';
}
?>
</td>

<td>
<?= $row['deskripsi']; ?>
</td>

<td>
<?= $row['created_at']; ?>
</td>

<td>
<a href="project_timeline.php?id=<?= $row['id']; ?>" class="btn-dark-custom">
Timeline
</a>
</td>

<td>
<?php if($row['status']=="done" && $row['approval_status']=="waiting"){ ?>

<a href="approve_project.php?id=<?= $row['id']; ?>" class="btn-green">
Approve
</a>

<?php } elseif($row['approval_status']=="approved"){ ?>

<span class="badge bg-success">
Approved
</span>

<?php } else { ?>

<span class="badge badge-soft">
Menunggu Selesai
</span>

<?php } ?>
</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="empty-box">
Belum ada project yang ditambahkan.
</div>

<?php } ?>

</div>

</div>

</body>

</html>