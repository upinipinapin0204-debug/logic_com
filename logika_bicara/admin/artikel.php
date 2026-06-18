<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$data=mysqli_query($conn,"
SELECT * FROM artikel
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

<title>Kelola Artikel</title>

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
padding:20px;
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

.article-thumb{
width:80px;
height:55px;
object-fit:cover;
border-radius:10px;
border:1px solid #2b4054;
}

.btn-green{
background:#a6ff4d;
color:#06101a;
font-weight:700;
border:none;
border-radius:10px;
padding:9px 15px;
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
padding:9px 15px;
text-decoration:none;
display:inline-block;
}

.btn-dark-custom:hover{
background:#22384c;
color:white;
}

.btn-danger-custom{
background:#ef4444;
color:white;
border:none;
border-radius:10px;
padding:9px 15px;
text-decoration:none;
display:inline-block;
}

.btn-danger-custom:hover{
background:#dc2626;
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
<h2>Kelola Artikel</h2>
<p class="text-soft mb-0">
Tambah, ubah, dan hapus artikel yang tampil di website publik.
</p>
</div>

<a href="tambah_artikel.php" class="btn-green">
+ Tambah Artikel
</a>

</div>

<div class="panel">

<?php if(mysqli_num_rows($data)>0){ ?>

<table class="table-dark-custom">

<tr>
<th>ID</th>
<th>Gambar</th>
<th>Judul</th>
<th>Tanggal</th>
<th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= $row['id']; ?>
</td>

<td>
<?php if(!empty($row['gambar'])){ ?>
<img src="../uploads/artikel/<?= $row['gambar']; ?>" class="article-thumb">
<?php } else { ?>
<span class="text-soft">Tidak ada gambar</span>
<?php } ?>
</td>

<td>
<?= $row['judul']; ?>
</td>

<td>
<?= $row['tanggal']; ?>
</td>

<td>

<a href="edit_artikel.php?id=<?= $row['id']; ?>" class="btn-dark-custom">
Edit
</a>

<a href="hapus_artikel.php?id=<?= $row['id']; ?>"
class="btn-danger-custom"
onclick="return confirm('Yakin ingin menghapus artikel ini?')">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<div class="empty-box">
Belum ada artikel yang dibuat.
</div>

<?php } ?>

</div>

</div>

</body>

</html>