<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

$id = $_GET['id'];

$stmt = $conn->prepare("
SELECT * FROM users
WHERE id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

$data = $stmt->get_result();
$row = $data->fetch_assoc();

if(!$row){
echo "User tidak ditemukan";
exit;
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#07111b;
font-family:Arial,sans-serif;
color:#e5edf5;
}

.sidebar{
height:100vh;
width:240px;
position:fixed;
left:0;
top:0;
background:#06101a;
border-right:1px solid #172635;
padding:20px;
}

.sidebar h4{
color:#b8ff5c;
font-weight:700;
}

.sidebar a{
display:block;
padding:12px;
margin-bottom:6px;
border-radius:10px;
text-decoration:none;
color:#b8c7d6;
font-weight:600;
}

.sidebar a:hover{
background:#112131;
color:white;
}

.main{
margin-left:260px;
padding:30px;
}

.card-box{
background:#0d1b28;
border:1px solid #203244;
border-radius:16px;
padding:25px;
max-width:800px;
}

.form-control,
.form-select{
background:#07111b;
border:1px solid #26394d;
color:white;
}

.form-control:focus,
.form-select:focus{
background:#07111b;
color:white;
border-color:#a6ff4d;
box-shadow:none;
}

.form-control::placeholder{
color:#8ea3b8;
}

.btn-save{
background:#a6ff4d;
border:none;
color:#07111b;
font-weight:700;
}

.btn-save:hover{
background:#94ea3f;
}

.text-muted-custom{
color:#8ea3b8;
}

</style>

</head>

<body>

<div class="sidebar">

<h4>PT Logika Bicara</h4>

<hr style="border-color:#203244;">

<a href="dashboard.php">📊 Dashboard</a>
<a href="layanan.php">🛠 Layanan</a>
<a href="project.php">📁 Project</a>
<a href="users.php">👤 Users</a>
<a href="ticket.php">🎫 Ticket Support</a>
<a href="pesan_kontak.php">📩 Pesan Kontak</a>
<a href="konten.php">🌐 Konten Publik</a>
<a href="artikel.php">📰 Artikel</a>
<a href="report.php">📄 Reports</a>
<a href="../login/logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="card-box">

<h3>Edit User</h3>

<p class="text-muted-custom">
Ubah informasi akun pengguna.
</p>

<form action="update_user.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $row['id']; ?>"
>

<label class="mb-2">
Nama
</label>

<input
type="text"
name="nama"
class="form-control mb-3"
value="<?= $row['nama']; ?>"
required
>

<label class="mb-2">
Email
</label>

<input
type="email"
name="email"
class="form-control mb-3"
value="<?= $row['email']; ?>"
required
>

<label class="mb-2">
Role
</label>

<select
name="role"
class="form-select mb-3"
required
>

<option value="admin"
<?= $row['role']=="admin" ? "selected" : ""; ?>>
Admin
</option>

<option value="staff"
<?= $row['role']=="staff" ? "selected" : ""; ?>>
Staff
</option>

<option value="client"
<?= $row['role']=="client" ? "selected" : ""; ?>>
Client
</option>

</select>

<label class="mb-2">
Password Baru
</label>

<input
type="password"
name="password"
class="form-control mb-4"
placeholder="Kosongkan jika tidak ingin mengganti password"
>

<button class="btn btn-save">
💾 Update User
</button>

<a href="users.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</body>
</html>