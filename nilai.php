<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
include "koneksi.php";

$notif = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $mtk  = (int)($_POST['matematika'] ?? 0);
  $bindo= (int)($_POST['bindo'] ?? 0);
  $ipa  = (int)($_POST['ipa'] ?? 0);
  $ips  = (int)($_POST['ips'] ?? 0);

  $stmt = $koneksi->prepare("INSERT INTO nilai_murid (nama, matematika, bindo, ipa, ips) VALUES (?,?,?,?,?)");
  $stmt->bind_param("siiii", $nama, $mtk, $bindo, $ipa, $ips);
  if ($stmt->execute()) { $notif = "Data berhasil disimpan."; }
  else { $notif = "Terjadi kesalahan: " . $koneksi->error; }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Nilai</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
  <section class="card" style="max-width:720px; margin:20px auto;">
    <h2>Tambah Nilai Murid</h2>
    <p>👋 Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a class="btn" href="logout.php" style="background:#ef4444;">Logout</a></p>
    <?php if(!empty($notif)): ?><div class="alert alert-success"><?php echo htmlspecialchars($notif); ?></div><?php endif; ?>
    <form method="post">
      <div class="form-row">
        <div class="col">
          <label>Nama</label>
          <input class="form-control" type="text" name="nama" required>
        </div>
        <div class="col">
          <label>Matematika</label>
          <input class="form-control" type="number" name="matematika" min="0" max="100" required>
        </div>
        <div class="col">
          <label>Bahasa Indonesia</label>
          <input class="form-control" type="number" name="bindo" min="0" max="100" required>
        </div>
        <div class="col">
          <label>IPA</label>
          <input class="form-control" type="number" name="ipa" min="0" max="100" required>
        </div>
        <div class="col">
          <label>IPS</label>
          <input class="form-control" type="number" name="ips" min="0" max="100" required>
        </div>
      </div>
      <div style="margin-top:14px;">
        <button class="btn" type="submit">Simpan</button>
        <a class="btn" href="dashboard.php" style="background:#64748b;">Kembali</a>
      </div>
    </form>
  </section>
</main>
</body>
</html>