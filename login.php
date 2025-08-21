<?php
session_start();
if (isset($_SESSION['username'])) { header("Location: dashboard.php"); exit; }
include "koneksi.php";

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $koneksi->prepare("SELECT id, username, password FROM users WHERE username = ? LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($uid, $uname, $hash);
  if ($stmt->fetch()) {
    if (password_verify($password, $hash)) {
      $_SESSION['user_id'] = $uid;
      $_SESSION['username'] = $uname;
      header("Location: dashboard.php"); exit;
    } else { $error = "Username atau password salah."; }
  } else { $error = "Username atau password salah."; }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Guru/Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
  <section class="card" style="max-width:480px; margin:40px auto;">
    <h2>Login Guru/Admin</h2>
    <?php if(!empty($error)): ?>
      <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="col">
        <label>Username</label>
        <input class="form-control" type="text" name="username" required autofocus>
      </div>
      <div class="col" style="margin-top:10px;">
        <label>Password</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <div style="margin-top:14px;">
        <button class="btn" type="submit">Login</button>
        <a class="btn" href="index.php" style="background:#64748b;">Kembali</a>
      </div>
      <p class="small text-muted" style="margin-top:10px;">Akun awal: admin / admin123 (buat via create_admin.php).</p>
    </form>
  </section>
</main>
</body>
</html>