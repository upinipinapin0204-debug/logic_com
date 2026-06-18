<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

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

<title>Tambah Artikel</title>

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
max-width:900px;
}

label{
font-weight:600;
margin-bottom:6px;
color:#dce8f4;
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

.form-control::placeholder{
color:#8ea3b8;
}

input[type="file"]::file-selector-button{
background:#172635;
color:white;
border:1px solid #2b4054;
border-radius:8px;
padding:8px 12px;
margin-right:12px;
}

.btn-green{
background:#a6ff4d;
color:#06101a;
font-weight:700;
border:none;
border-radius:10px;
padding:10px 18px;
}

.btn-green:hover{
background:#92e643;
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

<a href="artikel.php" class="active">
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
<h2>Tambah Artikel</h2>
<p class="text-soft mb-0">
Tambahkan artikel baru yang akan tampil di halaman publik website.
</p>
</div>

<a href="artikel.php" class="btn-dark-custom">
Kembali
</a>

</div>

<div class="panel">

<form action="proses_tambah_artikel.php" method="POST" enctype="multipart/form-data">

<label>Judul Artikel</label>
<input type="text" name="judul" class="form-control mb-3" placeholder="Masukkan judul artikel" required>

<label>Tanggal</label>
<input type="date" name="tanggal" class="form-control mb-3" required>

<label>Gambar Artikel</label>
<input type="file" name="gambar" class="form-control mb-3" accept=".jpg,.jpeg,.png">

<label>Isi Artikel</label>
<textarea name="isi" class="form-control mb-4" rows="8" placeholder="Tulis isi artikel..." required></textarea>

<button class="btn-green">
Simpan Artikel
</button>

<a href="artikel.php" class="btn-dark-custom">
Batal
</a>

</form>

</div>

</div>

</body>
</html>