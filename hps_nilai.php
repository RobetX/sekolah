<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit; }
include "koneksi.php";

$id = (int)($_GET['id'] ?? 0);
$stmt = $koneksi->prepare("DELETE FROM nilai_murid WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: dashboard.php");
exit;