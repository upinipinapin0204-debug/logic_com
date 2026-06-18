<!DOCTYPE html>
<html>

<head>

<title>Login - PT Logika Bicara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
min-height:100vh;
font-family:Arial,sans-serif;
background:#07111b;
color:#e5edf5;
display:flex;
align-items:center;
justify-content:center;
}

.login-wrapper{
width:100%;
max-width:1050px;
background:#0d1b28;
border:1px solid #203244;
border-radius:22px;
overflow:hidden;
box-shadow:0 20px 50px rgba(0,0,0,.35);
}

.left-panel{
background:
linear-gradient(90deg,rgba(7,17,27,.25),rgba(7,17,27,.92)),
url('https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1200&q=80');
background-size:cover;
background-position:center;
min-height:560px;
padding:45px;
display:flex;
flex-direction:column;
justify-content:space-between;
}

.logo{
font-size:26px;
font-weight:800;
color:#b8ff5c;
}

.tagline h1{
font-size:42px;
font-weight:800;
line-height:1.2;
}

.tagline p{
color:#b8c7d6;
font-size:16px;
line-height:1.7;
}

.right-panel{
padding:50px;
background:#0d1b28;
}

.login-card h2{
font-weight:800;
margin-bottom:8px;
}

.login-card p{
color:#8ea3b8;
margin-bottom:30px;
}

.form-control{
background:#07111b;
border:1px solid #26394d;
color:white;
padding:13px;
border-radius:12px;
}

.form-control:focus{
background:#07111b;
color:white;
border-color:#a6ff4d;
box-shadow:none;
}

.form-control::placeholder{
color:#8ea3b8;
}

.btn-login{
background:#a6ff4d;
color:#06101a;
font-weight:800;
border:none;
border-radius:12px;
padding:13px;
width:100%;
}

.btn-login:hover{
background:#90e63f;
color:#06101a;
}

.back-link{
color:#8ea3b8;
text-decoration:none;
font-size:14px;
}

.back-link:hover{
color:#a6ff4d;
}

.small-info{
margin-top:25px;
font-size:13px;
color:#8ea3b8;
}

</style>

</head>

<body>

<div class="login-wrapper">

<div class="row g-0">

<div class="col-md-6">

<div class="left-panel">

<div class="logo">
PT Logika Bicara
</div>

<div class="tagline">

<h1>
Communication Management System
</h1>

<p>
Kelola project, ticket support, komunikasi client, dan laporan perusahaan dalam satu platform.
</p>

</div>

<div class="small-info">
Secure access for admin, staff, and client.
</div>

</div>

</div>

<div class="col-md-6">

<div class="right-panel">

<div class="login-card">

<a href="../index.php" class="back-link">
← Kembali ke Website
</a>

<h2 class="mt-4">
Login
</h2>

<p>
Masuk ke dashboard sesuai role akun Anda.
</p>

<form action="proses_login.php" method="POST">

<label>Email</label>
<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Masukkan email"
required>

<label>Password</label>
<input
type="password"
name="password"
class="form-control mb-4"
placeholder="Masukkan password"
required>

<button class="btn-login">
Login
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>