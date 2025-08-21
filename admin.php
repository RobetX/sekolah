<?php
include "koneksi.php";

$username = "admin";
$password_plain = "admin123";
$hash = password_hash($password_plain, PASSWORD_DEFAULT);

$stmt = $koneksi->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) { echo "User 'admin' sudah ada."; $stmt->close(); exit; }
$stmt->close();

$stmt = $koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);
if ($stmt->execute()) { echo "Berhasil membuat user admin. Username: admin, Password: admin123"; }
else { echo "Gagal: " . $koneksi->error; }
$stmt->close();