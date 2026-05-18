<?php
include 'auth_check.php';
include 'koneksi.php';
// proses simpan data konsultasi
if (isset($_POST['simpan'])) {
    $nama          = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur          = (int) $_POST['umur'];
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $email         = mysqli_real_escape_string($conn, $_POST['email']);
    $profesi       = mysqli_real_escape_string($conn, $_POST['profesi']);
    $jenis_kulit   = mysqli_real_escape_string($conn, $_POST['jenis_kulit']);
    $keluhan       = mysqli_real_escape_string($conn, $_POST['keluhan']);

    mysqli_query($conn,
        "INSERT INTO konsultasi (nama, umur, jenis_kelamin, email, profesi, jenis_kulit, keluhan)
         VALUES ('$nama', '$umur', '$jenis_kelamin', '$email', '$profesi', '$jenis_kulit', '$keluhan')"
    );

    header("Location: konsultasi.php");
    exit();
}   
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konsultasi GLOWGUIDE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffe4ec 0%, #fff0f5 50%, #ffd6e7 100%);
            min-height: 100vh;
        }

        .page-title {
            text-align: center;
            color: #d63384;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
            padding-top: 36px;
        }

        .page-sub {
            text-align: center;
            color: #999;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-wrapper {
            max-width: 560px;
            margin: 0 auto;
            padding: 0 16px 60px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

    
        .card {
            background: white;
            border-radius: 20px;
            padding: 24px 28px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.12);
        }

        .card-title {
            font-size: 13px;
            font-weight: 600;
            color: #d63384;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, #ffb6c1, transparent);
        }

       
        .field {
            margin-bottom: 16px;
        }

        .field:last-child { margin-bottom: 0; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #888;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #ffd6e7;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #333;
            background: #fff8fb;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #d63384;
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.1);
            background: white;
        }

        textarea { resize: vertical; min-height: 100px; }

        .radio-group {
            display: flex;
            gap: 12px;
        }

        .radio-option {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px;
            border: 1.5px solid #ffd6e7;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            color: #555;
            transition: all 0.2s;
            background: #fff8fb;
        }

        .radio-option input[type="radio"] { display: none; }

        .radio-option:has(input:checked) {
            border-color: #d63384;
            background: #ffeef6;
            color: #d63384;
            font-weight: 600;
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.1);
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .payment-badge {
            background: linear-gradient(135deg, #d63384, #ff6eb4);
            color: white;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .payment-label { font-size: 13px; opacity: 0.85; }
        .payment-amount { font-size: 22px; font-weight: 700; }

        .upload-area {
            border: 2px dashed #ffc0d8;
            border-radius: 14px;
            padding: 22px;
            text-align: center;
            background: #fff8fb;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-area:hover { border-color: #d63384; background: #ffeef6; }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon { font-size: 32px; margin-bottom: 6px; }
        .upload-text { font-size: 13px; color: #aaa; }
        .upload-text strong { color: #d63384; }

        .resep-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .resep-tag {
            background: #ffeef6;
            color: #d63384;
            border: 1px solid #ffb6c1;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .resep-note {
            font-size: 12px;
            color: #bbb;
            margin-top: 10px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #d63384, #ff6eb4);
            color: white;
            border: none;
            border-radius: 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 4px 15px rgba(214, 51, 132, 0.35);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(214, 51, 132, 0.45);
        }

        .btn-submit:active { transform: translateY(0); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 4px;
            color: #d63384;
            text-decoration: none;
            font-size: 13px;
        }

        .back-link:hover { text-decoration: underline; }

        @media (max-width: 480px) {
            .row { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <h1 class="page-title"><i class="bi bi-heart-fill"></i> Form Konsultasi</h1>
    <p class="page-sub">Isi data lengkap untuk mendapatkan rekomendasi skincare terbaik</p>

    <form method="POST" action="tambah.php" enctype="multipart/form-data">
        <div class="form-wrapper">


            <div class="card">
                <div class="card-title"><i class="bi bi-person-fill"></i> Data Diri</div>

                <div class="field">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="row">
                    <div class="field">
                        <label>Umur</label>
                        <input type="number" name="umur" placeholder="Tahun" min="10" max="99" required>
                    </div>
                    <div class="field">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" checked>
                                <i class="bi bi-gender-female"></i> Perempuan
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki">
                                <i class="bi bi-gender-male"></i> Laki-laki
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@kamu.com" required>
                    </div>
                    <div class="field">
                        <label>Profesi</label>
                        <input type="text" name="profesi" placeholder="Pelajar, Mahasiswa, dll">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title"><i class="bi bi-flower1"></i> Kondisi Kulit</div>

                <div class="field">
                    <label>Jenis Kulit</label>
                    <select name="jenis_kulit" required>
                        <option value="">-- Pilih jenis kulit --</option>
                        <option value="Kering">Kulit Kering</option>
                        <option value="Berminyak">Kulit Berminyak</option>
                        <option value="Kombinasi">Kulit Kombinasi</option>
                        <option value="Sensitif">Kulit Sensitif</option>
                        <option value="Normal">Kulit Normal</option>
                    </select>
                </div>

                <div class="field">
                    <label>Keluhan Kulit</label>
                    <textarea name="keluhan" placeholder="Ceritakan keluhan kulitmu, misalnya: jerawat di dahi, kulit kusam, dll..." required></textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-title"><i class="bi bi-credit-card-fill"></i> Pembayaran</div>

                <div class="payment-badge">
                    <div>
                        <div class="payment-label">Biaya Konsultasi</div>
                        <div class="payment-amount">Rp 50.000</div>
                    </div>
                    <div style="font-size:36px;"><i class="bi bi-heart-fill"></i></div>
                </div>

                <div class="field">
                    <label>Upload Bukti Pembayaran</label>
                    <div class="upload-area">
                        <input type="file" name="bukti_pembayaran" accept="image/*">
                        <div class="upload-icon"><i class="bi bi-paperclip"></i></div>
                        <div class="upload-text">
                            <strong>Klik untuk upload</strong> atau drag & drop<br>
                            JPG, PNG (maks. 2MB)
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title"><i class="bi bi-capsule"></i> Saya Akan Meresepkan</div>
                <div class="resep-list">
                    <span class="resep-tag"><i class="bi bi-cup"></i> Cuci Muka</span>
                    <span class="resep-tag"><i class="bi bi-moon-fill"></i> Krim Malam</span>
                    <span class="resep-tag"><i class="bi bi-sun-fill"></i> Krim Pagi</span>
                    <span class="resep-tag"><i class="bi bi-droplet-fill"></i> Toner</span>
                    <span class="resep-tag"><i class="bi bi-sliders2"></i> Krim Oles Jerawat</span>
                </div>
                <p class="resep-note">* Rekomendasi produk akan disesuaikan dengan jenis kulit dan keluhanmu setelah konsultasi diproses.</p>
            </div>

            <button type="submit" name="simpan" class="btn-submit">
                <i class="bi bi-stars"></i> Kirim Konsultasi
            </button>
            <a href="konsultasi.php" class="back-link">← Kembali ke Daftar Konsultasi</a>

        </div>
    </form>

</body>

</html>