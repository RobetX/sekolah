-- Buat database & tabel
CREATE DATABASE IF NOT EXISTS db_sekolah;
USE db_sekolah;

-- Tabel nilai murid
DROP TABLE IF EXISTS nilai_murid;
CREATE TABLE nilai_murid (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  matematika INT NOT NULL,
  bindo INT NOT NULL,
  ipa INT NOT NULL,
  ips INT NOT NULL
);

INSERT INTO nilai_murid (nama, matematika, bindo, ipa, ips) VALUES
('Andi', 90, 85, 88, 80),
('Siti', 70, 95, 85, 89),
('Budi', 88, 80, 92, 85);

-- Tabel users (login)
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);