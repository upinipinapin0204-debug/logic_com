<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

$filterProject = "";
$filterTicket = "";

if($tanggal_awal != '' && $tanggal_akhir != ''){
$filterProject = "WHERE DATE(project.created_at) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$filterTicket = "WHERE DATE(ticket.created_at) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$project=mysqli_query($conn,"
SELECT project.*, users.nama AS client
FROM project
LEFT JOIN users ON project.client_id=users.id
$filterProject
ORDER BY project.id DESC
");

$ticket=mysqli_query($conn,"
SELECT ticket.*, users.nama AS client
FROM ticket
LEFT JOIN users ON ticket.client_id=users.id
$filterTicket
ORDER BY ticket.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan PDF</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
font-family:Arial,sans-serif;
padding:30px;
}

@media print{
.no-print{
display:none;
}
}
</style>

</head>

<body>

<div class="no-print mb-3">
<button onclick="window.print()" class="btn btn-danger">
Print / Save as PDF
</button>

<a href="report.php" class="btn btn-secondary">
Kembali
</a>
</div>

<h2>Laporan Sistem PT Logika Bicara</h2>

<?php if($tanggal_awal != '' && $tanggal_akhir != ''){ ?>
<p>
Periode: <?= $tanggal_awal; ?> sampai <?= $tanggal_akhir; ?>
</p>
<?php } else { ?>
<p>Periode: Semua data</p>
<?php } ?>

<hr>

<h4>Laporan Project</h4>

<table class="table table-bordered">
<tr>
<th>No</th>
<th>Project</th>
<th>Client</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

<?php $no=1; while($p=mysqli_fetch_assoc($project)){ ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $p['nama_project']; ?></td>
<td><?= $p['client']; ?></td>
<td><?= $p['status']; ?></td>
<td><?= $p['created_at']; ?></td>
</tr>
<?php } ?>
</table>

<h4 class="mt-4">Laporan Ticket</h4>

<table class="table table-bordered">
<tr>
<th>No</th>
<th>Client</th>
<th>Judul</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

<?php $no=1; while($t=mysqli_fetch_assoc($ticket)){ ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $t['client']; ?></td>
<td><?= $t['judul']; ?></td>
<td><?= $t['status']; ?></td>
<td><?= $t['created_at']; ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>