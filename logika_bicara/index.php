<?php
include("config/koneksi.php");

$konten=mysqli_fetch_assoc(
mysqli_query($conn,"SELECT * FROM konten_website LIMIT 1")
);

$layanan=mysqli_query($conn,"SELECT * FROM layanan LIMIT 3");
$project=mysqli_query($conn,"SELECT * FROM project ORDER BY id DESC LIMIT 3");
$artikel=mysqli_query($conn,"SELECT * FROM artikel ORDER BY id DESC LIMIT 3");
?>

<!DOCTYPE html>
<html>
<head>

<title><?= $konten['nama_perusahaan']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
html{
scroll-behavior:smooth;
}

body{
margin:0;
font-family:Arial,sans-serif;
background:#070b0f;
color:#f8fafc;
}

section{
scroll-margin-top:25px;
}

/* WARNA UTAMA SESUAI LOGO */
:root{
--dark:#070b0f;
--dark-2:#0d141b;
--dark-3:#111c24;
--line:#22313b;
--orange:#ff7a1a;
--blue:#00a9e8;
--white:#ffffff;
--muted:#a8b6c3;
}

.sidebar{
width:230px;
height:100vh;
position:fixed;
left:0;
top:0;
background:#070b0f;
border-right:1px solid var(--line);
padding:24px 18px;
}

.logo{
font-size:20px;
font-weight:800;
color:var(--orange);
margin-bottom:6px;
line-height:1.3;
}

.tag{
font-size:12px;
color:var(--blue);
margin-bottom:35px;
font-weight:600;
}

.sidebar a{
display:block;
padding:12px 14px;
margin-bottom:8px;
border-radius:10px;
text-decoration:none;
color:#dbeafe;
font-weight:600;
}

.sidebar a:hover,
.sidebar a.active{
background:#111c24;
color:white;
border-left:4px solid var(--orange);
}

.main{
margin-left:230px;
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
color:var(--white);
}

.text-secondary{
color:var(--muted)!important;
}

