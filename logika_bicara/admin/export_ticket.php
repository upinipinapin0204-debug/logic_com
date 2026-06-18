<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_ticket.xls");

$data=mysqli_query($conn,"
SELECT 
ticket.id,
users.nama AS client,
ticket.judul,
ticket.pesan,
ticket.status,
ticket.created_at
FROM ticket
LEFT JOIN users ON ticket.client_id=users.id
ORDER BY ticket.id DESC
");
?>

<table border="1">

<tr>
<th>ID</th>
<th>Client</th>
<th>Judul</th>
<th>Pesan</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['client']; ?></td>
<td><?= $row['judul']; ?></td>
<td><?= $row['pesan']; ?></td>
<td><?= $row['status']; ?></td>
<td><?= $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>