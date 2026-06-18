<?php
include("../config/role_client.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Buat Ticket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<h2>Buat Ticket Baru</h2>

<form action="proses_ticket.php" method="POST" enctype="multipart/form-data">

<input
type="text"
name="judul"
class="form-control mb-3"
placeholder="Judul ticket"
required>

<textarea
name="pesan"
class="form-control mb-3"
rows="5"
placeholder="Masukkan pesan"
required></textarea>

<input
type="file"
name="attachment"
class="form-control mb-3"
accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">

<button class="btn btn-primary">
Kirim
</button>

</form>

</div>

</body>
</html>