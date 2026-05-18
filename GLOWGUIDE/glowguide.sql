-- phpMyAdmin SQL Dump
-- Versi Server: 10.4.32-MariaDB
-- Database: glowguide
-- Fix: primary keys, foreign keys, naming, auto_increment, field alignment dengan PHP

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";
SET NAMES utf8mb4;

-- ============================================================
-- DROP tables dulu agar tidak konflik (urutan: child → parent)
-- ============================================================
DROP TABLE IF EXISTS `detail_paket`;
DROP TABLE IF EXISTS `pembayaran`;
DROP TABLE IF EXISTS `hasil_analisis`;
DROP TABLE IF EXISTS `konsultasi`;
DROP TABLE IF EXISTS `paket_skincare`;
DROP TABLE IF EXISTS `produk`;
DROP TABLE IF EXISTS `user`;

-- ============================================================
-- Tabel: user
-- Fix: id user (spasi) → id_user, username diperbesar, DEFAULT created_at
-- ============================================================
CREATE TABLE `user` (
  `id_user`    int(11)      NOT NULL AUTO_INCREMENT,
  `username`   varchar(50)  NOT NULL,
  `password`   varchar(255) NOT NULL,
  `role`       enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: konsultasi
-- Fix: id_konsultasi → id (konsisten dengan PHP $d['id']),
--      tambah PRIMARY KEY, tambah id_user (FK ke user),
--      kolom opsional dibuat nullable agar form sederhana tetap bisa simpan
-- ============================================================
CREATE TABLE `konsultasi` (
  `id`           int(11)      NOT NULL AUTO_INCREMENT,
  `id_user`      int(11)      DEFAULT NULL COMMENT 'NULL = konsultasi tanpa akun (guest)',
  `nama`         varchar(100) NOT NULL,
  `email`        varchar(100) DEFAULT NULL,
  `umur`         int(11)      NOT NULL,
  `jenis_kulit`  varchar(100) NOT NULL,
  `keluhan`      text         NOT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `profesi`      varchar(100) DEFAULT NULL,
  `created_at`   timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_konsultasi_user`
    FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: produk
-- ============================================================
CREATE TABLE `produk` (
  `id_produk`    int(11)      NOT NULL AUTO_INCREMENT,
  `nama_produk`  varchar(100) NOT NULL,
  `kategori`     varchar(50)  NOT NULL,
  `deskripsi`    text         NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: paket_skincare
-- ============================================================
CREATE TABLE `paket_skincare` (
  `id_paket`     int(11)      NOT NULL AUTO_INCREMENT,
  `nama_paket`   varchar(100) NOT NULL,
  `jenis_kulit`  varchar(50)  NOT NULL,
  `masalah_kulit` varchar(100) NOT NULL,
  `deskripsi`    text         NOT NULL,
  `harga`        int(11)      NOT NULL,
  `gambar`       varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: detail_paket  (junction table: paket_skincare ↔ produk)
-- Fix: tambah PRIMARY KEY, tambah FOREIGN KEY ke paket_skincare & produk
-- ============================================================
CREATE TABLE `detail_paket` (
  `id_detail`  int(11) NOT NULL AUTO_INCREMENT,
  `id_paket`   int(11) NOT NULL,
  `id_produk`  int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_paket`  (`id_paket`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `fk_detail_paket`
    FOREIGN KEY (`id_paket`) REFERENCES `paket_skincare` (`id_paket`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_produk`
    FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: pembayaran
-- Fix: tambah FOREIGN KEY ke konsultasi
-- ============================================================
CREATE TABLE `pembayaran` (
  `id_pembayaran`       int(11)      NOT NULL AUTO_INCREMENT,
  `id_konsultasi`       int(11)      NOT NULL,
  `metode_pembayaran`   varchar(50)  NOT NULL,
  `status_pembayaran`   enum('pending','lunas','gagal') NOT NULL DEFAULT 'pending',
  `bukti_pembayaran`    varchar(255) DEFAULT NULL,
  `tanggal_pembayaran`  timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_konsultasi` (`id_konsultasi`),
  CONSTRAINT `fk_pembayaran_konsultasi`
    FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabel: hasil_analisis
-- Fix: tambah kolom yang bermakna, PRIMARY KEY, FK ke konsultasi
-- ============================================================
CREATE TABLE `hasil_analisis` (
  `id_analisis`    int(11)      NOT NULL AUTO_INCREMENT,
  `id_konsultasi`  int(11)      NOT NULL,
  `rekomendasi`    text         NOT NULL,
  `catatan`        text         DEFAULT NULL,
  `created_at`     timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_analisis`),
  KEY `id_konsultasi` (`id_konsultasi`),
  CONSTRAINT `fk_analisis_konsultasi`
    FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Data awal: akun admin default
-- Password: admin123 (simpan plaintext sesuai project ini)
-- ============================================================
INSERT INTO `user` (`username`, `password`, `role`) VALUES
('admin', 'admin123', 'admin');

COMMIT;