.btn-green{
background:linear-gradient(135deg,var(--orange),#ff9f43);
color:white;
font-weight:700;
border:none;
border-radius:10px;
padding:10px 18px;
text-decoration:none;
}

.btn-green:hover{
background:linear-gradient(135deg,#ff8a2a,var(--blue));
color:white;
}

.panel{
background:#0d141b;
border:1px solid var(--line);
border-radius:16px;
padding:20px;
margin-bottom:18px;
}

.hero{
min-height:320px;
background:
linear-gradient(90deg,rgba(7,11,15,.35),rgba(7,11,15,.96)),
url('https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1600&q=80');
background-size:cover;
background-position:center;
display:flex;
align-items:center;
border-radius:18px;
overflow:hidden;
border:1px solid var(--line);
}

.hero-content{
max-width:720px;
margin-left:auto;
padding:40px;
}

.hero h1{
font-size:42px;
font-weight:800;
color:var(--white);
}

.hero p{
color:#d7e3ee;
font-size:16px;
line-height:1.7;
}

.metric-card{
background:#111c24;
border:1px solid #243744;
border-radius:14px;
padding:18px;
height:100%;
}

.metric-card small{
color:var(--blue);
font-weight:700;
}

.metric-card h4{
font-weight:800;
margin-top:8px;
color:var(--orange);
}

.section-title{
font-size:22px;
font-weight:800;
margin-bottom:18px;
color:var(--white);
}

.table-dark-custom{
width:100%;
color:#eaf4ff;
}

.table-dark-custom th{
color:var(--blue);
font-size:13px;
padding:12px;
border-bottom:1px solid var(--line);
}

.table-dark-custom td{
padding:12px;
border-bottom:1px solid #14232e;
font-size:14px;
}

.card-box{
background:#111c24;
border:1px solid #243744;
border-radius:14px;
padding:18px;
height:100%;
transition:.2s;
}

.card-box:hover{
transform:translateY(-4px);
border-color:var(--orange);
}

.icon-box{
width:42px;
height:42px;
border-radius:10px;
border:1px solid var(--blue);
color:var(--orange);
display:flex;
align-items:center;
justify-content:center;
margin-bottom:12px;
}

.article-img{
height:150px;
width:100%;
object-fit:cover;
border-radius:12px;
margin-bottom:12px;
}

.chart-ring{
width:160px;
height:160px;
border-radius:50%;
background:conic-gradient(var(--orange) 0 45%, var(--blue) 45% 80%, #ffffff 80% 100%);
display:flex;
align-items:center;
justify-content:center;
margin:auto;
}

.chart-inner{
width:95px;
height:95px;
border-radius:50%;
background:#0d141b;
display:flex;
align-items:center;
justify-content:center;
flex-direction:column;
}

.cta{
background:#111c24;
border:1px solid #243744;
border-radius:16px;
padding:24px;
}

.form-control{
background:#070b0f;
border:1px solid #26394d;
color:white;
border-radius:10px;
}

.form-control:focus{
background:#070b0f;
color:white;
border-color:var(--orange);
box-shadow:none;
}

.form-control::placeholder{
color:#8ea3b8;
}

.btn-success{
background:var(--orange)!important;
border:none!important;
font-weight:700;
}

.btn-success:hover{
background:var(--blue)!important;
}

.badge.bg-success{
background:var(--blue)!important;
}

.badge.bg-warning{
background:var(--orange)!important;
color:white!important;
}

.footer{
margin-left:230px;
padding:20px;
text-align:center;
color:#a8b6c3;
border-top:1px solid var(--line);
background:#070b0f;
}
</style>

</head>

<body>

<div class="sidebar">

<div class="logo"><?= $konten['nama_perusahaan']; ?></div>
<div class="tag">Communication Intelligence</div>

<a href="#home" class="active">📊 Dashboard</a>
<a href="#about">🏢 Tentang Kami</a>
<a href="#services">🛠 Layanan</a>
<a href="#portfolio">📁 Portfolio</a>
<a href="#artikel">📰 Artikel</a>
<a href="#contact">📩 Kontak</a>
<a href="login/login.php">🔐 Login</a>

</div>

<div class="main">

<div class="topbar">
<div>
<h2>Company Profile</h2>
<p class="text-secondary mb-0"><?= $konten['tagline']; ?></p>
</div>

<a href="#contact" class="btn-green">Hubungi Kami</a>
</div>

<section class="hero" id="home">
<div class="hero-content">

<h1><?= $konten['tagline']; ?></h1>

<p>
<?= $konten['nama_perusahaan']; ?> membantu perusahaan dalam pengelolaan komunikasi, project, ticket support, dan layanan digital secara profesional.
</p>

<a href="#services" class="btn-green">Lihat Layanan</a>

</div>
</section>

<div class="row mt-4 mb-4">

<div class="col-md-3">
<div class="metric-card">
<small>Role User</small>
<h4>3+</h4>
<p class="mb-0 text-secondary">Admin, staff, client</p>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Support</small>
<h4>24/7</h4>
<p class="mb-0 text-secondary">Ticket management</p>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Project</small>
<h4>100%</h4>
<p class="mb-0 text-secondary">Tracking progress</p>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Content</small>
<h4>CMS</h4>
<p class="mb-0 text-secondary">Dynamic website</p>
</div>
</div>

</div>

<section class="panel" id="about">

<div class="section-title">Sekilas Tentang <?= $konten['nama_perusahaan']; ?></div>

<div class="row align-items-center">

<div class="col-md-7">
<p style="color:#b8c7d6;line-height:1.8;">
<?= $konten['tentang']; ?>
</p>

<p style="color:#b8c7d6;">
Kami berfokus pada solusi komunikasi digital, pengelolaan project, layanan client, dan sistem support yang membantu bisnis bekerja lebih efektif.
</p>
</div>

<div class="col-md-5">
<div class="panel mb-0">
<h5>Keunggulan Sistem</h5>
<table class="table-dark-custom">
<tr>
<td>Project Tracking</td>
<td>Stable</td>
</tr>
<tr>
<td>Ticket Support</td>
<td>Active</td>
</tr>
<tr>
<td>Reporting</td>
<td>Available</td>
</tr>
<tr>
<td>CMS Content</td>
<td>Dynamic</td>
</tr>
</table>
</div>
</div>

</div>

</section>

<section class="panel" id="services">

<div class="d-flex justify-content-between align-items-center mb-3">
<div class="section-title mb-0">Layanan Kami</div>
<span class="badge bg-success">Service Overview</span>
</div>

<div class="row">

<?php while($l=mysqli_fetch_assoc($layanan)){ ?>

<div class="col-md-4 mb-3">
<div class="card-box">
<div class="icon-box">🛠</div>
<h5><?= $l['judul']; ?></h5>
<p style="color:#b8c7d6;"><?= $l['deskripsi']; ?></p>
</div>
</div>

<?php } ?>

</div>

</section>

<section class="panel" id="portfolio">

<div class="section-title">Portfolio Project</div>

<table class="table-dark-custom">

<tr>
<th>Project</th>
<th>Status</th>
<th>Deskripsi</th>
</tr>

<?php while($p=mysqli_fetch_assoc($project)){ ?>

<tr>
<td><?= $p['nama_project']; ?></td>
<td>
<?php if($p['status']=="done"){ ?>
<span class="badge bg-success">Done</span>
<?php } elseif($p['status']=="progress"){ ?>
<span class="badge bg-warning text-dark">Progress</span>
<?php } else { ?>
<span class="badge bg-secondary">Pending</span>
<?php } ?>
</td>
<td><?= $p['deskripsi']; ?></td>
</tr>

<?php } ?>

</table>

</section>

<section class="panel" id="artikel">

<div class="row">

<div class="col-md-9">

<div class="section-title">Artikel Terbaru</div>

<div class="row">

<?php while($a=mysqli_fetch_assoc($artikel)){ ?>

<div class="col-md-4 mb-3">
<div class="card-box">

<?php if(!empty($a['gambar'])){ ?>
<img src="uploads/artikel/<?= $a['gambar']; ?>" class="article-img">
<?php } ?>

<h5><?= $a['judul']; ?></h5>
<p class="text-secondary"><?= $a['tanggal']; ?></p>
<p style="color:#b8c7d6;"><?= substr($a['isi'],0,100); ?>...</p>

<a href="detail_artikel.php?id=<?= $a['id']; ?>" class="btn btn-sm btn-success">
Baca Selengkapnya
</a>

</div>
</div>

<?php } ?>

</div>

</div>

<div class="col-md-3">
<div class="card-box text-center">
<h5>Trend Summary</h5>
<div class="chart-ring mt-4 mb-3">
<div class="chart-inner">
<h2 class="mb-0">7</h2>
<small>Rows</small>
</div>
</div>
<p class="text-secondary mb-0">Ringkasan data komunikasi dan konten.</p>
</div>
</div>

</div>

</section>

<section class="panel" id="contact">

<div class="cta">

<div class="row align-items-center">

<div class="col-md-5">

<h3>Hubungi Kami</h3>
<p>Email: <?= $konten['email']; ?></p>
<p>Telepon: <?= $konten['telepon']; ?></p>
<p>Alamat: <?= $konten['alamat']; ?></p>

</div>

<div class="col-md-7">

<?php if(isset($_GET['status']) && $_GET['status']=="success"){ ?>
<div class="alert alert-success">
Pesan berhasil dikirim.
</div>
<?php } ?>

<form action="proses_kontak.php" method="POST">

<input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<textarea name="pesan" class="form-control mb-3" rows="4" placeholder="Pesan" required></textarea>

<button class="btn btn-success">
Kirim Pesan
</button>

</form>

</div>

</div>

</div>

</section>

</div>

<div class="footer">
© <?= date('Y'); ?> <?= $konten['nama_perusahaan']; ?>. All Rights Reserved.
</div>

</body>
</html>