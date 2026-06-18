<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<h2>Register User</h2>

<form action="proses_register.php" method="POST">

<input
type="text"
name="nama"
class="form-control mb-3"
placeholder="Nama"
required>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Email"
required>

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Password"
required>

<select
name="role"
class="form-control mb-3">

<option value="client">
Client
</option>

<option value="staff">
Staff
</option>

</select>

<button
class="btn btn-primary">

Register

</button>

</form>

</div>

</div>

</body>
</html>