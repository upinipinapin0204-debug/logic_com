<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

$filterProject = "";
$filterTicket = "";

if($tanggal_awal != '' && $tanggal_akhir != ''){
$filterProject = " AND DATE(created_at) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$filterTicket = " AND DATE(created_at) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$totalProject=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM project 
WHERE 1=1 $filterProject
")
);

$pending=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM project 
WHERE status='pending' $filterProject
")
);

$progress=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM project 
WHERE status='progress' $filterProject
")
);

$done=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM project 
WHERE status='done' $filterProject
")
);

$totalTicket=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM ticket 
WHERE 1=1 $filterTicket
")
);

$open=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM ticket 
WHERE status='open' $filterTicket
")
);

$process=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM ticket 
WHERE status='process' $filterTicket
")
);

$closed=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total FROM ticket 
WHERE status='closed' $filterTicket
")
);

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

<title>Report System</title>

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
margin-bottom:18px;
}

.metric-card{
background:#102131;
border:1px solid #22384c;
border-radius:14px;
padding:18px;
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

.form-control{
background:#07111b;
border:1px solid #26394d;
color:white;
border-radius:12px;
padding:11px;
}

.form-control:focus{
background:#07111b;
color:white;
border-color:#a6ff4d;
box-shadow:none;
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

.btn-danger-custom{
background:#ef4444;
color:white;
border:none;
border-radius:10px;
padding:10px 18px;
text-decoration:none;
display:inline-block;
}

.btn-danger-custom:hover{
background:#dc2626;
color:white;
}

.chart-box{
height:340px;
}

canvas{
background:#07111b;
border-radius:14px;
padding:10px;
}

.export-box{
display:flex;
gap:10px;
flex-wrap:wrap;
margin-bottom:20px;
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

<a href="artikel.php">
<span>📰 Artikel</span>
</a>

<a href="report.php" class="active">
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
<h2>Laporan Sistem</h2>
<p class="text-soft mb-0">
Ringkasan data project dan ticket support.
</p>
</div>

</div>

<div class="panel">

<form method="GET" class="row g-3">

<div class="col-md-4">
<label>Tanggal Awal</label>
<input type="date" name="tanggal_awal" class="form-control" value="<?= $tanggal_awal; ?>">
</div>

<div class="col-md-4">
<label>Tanggal Akhir</label>
<input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir; ?>">
</div>

<div class="col-md-4 d-flex align-items-end gap-2">
<button class="btn-green">Filter</button>
<a href="report.php" class="btn-dark-custom">Reset</a>
</div>

</form>

</div>

<div class="export-box">

<a href="export_project.php" class="btn-green">
Export Project Excel
</a>

<a href="export_ticket.php" class="btn-dark-custom">
Export Ticket Excel
</a>

<a href="export_pdf.php?tanggal_awal=<?= $tanggal_awal; ?>&tanggal_akhir=<?= $tanggal_akhir; ?>" class="btn-danger-custom">
Export PDF
</a>

</div>

<h4 class="mb-3">Statistik Project</h4>

<div class="row g-3 mb-4">

<div class="col-md-3">
<div class="metric-card">
<small>Total Project</small>
<h2><?= $totalProject['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Pending</small>
<h2><?= $pending['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Progress</small>
<h2><?= $progress['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Done</small>
<h2><?= $done['total']; ?></h2>
</div>
</div>

</div>

<h4 class="mb-3">Statistik Ticket</h4>

<div class="row g-3 mb-4">

<div class="col-md-3">
<div class="metric-card">
<small>Total Ticket</small>
<h2><?= $totalTicket['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Open</small>
<h2><?= $open['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Process</small>
<h2><?= $process['total']; ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="metric-card">
<small>Closed</small>
<h2><?= $closed['total']; ?></h2>
</div>
</div>

</div>

<div class="row g-3 mt-2">

<div class="col-md-6">
<div class="panel chart-box">
<h5>Grafik Status Project</h5>
<canvas id="projectChart"></canvas>
</div>
</div>

<div class="col-md-6">
<div class="panel chart-box">
<h5>Grafik Status Ticket</h5>
<canvas id="ticketChart"></canvas>
</div>
</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

Chart.defaults.color = '#dce8f4';
Chart.defaults.borderColor = '#22384c';

const projectChart = document.getElementById('projectChart');

new Chart(projectChart, {
type: 'bar',
data: {
labels: ['Pending', 'Progress', 'Done'],
datasets: [{
label: 'Jumlah Project',
data: [
<?= $pending['total']; ?>,
<?= $progress['total']; ?>,
<?= $done['total']; ?>
],
backgroundColor: [
'#64748b',
'#facc15',
'#22c55e'
],
borderWidth: 1
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
scales: {
y: {
beginAtZero: true
}
}
}
});

const ticketChart = document.getElementById('ticketChart');

new Chart(ticketChart, {
type: 'doughnut',
data: {
labels: ['Open', 'Process', 'Closed'],
datasets: [{
label: 'Jumlah Ticket',
data: [
<?= $open['total']; ?>,
<?= $process['total']; ?>,
<?= $closed['total']; ?>
],
backgroundColor: [
'#ef4444',
'#facc15',
'#22c55e'
],
borderColor:'#07111b',
borderWidth: 3
}]
},
options: {
responsive: true,
maintainAspectRatio: false
}
});

</script>

</body>

</html>