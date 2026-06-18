<?php
include("../config/role_client.php");
include("../config/koneksi.php");

$project_id=$_GET['id'];
$client_id=$_SESSION['id'];

$project=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT * FROM project
WHERE id='$project_id'
AND client_id='$client_id'
")
);

if(!$project){
echo "Project tidak ditemukan.";
exit;
}

$progress=mysqli_query($conn,"
SELECT * FROM project_progress
WHERE project_id='$project_id'
ORDER BY id ASC
");

$notif=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM notifications
WHERE role_target='client'
AND user_id='$client_id'
AND is_read=0
")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Project Timeline</title>

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
padding:24px;
margin-bottom:18px;
}

.project-info{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:16px;
margin-bottom:20px;
}

.timeline-item{
background:#102131;
border:1px solid #22384c;
border-left:5px solid #a6ff4d;
border-radius:14px;
padding:16px;
margin-bottom:14px;
}

.timeline-item h5{
margin-bottom:10px;
}

.progress{
height:12px;
background:#172635;
border-radius:20px;
}

.progress-bar{
background:#a6ff4d;
color:#06101a;
font-weight:800;
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

<a href="dashboard.php">
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
<h2>Project Timeline</h2>
<p class="text-soft mb-0">
Pantau perkembangan project Anda secara berkala.
</p>
</div>

<a href="dashboard.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<div class="project-info">

<h4>
<?= $project['nama_project']; ?>
</h4>

<p class="text-soft mb-2">
<?= $project['deskripsi']; ?>
</p>

<p class="mb-0">
Status:
<?php
if($project['status']=="pending"){
echo '<span class="badge bg-secondary">Pending</span>';
}
elseif($project['status']=="progress"){
echo '<span class="badge bg-warning text-dark">Progress</span>';
}
else{
echo '<span class="badge bg-success">Done</span>';
}
?>
</p>

</div>

<h4 class="mb-3">
Riwayat Progress
</h4>

<?php if(mysqli_num_rows($progress)>0){ ?>

<?php while($row=mysqli_fetch_assoc($progress)){ ?>

<div class="timeline-item">

<h5>
<?= $row['judul_progress']; ?> - <?= $row['persentase']; ?>%
</h5>

<div class="progress mb-3">

<div class="progress-bar" style="width:<?= $row['persentase']; ?>%;">
<?= $row['persentase']; ?>%
</div>

</div>

<p class="text-soft">
<?= $row['deskripsi']; ?>
</p>

<small class="text-soft">
<?= $row['created_at']; ?>
</small>

</div>

<?php } ?>

<?php } else { ?>

<div class="empty-box">
Belum ada progress yang ditambahkan oleh staff.
</div>

<?php } ?>

</div>

</div>

</body>

</html>