<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
include "koneksi.php";

$id = (int)($_GET['id'] ?? 0);
$stmt = $koneksi->prepare("SELECT id, nama, matematika, bindo, ipa, ips FROM nilai_murid WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) { die("Data tidak ditemukan."); }

$notif = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $mtk  = (int)($_POST['matematika'] ?? 0);
  $bindo= (int)($_POST['bindo'] ?? 0);
  $ipa  = (int)($_POST['ipa'] ?? 0);
  $ips  = (int)($_POST['ips'] ?? 0);

  $stmt = $koneksi->prepare("UPDATE nilai_murid SET nama=?, matematika=?, bindo=?, ipa=?, ips=? WHERE id=?");
  $stmt->bind_param("siiiii", $nama, $mtk, $bindo, $ipa, $ips, $id);
  if ($stmt->execute()) { header("Location: dashboard.php"); exit; }
  else { $notif = "Terjadi kesalahan: " . $koneksi->error; }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Nilai</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
  <section class="card" style="max-width:720px; margin:20px auto;">
    <h2>Edit Nilai Murid</h2>
    <?php if(!empty($notif)): ?><div class="alert alert-error"><?php echo htmlspecialchars($notif); ?></div><?php endif; ?>
    <form method="post">
      <div class="form-row">
        <div class="col">
          <label>Nama</label>
          <input class="form-control" type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>
        <div class="col">
          <label>Matematika</label>
          <input class="form-control" type="number" name="matematika" value="<?php echo (int)$data['matematika']; ?>" required>
        </div>
        <div class="col">
          <label>Bahasa Indonesia</label>
          <input class="form-control" type="number" name="bindo" value="<?php echo (int)$data['bindo']; ?>" required>
        </div>
        <div class="col">
          <label>IPA</label>
          <input class="form-control" type="number" name="ipa" value="<?php echo (int)$data['ipa']; ?>" required>
        </div>
        <div class="col">
          <label>IPS</label>
          <input class="form-control" type="number" name="ips" value="<?php echo (int)$data['ips']; ?>" required>
        </div>
      </div>
      <div style="margin-top:14px;">
        <button class="btn" type="submit">Update</button>
        <a class="btn" href="dashboard.php" style="background:#64748b;">Batal</a>
      </div>
    </form>
  </section>
</main>
</body>
</html>