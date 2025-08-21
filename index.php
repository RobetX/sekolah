<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Sekolah</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
  <h1>Website Sekolah</h1>
  <p>Selamat datang di website resmi sekolah kami</p>
</header>

<nav class="container">
  <a href="#profil">Profil</a>
  <a href="#guru">Guru</a>
  <a href="#prestasi">Murid Berprestasi</a>
  <a href="#nilai">Nilai Murid</a>
  <a href="#kontak">Kontak</a>
  <a href="login.php" style="float:right">Login Guru/Admin</a>
</nav>

<main class="container">

  <section id="profil" class="card">
    <h2>Profil Sekolah</h2>
    <p><b>Visi:</b> Mencetak generasi cerdas, berakhlak mulia, dan berprestasi.</p>
    <p><b>Misi:</b></p>
    <ul>
      <li>Meningkatkan kualitas pendidikan.</li>
      <li>Membentuk karakter siswa yang disiplin dan berakhlak baik.</li>
      <li>Mendukung siswa untuk meraih prestasi akademik maupun non-akademik.</li>
    </ul>
    <div class="grid">
      <figure class="figure">
        <img src="assets/img/sekolah1.jpg" alt="Foto Sekolah 1">
        <figcaption class="text-muted">Gedung Sekolah</figcaption>
      </figure>
      <figure class="figure">
        <img src="assets/img/sekolah2.jpg" alt="Foto Sekolah 2">
        <figcaption class="text-muted">Fasilitas Kelas</figcaption>
      </figure>
      <figure class="figure">
        <img src="assets/img/sekolah3.jpg" alt="Foto Sekolah 3">
        <figcaption class="text-muted">Halaman & Lapangan</figcaption>
      </figure>
    </div>
    <hr class="sep">
    <h3>Guru Kami</h3>
    <div class="grid">
      <figure class="figure">
        <img src="assets/img/guru1.jpg" alt="Guru 1">
        <figcaption><b>Bapak Ahmad</b><br><span class="text-muted">Matematika</span></figcaption>
      </figure>
      <figure class="figure">
        <img src="assets/img/guru2.jpg" alt="Guru 2">
        <figcaption><b>Ibu Siti</b><br><span class="text-muted">Bahasa Indonesia</span></figcaption>
      </figure>
      <figure class="figure">
        <img src="assets/img/guru3.jpg" alt="Guru 3">
        <figcaption><b>Bapak Budi</b><br><span class="text-muted">IPA</span></figcaption>
      </figure>
    </div>
  </section>

  <section id="guru" class="card">
    <h2>Daftar Guru</h2>
    <div class="grid">
      <div class="figure"><img src="assets/img/guru1.jpg" alt=""><p><b>Bapak Ahmad</b><br><span class="text-muted">Matematika</span></p></div>
      <div class="figure"><img src="assets/img/guru2.jpg" alt=""><p><b>Ibu Siti</b><br><span class="text-muted">Bahasa Indonesia</span></p></div>
      <div class="figure"><img src="assets/img/guru3.jpg" alt=""><p><b>Bapak Budi</b><br><span class="text-muted">IPA</span></p></div>
      <div class="figure"><img src="assets/img/guru4.jpg" alt=""><p><b>Ibu Rina</b><br><span class="text-muted">IPS</span></p></div>
    </div>
  </section>

  <section id="prestasi" class="card">
    <h2>Murid Berprestasi</h2>
    <div class="grid">
      <div class="figure"><img src="assets/img/murid1.jpg" alt=""><p><b>Andi</b><br><span class="text-muted">Juara Olimpiade Matematika</span></p></div>
      <div class="figure"><img src="assets/img/murid2.jpg" alt=""><p><b>Siti</b><br><span class="text-muted">Juara Lomba Pidato</span></p></div>
      <div class="figure"><img src="assets/img/murid3.jpg" alt=""><p><b>Budi</b><br><span class="text-muted">Juara Futsal Tingkat Kota</span></p></div>
    </div>
  </section>

  <section id="nilai" class="card">
    <h2>Nilai Murid</h2>
    <table>
      <tr>
        <th>Nama</th>
        <th>Matematika</th>
        <th>Bahasa Indonesia</th>
        <th>IPA</th>
        <th>IPS</th>
      </tr>
      <?php
        $stmt = $koneksi->prepare("SELECT nama, matematika, bindo, ipa, ips FROM nilai_murid ORDER BY nama ASC");
        if ($stmt && $stmt->execute()) {
          $stmt->bind_result($nama, $mtk, $bindo, $ipa, $ips);
          while ($stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($nama) . "</td>";
            echo "<td>" . htmlspecialchars($mtk) . "</td>";
            echo "<td>" . htmlspecialchars($bindo) . "</td>";
            echo "<td>" . htmlspecialchars($ipa) . "</td>";
            echo "<td>" . htmlspecialchars($ips) . "</td>";
            echo "</tr>";
          }
          $stmt->close();
        }
      ?>
    </table>
    <p class="small text-muted">Data diambil dari database.</p>
  </section>

  <section id="kontak" class="card">
    <h2>Kontak Sekolah</h2>
    <p><b>Alamat:</b> Jl. Pendidikan No. 123, Jakarta</p>
    <p><b>Email:</b> sekolah@example.com</p>
    <p><b>Telepon:</b> (021) 12345678</p>
  </section>

</main>

<footer>
  <p>&copy; 2025 Website Sekolah</p>
</footer>
</body>
</html>