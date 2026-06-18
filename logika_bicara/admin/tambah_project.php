<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$client = mysqli_query($conn,"
SELECT * FROM users 
WHERE role='client'
ORDER BY nama ASC
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

<title>Tambah Project</title>

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
max-width:850px;
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

.form-control option{
background:#07111b;
color:white;
}

.form-control::placeholder{
color:#8ea3b8;
}

label{
color:#dce8f4;
font-weight:600;
margin-bottom:6px;
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
<div class="tag">Admin Workspace</div>

<a href="dashboard.php">
<span>📊 Dashboard</span>
</a>

<a href="layanan.php">
<span>🛠 Layanan</span>
</a>

<a href="project.php" class="active">
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

<div>
<h2>Tambah Project</h2>
<p class="text-soft mb-0">
Tambahkan project baru dan hubungkan ke akun client.
</p>
</div>

<a href="project.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<form action="proses_tambah_project.php" method="POST">

<label>Nama Project</label>
<input type="text" name="nama_project" class="form-control mb-3" placeholder="Masukkan nama project" required>

<label>Client</label>
<select name="client_id" class="form-control mb-3" required>

<option value="">-- Pilih Client --</option>

<?php while($c = mysqli_fetch_assoc($client)) { ?>

<option value="<?= $c['id']; ?>">
<?= $c['nama']; ?>
</option>

<?php } ?>

</select>

<label>Status Project</label>
<select name="status" class="form-control mb-3" required>

<option value="pending">Pending</option>
<option value="progress">Progress</option>
<option value="done">Done</option>

</select>

<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control mb-4" rows="5" placeholder="Tuliskan deskripsi project" required></textarea>

<button class="btn-green">
Simpan Project
</button>

<a href="project.php" class="btn-dark-custom">
Batal
</a>

</form>

</div>

</div>

</body>
</html>