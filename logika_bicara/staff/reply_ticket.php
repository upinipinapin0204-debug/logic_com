<?php
include("../config/role_staff.php");
include("../config/koneksi.php");

$id = $_GET['id'];

$stmt = $conn->prepare("
SELECT ticket.*, users.nama AS client
FROM ticket
LEFT JOIN users ON ticket.client_id = users.id
WHERE ticket.id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$data = $stmt->get_result();
$row = $data->fetch_assoc();

if(!$row){
echo "Ticket tidak ditemukan.";
exit;
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Reply Ticket</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
font-family:Arial,sans-serif;
}

.sidebar{
height:100vh;
width:240px;
position:fixed;
left:0;
top:0;
background:#111827;
padding:20px;
color:white;
}

.sidebar a{
display:block;
padding:10px;
color:#cbd5e1;
text-decoration:none;
border-radius:8px;
margin-bottom:5px;
}

.sidebar a:hover{
background:#1f2937;
color:white;
}

.main{
margin-left:260px;
padding:25px;
}

.card-box{
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 3px 10px rgba(0,0,0,.05);
}

.ticket-message{
background:#f1f5f9;
padding:15px;
border-radius:10px;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="sidebar">

<h4>PT Logika Bicara</h4>

<hr>

<a href="dashboard.php">📊 Dashboard</a>
<a href="ticket.php">🎫 Ticket Support</a>
<a href="project.php">📁 Project</a>
<a href="notifikasi.php">🔔 Notifikasi</a>
<a href="../login/logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="card-box">

<h3>Reply Ticket</h3>

<p class="text-muted">
Client: <?= $row['client']; ?> |
Status: <?= $row['status']; ?>
</p>

<hr>

<h5><?= $row['judul']; ?></h5>

<div class="ticket-message">

<p>
<?= nl2br($row['pesan']); ?>
</p>

</div>

<?php if(!empty($row['attachment'])){ ?>

<a href="../uploads/ticket/<?= $row['attachment']; ?>" target="_blank" class="btn btn-sm btn-secondary mb-3">
Download Attachment
</a>

<?php } ?>

<form action="proses_reply.php" method="POST">

<input type="hidden" name="id" value="<?= $row['id']; ?>">

<label>Balasan</label>
<textarea name="balasan" class="form-control mb-3" rows="5" placeholder="Tulis balasan untuk client..." required><?= $row['balasan']; ?></textarea>

<label>Status Ticket</label>
<select name="status" class="form-control mb-4" required>

<option value="process" <?= $row['status']=="process" ? "selected" : ""; ?>>
Process
</option>

<option value="closed" <?= $row['status']=="closed" ? "selected" : ""; ?>>
Closed
</option>

</select>

<button class="btn btn-primary">
Kirim Balasan
</button>

<a href="ticket.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</body>

</html>