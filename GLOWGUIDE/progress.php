<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $id_konsultasi = $_POST['id_konsultasi'];

  $cleanser = isset($_POST['cleanser']) ? "Sudah" : "Belum";
  $moisturizer = isset($_POST['moisturizer']) ? "Sudah" : "Belum";
  $sunscreen = isset($_POST['sunscreen']) ? "Sudah" : "Belum";
  $air_putih = isset($_POST['air_putih']) ? "Sudah" : "Belum";
  $tidur = isset($_POST['tidur']) ? "Sudah" : "Belum";
  $makanan = isset($_POST['makanan']) ? "Sudah" : "Belum";
  $catatan = $_POST['catatan'];

  mysqli_query(
    $conn,
    "INSERT INTO progress_tracker
     VALUES('', '$id_konsultasi', '$cleanser', '$moisturizer', '$sunscreen', '$air_putih', '$tidur', '$makanan', '$catatan', CURRENT_TIMESTAMP)"
  );

  echo "<script>alert('Progress berhasil disimpan!');</script>";
}

$konsultasi = mysqli_query($conn, "SELECT * FROM konsultasi ORDER BY id DESC LIMIT 1");
$user = mysqli_fetch_array($konsultasi);

?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <title>Progress Tracker</title>
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
        font-family: Arial;
        background: #fff7fb;
        padding: 30px;
        padding-top: 90px;
        margin: 0;
        overflow-x: hidden;
      }

      .container {
        max-width: 900px;
        margin: auto;
      }

      .title {
        text-align: center;
        color: #ff4f9a;
        margin-bottom: 30px;
      }

      .box {
        background: white;
        padding: 25px;
        border-radius: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(255, 105, 180, 0.1);
      }

      .box h2 {
        color: #ff4f9a;
        margin-bottom: 20px;
      }

      .user-info {
        background: #fff0f6;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
      }

      label {
        display: block;
        margin-bottom: 15px;
        color: #444;
      }

      textarea {
        width: 100%;
        border: 1px solid #ffc0d9;
        border-radius: 15px;
        padding: 15px;
        margin-top: 15px;
        resize: none;
      }

      button {
        background: #ff4f9a;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        margin-top: 20px;
        cursor: pointer;
      }

      button:hover {
        background: #e63e84;
      }

      .history {
        background: #fff0f6;
        padding: 15px;
        border-radius: 15px;
        margin-top: 15px;
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <h1 class="title">
        <i class="bi bi-stars"></i> GlowGuide Progress Tracker
      </h1>

      <div class="box">
        <h2>Informasi User</h2>
        <div class="user-info">
          <b>Nama :</b>
          <?php echo $user['nama']; ?>
          <br /><br />
          <b>Jenis Kulit :</b>
          <?php echo $user['jenis_kulit']; ?>
        </div>

        <form method="POST">
          <input
            type="hidden"
            name="id_konsultasi"
            value="<?php echo $user['id']; ?>"
          />

          <label>
            <input type="checkbox" name="cleanser" />
            Membersihkan wajah pagi & malam
          </label>

          <label>
            <input type="checkbox" name="moisturizer" />
            Menggunakan moisturizer
          </label>

          <label>
            <input type="checkbox" name="sunscreen" />
            Menggunakan sunscreen
          </label>

          <label>
            <input type="checkbox" name="air_putih" />
            Minum air putih cukup
          </label>

          <label>
            <input type="checkbox" name="tidur" />
            Tidur cukup
          </label>

          <label>
            <input type="checkbox" name="makanan" />
            Mengurangi makanan berminyak
          </label>

          <textarea
            name="catatan"
            rows="5"
            placeholder="Tulis perkembangan kulitmu di sini..."
          ></textarea>

          <button type="submit" name="simpan">Simpan Progress</button>
        </form>
      </div>

      <div class="box">
        <h2><i class="bi bi-graph-up-arrow"></i> History Progress</h2>

        <?php
        $data = mysqli_query(
          $conn,
          "SELECT progress_tracker.*, konsultasi.nama, konsultasi.jenis_kulit
           FROM progress_tracker
           JOIN konsultasi ON progress_tracker.id_konsultasi = konsultasi.id
           ORDER BY id_progress DESC"
        );

        while ($d = mysqli_fetch_array($data)) {
        ?>

        <div class="history">
          <b>Nama :</b>
          <?php echo $d['nama']; ?>
          <br /><br />
          <b>Jenis Kulit :</b>
          <?php echo $d['jenis_kulit']; ?>
          <br /><br />
          <b>Catatan :</b>
          <br />
          <?php echo $d['catatan']; ?>
          <br /><br />
          <b>Tanggal :</b>
          <?php echo $d['tanggal']; ?>
        </div>

        <?php } ?>
      </div>
    </div>
  </body>
</html>