<?php

include("config/koneksi.php");

$password = password_hash("admin123", PASSWORD_DEFAULT);

mysqli_query($conn,
"INSERT INTO users (nama, email, password, role)
VALUES ('Admin', 'admin@logika.com', '$password', 'admin')"
);

echo "Admin berhasil dibuat";

?>