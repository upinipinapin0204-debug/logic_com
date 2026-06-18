<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

if(!isset($_GET['id'])){
header("Location:project.php");
exit;
}

$project_id=$_GET['id'];

$stmt=$conn->prepare("
SELECT project.*, users.nama AS client_nama
FROM project
LEFT JOIN users ON project.client_id=users.id
WHERE project.id=?
");

$stmt->bind_param("i",$project_id);
$stmt->execute();

$result=$stmt->get_result();
$project=$result->fetch_assoc();

if(!$project){
echo "Project tidak ditemukan.";
exit;
}

$progress=mysqli_query($conn,"
SELECT * FROM project_progress
WHERE project_id='$project_id'
ORDER BY id DESC
");

$notifStaff=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM notifications
WHERE role_target='staff'
AND is_read=0
")
);

$notifTicket=mysqli_fetch_assoc(
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

<title>Timeline Project</title>

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
margin-bottom:18px;
}

.text-soft{
color:#8ea3b8;
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

.btn-green{
background:#a6ff4d;
color:#06101a;
font-weight:700;
border:none;
border-radius:10px;
padding:10px 18px;
}

.btn-dark-custom{
background:#172635;
color:white;
border:1px solid #2b4054;
border-radius:10px;
padding:10px 18px;
text-decoration:none;
}

.timeline-item{
background:#102131;
border:1px solid #22384c;
border-left:5px solid #a6ff4d;
border-radius:14px;
padding:16px;
margin-bottom:14px;
}

.progress{
height:12px;
background:#172635;
border-radius:20px;
}

.progress-bar{
background:#a6ff4d;
color:#06101a;
font-weight:700;
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
<span class="badge bg-danger"><?= $notifTicket['total']; ?></span>
<?php } ?>

</a>

<a href="project.php" class="active">
<span>📁 Project</span>
</a>

<a href="notifikasi.php">
<span>🔔 Notifikasi</span>

<?php if($notifStaff['total']>0){ ?>
<span class="badge bg-danger"><?= $notifStaff['total']; ?></span>
<?php } ?>

</a>

<a href="../login/logout.php">
<span>🚪 Logout</span>
</a>

</div>

<div class="main">

<div class="topbar">

<div>
<h2>Timeline Project</h2>
<p class="text-soft mb-0">
Project: <?= $project['nama_project']; ?> | Client: <?= $project['client_nama']; ?>
</p>
</div>

<a href="project.php" class="btn-dark-custom">
Kembali
</a>

</div>

<?php if(isset($_GET['success'])){ ?>
<div class="alert alert-success">
Progress project berhasil ditambahkan.
</div>
<?php } ?>

<div class="panel">

<h4>Tambah Progress</h4>

<form action="proses_progress_project.php" method="POST">

<input type="hidden" name="project_id" value="<?= $project_id; ?>">

<label>Judul Progress</label>
<input type="text" name="judul_progress" class="form-control mb-3" placeholder="Contoh: Pembuatan halaman dashboard" required>

<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control mb-3" rows="4" placeholder="Tuliskan detail progress..." required></textarea>

<label>Persentase</label>
<input type="number" name="persentase" class="form-control mb-4" min="0" max="100" placeholder="0 - 100" required>

<button class="btn-green">
Simpan Progress
</button>

</form>

</div>

<div class="panel">

<h4>Riwayat Progress</h4>

<?php if(mysqli_num_rows($progress)>0){ ?>

<?php while($row=mysqli_fetch_assoc($progress)){ ?>

<div class="timeline-item">

<h5><?= $row['judul_progress']; ?></h5>

<p class="text-soft">
<?= $row['deskripsi']; ?>
</p>

<div class="progress mb-2">
<div class="progress-bar" style="width:<?= $row['persentase']; ?>%;">
<?= $row['persentase']; ?>%
</div>
</div>

<small class="text-soft">
<?= $row['created_at']; ?>
</small>

</div>

<?php } ?>

<?php } else { ?>

<p class="text-soft mb-0">
Belum ada progress yang ditambahkan.
</p>

<?php } ?>

</div>

</div>

</body>
</html>