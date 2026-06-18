<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$data = mysqli_query($conn,"
SELECT ticket.*, users.nama
FROM ticket
JOIN users ON ticket.client_id = users.id
ORDER BY ticket.id DESC
");

$notifStaff = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM notifications
WHERE role_target='staff'
AND is_read=0
")
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Ticket Support</title>

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

.btn-green{
background:#a6ff4d;
color:#06101a;
font-weight:700;
border:none;
border-radius:10px;
padding:8px 14px;
text-decoration:none;
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
padding:8px 14px;
text-decoration:none;
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

<a href="ticket.php" class="active">
<span>🎫 Ticket Support</span>
</a>

<a href="project.php">
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

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2>Ticket Support</h2>
<p class="text-secondary mb-0">
Kelola seluruh ticket yang dikirim client.
</p>
</div>

</div>

<div class="panel">

<table class="table-dark-custom">

<tr>
<th>Client</th>
<th>Judul Ticket</th>
<th>Status</th>
<th>Attachment</th>
<th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<?= $row['nama']; ?>
</td>

<td>
<?= $row['judul']; ?>
</td>

<td>

<?php
if($row['status']=="open"){
echo '<span class="badge bg-danger">Open</span>';
}
elseif($row['status']=="process"){
echo '<span class="badge bg-warning text-dark">Process</span>';
}
else{
echo '<span class="badge bg-success">Closed</span>';
}
?>

</td>

<td>

<?php if(!empty($row['attachment'])){ ?>

<a href="../uploads/ticket/<?= $row['attachment']; ?>"
target="_blank"
class="btn-dark-custom">
Download
</a>

<?php } else { ?>

<span class="text-secondary">
Tidak ada file
</span>

<?php } ?>

</td>

<td>

<a href="ticket_chat.php?id=<?= $row['id']; ?>"
class="btn-green">
Buka Chat
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>

</html>