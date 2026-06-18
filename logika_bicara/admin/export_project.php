<?php
include("../config/role_admin.php");
include("../config/koneksi.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_project.xls");

$data=mysqli_query($conn,"
SELECT 
project.id,
project.nama_project,
users.nama AS client,
project.status,
project.deskripsi,
project.created_at
FROM project
LEFT JOIN users ON project.client_id=users.id
ORDER BY project.id DESC
");
?>

<table border="1">

<tr>
<th>ID</th>
<th>Nama Project</th>
<th>Client</th>
<th>Status</th>
<th>Deskripsi</th>
<th>Tanggal</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['nama_project']; ?></td>
<td><?= $row['client']; ?></td>
<td><?= $row['status']; ?></td>
<td><?= $row['deskripsi']; ?></td>
<td><?= $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>