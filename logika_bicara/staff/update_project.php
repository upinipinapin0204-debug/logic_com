<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$id=$_GET['id'];

$stmt=$conn->prepare("
SELECT project.*, users.nama AS client_nama
FROM project
LEFT JOIN users ON project.client_id=users.id
WHERE project.id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

$result=$stmt->get_result();
$row=$result->fetch_assoc();

if(!$row){
echo "Project tidak ditemukan.";
exit;
}

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

<title>Update Project</title>

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
max-width:760px;
}

.info-box{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:16px;
margin-bottom:18px;
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

<a href="ticket.php">
<span>🎫 Ticket Support</span>

<?php if($notifTicket['total']>0){ ?>
<span class="badge bg-danger">
<?= $notifTicket['total']; ?>
</span>
<?php } ?>

</a>

<a href="project.php" class="active">
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
<h2>Update Project</h2>
<p class="text-soft mb-0">Ubah status project yang sedang dikelola.</p>
</div>

<a href="project.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<div class="info-box">

<p class="mb-1">
Project: <strong><?= $row['nama_project']; ?></strong>
</p>

<p class="mb-1">
Client: <?= $row['client_nama']; ?>
</p>

<p class="mb-0">
Status saat ini:
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
</p>

</div>

<form action="proses_update_project.php" method="POST">

<input type="hidden" name="id" value="<?= $row['id']; ?>">

<label class="mb-2">Status Project</label>

<select name="status" class="form-control mb-4" required>

<option value="pending" <?= $row['status']=="pending" ? "selected" : ""; ?>>
Pending
</option>

<option value="progress" <?= $row['status']=="progress" ? "selected" : ""; ?>>
Progress
</option>

<option value="done" <?= $row['status']=="done" ? "selected" : ""; ?>>
Done
</option>

</select>

<button class="btn-green">
Simpan Perubahan
</button>

<a href="project.php" class="btn-dark-custom">
Batal
</a>

</form>

</div>

</div>

</body>

</html>