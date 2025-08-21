<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container">
  <section class="card">
    <h2>📊 Dashboard Admin</h2>
    <p>👋 Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a class="btn" href="logout.php" style="background:#ef4444;">Logout</a></p>
    <a class="btn" href="tambah_nilai.php">➕ Tambah Nilai Baru</a>
    <a class="btn" href="index.php" style="background:#64748b;">Lihat Halaman Depan</a>
    <br><br>
    <table>
      <tr>
        <th>Nama</th>
        <th>Matematika</th>
        <th>B. Indonesia</th>
        <th>IPA</th>
        <th>IPS</th>
        <th>Aksi</th>
      </tr>
      <?php
        $res = $koneksi->query("SELECT id, nama, matematika, bindo, ipa, ips FROM nilai_murid ORDER BY id DESC");
        while ($row = $res->fetch_assoc()):
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row['nama']); ?></td>
        <td><?php echo htmlspecialchars($row['matematika']); ?></td>
        <td><?php echo htmlspecialchars($row['bindo']); ?></td>
        <td><?php echo htmlspecialchars($row['ipa']); ?></td>
        <td><?php echo htmlspecialchars($row['ips']); ?></td>
        <td>
          <a class="btn" href="edit_nilai.php?id=<?php echo (int)$row['id']; ?>">✏️ Edit</a>
          <a class="btn" href="hapus_nilai.php?id=<?php echo (int)$row['id']; ?>" onclick="return confirm('Yakin mau hapus?')" style="background:#ef4444;">🗑️ Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </section>
</main>
</body>
</html>