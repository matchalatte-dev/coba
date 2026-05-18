<?php
include 'koneksi.php';
// ambil data konsultasi terbaru untuk ditampilkan di receipt
// join dengan tabel paket_skincare untuk mendapatkan nama paket, harga, dan gambar berdasarkan jenis kulit
// urutkan berdasarkan id konsultasi terbaru dan ambil 1 data saja
// hasil query akan disimpan di variabel $data untuk ditampilkan di halaman receipt
$query = mysqli_query(
  $conn,
  "SELECT konsultasi.*, paket_skincare.nama_paket, paket_skincare.harga, paket_skincare.gambar
   FROM konsultasi
   JOIN paket_skincare ON konsultasi.jenis_kulit = paket_skincare.jenis_kulit
   ORDER BY konsultasi.id DESC
   LIMIT 1"
);

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Receipt GlowGuide</title>

<style>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <title>Receipt GlowGuide</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body .glow-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
      }

      body .glow-navbar .nav-link,
      body .glow-navbar .nav-brand {
        font-weight: 700;
      }

      body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom, #ffd6e7, #fff5fa);
        padding: 40px;
        padding-top: 100px;
      }

      .container {
        max-width: 1000px;
        margin: auto;
      }

      .receipt-box {
        background: white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(255, 105, 180, 0.15);
      }

      .logo {
        text-align: center;
        font-size: 45px;
        font-weight: bold;
        color: #ff4f9a;
        margin-bottom: 10px;
      }

      .subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 40px;
      }

      .flex {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
      }

      .left-box,
      .right-box {
        flex: 1;
        background: #fff7fb;
        padding: 25px;
        border-radius: 25px;
      }

      .left-box h2,
      .right-box h2 {
        color: #ff4f9a;
        margin-bottom: 20px;
      }

      .item {
        margin-bottom: 18px;
      }

      .label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
      }

      .value {
        color: #666;
      }

      .product-img {
        width: 100%;
        max-width: 250px;
        border-radius: 20px;
        display: block;
        margin: auto;
        margin-bottom: 20px;
      }

      .package-name {
        text-align: center;
        font-size: 25px;
        color: #ff4f9a;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .price {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
      }

      button {
        background: #ff4f9a;
        color: white;
        border: none;
        padding: 14px 25px;
        border-radius: 14px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
      }

      button:hover {
        background: #e63e84;
      }

      .qris-box,
      .finish-box {
        display: none;
        margin-top: 25px;
        text-align: center;
      }

      .qris-box img {
        width: 250px;
      }

      .finish-box {
        background: #ffeaf3;
        padding: 20px;
        border-radius: 20px;
      }

      .finish-box h2 {
        color: #ff4f9a;
        margin-bottom: 10px;
      }

      .finish-box p {
        color: #555;
        line-height: 1.8;
      }

      @media (max-width: 768px) {
        .flex {
          flex-direction: column;
        }
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="receipt-box">
        <div class="logo">
          GlowGuide <i class="bi bi-stars"></i>
        </div>

        <div class="subtitle">Skin Consultation Receipt</div>

        <div class="flex">
          <div class="left-box">
            <h2>Detail Konsultasi</h2>

            <div class="item">
              <div class="label">Nama</div>
              <div class="value">
                <?php echo $data['nama']; ?>
              </div>
            </div>

            <div class="item">
              <div class="label">Email</div>
              <div class="value">
                <?php echo $data['email']; ?>
              </div>
            </div>

            <div class="item">
              <div class="label">Umur</div>
              <div class="value">
                <?php echo $data['umur']; ?> Tahun
              </div>
            </div>

            <div class="item">
              <div class="label">Jenis Kulit</div>
              <div class="value">
                <?php echo $data['jenis_kulit']; ?>
              </div>
            </div>

            <div class="item">
              <div class="label">Keluhan</div>
              <div class="value">
                <?php echo $data['keluhan']; ?>
              </div>
            </div>

            <hr style="margin: 20px 0; border: 1px solid #ffd1e3;" />

            <div class="item">
              <div class="label">Metode Pembayaran</div>
              <div class="value">QRIS</div>
            </div>

            <div class="item">
              <div class="label">Total Pembayaran</div>
              <div
                class="value"
                style="font-size: 25px; color: #ff4f9a; font-weight: bold;"
              >
                Rp <?php echo number_format($data['harga']); ?>
              </div>
            </div>
          </div>

          <div class="right-box">
            <h2>Paket Skincare</h2>

            <img
              src="images/<?php echo $data['gambar']; ?>"
              class="product-img"
              alt="Product"
            />

            <div class="package-name">
              <?php echo $data['nama_paket']; ?>
            </div>

            <div class="price">
              Rp <?php echo number_format($data['harga']); ?>
            </div>

            <button onclick="showQRIS()">Bayar Sekarang</button>

            <div class="qris-box" id="qrisBox">
              <img
                src="images/qris_pembayaran.jpeg"
                alt="QRIS Pembayaran"
              />

              <br /><br />

              <button onclick="finishPayment()">Saya Sudah Membayar</button>
            </div>

            <div class="finish-box" id="finishBox">
              <h2><i class="bi bi-stars"></i> Pembayaran Berhasil</h2>

              <p>
                Terimakasih sudah berkonsultasi kulit di GLOWGUIDE
                <i class="bi bi-heart-fill"></i>
                <br /><br />
                Kami tunggu perubahan baik kulitmu yaa
                <i class="bi bi-stars"></i>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function showQRIS() {
        document.getElementById("qrisBox").style.display = "block";
      }

      function finishPayment() {
        document.getElementById("finishBox").style.display = "block";
      }
    </script>
  </body>
</html>