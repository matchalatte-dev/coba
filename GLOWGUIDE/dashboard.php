<?php include 'auth_check.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – GLOWGUIDE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink-50: #FBEAF0; --pink-100: #F4C0D1; --pink-200: #ED93B1; --pink-400: #D4537E; --pink-600: #993556; --pink-800: #72243E;
            --teal-50: #E1F5EE; --teal-100: #9FE1CB; --teal-400: #1D9E75; --teal-600: #0F6E56; --teal-800: #085041;
            --amber-50: #FAEEDA; --amber-100: #FAC775; --amber-400: #BA7517; --amber-600: #854F0B; --amber-800: #633806;
            --purple-50: #EEEDFE; --purple-100: #CECBF6; --purple-400: #7F77DD; --purple-600: #534AB7; --purple-800: #3C3489;
            --coral-50: #FAECE7; --coral-100: #F5C4B3; --coral-400: #D85A30; --coral-600: #993C1D; --coral-800: #712B13;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff0f6 0%, #fdf2f8 50%, #f0f4ff 100%);
            min-height: 100vh;
            color: #2c2c2a;
            padding-bottom: 60px;
        }

        
        .hero { text-align: center; padding: 60px 20px 30px; }
        .hero h1 { font-size: 32px; font-weight: 700; color: #d63384; margin-bottom: 8px; font-family: 'Playfair Display', serif; }
        .hero p { color: #888; font-size: 14px; }

        .menu-grid {
            display: flex; justify-content: center; flex-wrap: wrap;
            gap: 20px; max-width: 900px; margin: 0 auto 50px; padding: 0 20px;
        }

        .menu-card {
            background: white; border-radius: 20px; padding: 25px; width: 180px;
            text-align: center; box-shadow: 0 4px 15px rgba(214, 51, 132, 0.1);
            text-decoration: none; color: #333; transition: 0.3s; position: relative; overflow: hidden;
        }

        .menu-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #d63384, #ff6eb4); }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(214, 51, 132, 0.2); }
        .menu-icon { font-size: 36px; margin-bottom: 10px; display: block; }
        .menu-label { font-size: 14px; font-weight: 600; }

       
        .section-header { text-align: center; margin-bottom: 3rem; }
        .section-header h2 { font-family: 'Playfair Display', serif; font-size: 2.4rem; color: var(--pink-800); }
        .section-header .divider { width: 60px; height: 3px; background: linear-gradient(to right, var(--pink-400), var(--purple-400)); border-radius: 2px; margin: 1rem auto; }

       
        .cards-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .skin-card {
            flex: 0 1 350px; 
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            transition: 0.3s;
            position: relative;
        }

        .skin-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(0,0,0,0.14); }

        
        .skin-img { width: 100%; height: 180px; object-fit: cover; display: block; }
        .card-header { padding: 1.6rem 1.8rem; display: flex; align-items: center; gap: 1rem; color: white; }
        .card-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: rgba(255,255,255,0.25); }
        .card-title-wrap h3 { font-family: 'Playfair Display', serif; font-size: 1.3rem; }
        .card-title-wrap p { font-size: 0.8rem; opacity: 0.9; }

        .card-body { padding: 0 1.8rem 1.8rem; }
        .detail-box { max-height: 0; overflow: hidden; transition: all 0.5s ease; }
        .skin-card.active .detail-box { max-height: 1000px; margin-top: 15px; }

        .card-desc { font-size: 0.82rem; line-height: 1.6; color: #5F5E5A; padding-top: 1rem; border-top: 1px solid #f0ece8; margin-bottom: 1rem; }
        .product-item { display: flex; align-items: flex-start; gap: 0.7rem; padding: 0.6rem 0.8rem; border-radius: 10px; font-size: 0.8rem; margin-bottom: 8px; }
        .product-label { font-weight: 600; display: block; }
        
        .detail-btn { width: 100%; border: none; padding: 12px; border-radius: 12px; cursor: pointer; font-weight: 600; margin-top: 15px; transition: 0.3s; }
        .detail-btn:hover { transform: scale(1.02); }

       
        .card-sensitif .card-header { background: linear-gradient(135deg, var(--pink-400), var(--pink-600)); }
        .card-sensitif .product-item { background: var(--pink-50); color: var(--pink-800); }
        .card-sensitif .detail-btn { background: var(--pink-100); color: var(--pink-800); }

        .card-jerawat .card-header { background: linear-gradient(135deg, var(--teal-400), var(--teal-600)); }
        .card-jerawat .product-item { background: var(--teal-50); color: var(--teal-800); }
        .card-jerawat .detail-btn { background: var(--teal-100); color: var(--teal-800); }

        .card-berminyak .card-header { background: linear-gradient(135deg, var(--amber-400), var(--amber-600)); }
        .card-berminyak .product-item { background: var(--amber-50); color: var(--amber-800); }
        .card-berminyak .detail-btn { background: var(--amber-100); color: var(--amber-800); }

        .card-kering .card-header { background: linear-gradient(135deg, var(--purple-400), var(--purple-600)); }
        .card-kering .product-item { background: var(--purple-50); color: var(--purple-800); }
        .card-kering .detail-btn { background: var(--purple-100); color: var(--purple-800); }

        .card-kombinasi .card-header { background: linear-gradient(135deg, var(--coral-400), var(--coral-600)); }
        .card-kombinasi .product-item { background: var(--coral-50); color: var(--coral-800); }
        .card-kombinasi .detail-btn { background: var(--coral-100); color: var(--coral-800); }

        @media (max-width: 768px) {
            .skin-card { flex: 0 1 100%; }
            .menu-card { width: 45%; }
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="hero">
        <h1>Selamat Datang! <i class="bi bi-heart-fill"></i></h1>
        <p>Kelola konsultasi skincare dari sini</p>
    </div>

    <div class="menu-grid">
        <a href="konsultasi.php" class="menu-card">
            <span class="menu-icon"><i class="bi bi-list-check"></i></span>
            <div class="menu-label">Data Konsultasi</div>
        </a>
        <a href="tambah.php" class="menu-card">
            <span class="menu-icon"><i class="bi bi-plus-circle-fill"></i></span>
            <div class="menu-label">Tambah Baru</div>
        </a>
        <a href="receipt.php" class="menu-card">
            <span class="menu-icon"><i class="bi bi-receipt"></i></span>
            <div class="menu-label">Receipt</div>
        </a>
        <a href="progress.php" class="menu-card">
            <span class="menu-icon"><i class="bi bi-graph-up-arrow"></i></span>
            <div class="menu-label">Progress</div>
        </a>
        <a href="logout.php" class="menu-card">
            <span class="menu-icon"><i class="bi bi-door-closed"></i></span>
            <div class="menu-label">Logout</div>
        </a>
    </div>

    <div class="section-header">
        <h2><i class="bi bi-stars"></i> Panduan Perawatan Kulit</h2>
        <div class="divider"></div>
        <p>Pilih jenis kulitmu dan temukan rekomendasi terbaik</p>
    </div>

    <div class="cards-grid">
        <div class="skin-card card-sensitif">
            <img src="images/paket_k.sensitif.png" class="skin-img">
            <div class="card-header"><div class="card-icon"><i class="bi bi-flower1"></i></div><div class="card-title-wrap"><h3>Kulit Sensitif</h3><p>Mudah iritasi & lembut</p></div></div>
            <div class="card-body">
                <button class="detail-btn" onclick="toggleDetail(this)">Lihat Detail</button>
                <div class="detail-box">
                    <p class="card-desc">Formula lembut untuk menenangkan kulit yang mudah kemerahan.</p>
                    <div class="products-list">
                        <div class="product-item"><span><i class="bi bi-sun-fill"></i></span><div><span class="product-label">Krim Pagi</span><span class="product-detail">Centella Asiatica</span></div></div>
                        <div class="product-item"><span><i class="bi bi-moon-fill"></i></span><div><span class="product-label">Krim Malam</span><span class="product-detail">Ceramide Barrier</span></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="skin-card card-jerawat">
            <img src="images/paket_k.berjerawat.png" class="skin-img">
            <div class="card-header"><div class="card-icon"><i class="bi bi-leaf"></i></div><div class="card-title-wrap"><h3>Kulit Berjerawat</h3><p>Bersih & Kontrol Sebum</p></div></div>
            <div class="card-body">
                <button class="detail-btn" onclick="toggleDetail(this)">Lihat Detail</button>
                <div class="detail-box">
                    <p class="card-desc">Fokus membersihkan pori-pori dan melawan bakteri penyebab jerawat.</p>
                    <div class="products-list">
                        <div class="product-item"><span><i class="bi bi-sun-fill"></i></span><div><span class="product-label">Krim Pagi</span><span class="product-detail">Salicylic Acid</span></div></div>
                        <div class="product-item"><span><i class="bi bi-moon-fill"></i></span><div><span class="product-label">Krim Malam</span><span class="product-detail">Tea Tree Oil</span></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="skin-card card-berminyak">
            <img src="images/paket_k.berminyak.png" class="skin-img">
            <div class="card-header"><div class="card-icon"><i class="bi bi-stars"></i></div><div class="card-title-wrap"><h3>Kulit Berminyak</h3><p>Wajah Segar & Matte</p></div></div>
            <div class="card-body">
                <button class="detail-btn" onclick="toggleDetail(this)">Lihat Detail</button>
                <div class="detail-box">
                    <p class="card-desc">Mengontrol minyak berlebih agar wajah tidak tampak mengilap.</p>
                    <div class="products-list">
                        <div class="product-item"><span><i class="bi bi-sun-fill"></i></span><div><span class="product-label">Krim Pagi</span><span class="product-detail">Niacinamide Control</span></div></div>
                        <div class="product-item"><span><i class="bi bi-droplet-fill"></i></span><div><span class="product-label">Moisturizer</span><span class="product-detail">Gel Ringan</span></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="skin-card card-kering">
            <img src="images/paket_k.kering.png" class="skin-img">
            <div class="card-header"><div class="card-icon">🌷</div><div class="card-title-wrap"><h3>Kulit Kering</h3><p>Hidrasi Maksimal</p></div></div>
            <div class="card-body">
                <button class="detail-btn" onclick="toggleDetail(this)">Lihat Detail</button>
                <div class="detail-box">
                    <p class="card-desc">Mengunci kelembapan agar kulit tetap kenyal dan tidak mengelupas.</p>
                    <div class="products-list">
                        <div class="product-item"><span><i class="bi bi-sun-fill"></i></span><div><span class="product-label">Krim Pagi</span><span class="product-detail">Hyaluronic Acid</span></div></div>
                        <div class="product-item"><span><i class="bi bi-moon-fill"></i></span><div><span class="product-label">Krim Malam</span><span class="product-detail">Shea Butter Night</span></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="skin-card card-kombinasi">
            <img src="images/paket_k.kombinasi.png" class="skin-img">
            <div class="card-header"><div class="card-icon">⚖️</div><div class="card-title-wrap"><h3>Kulit Kombinasi</h3><p>Seimbang & Segar</p></div></div>
            <div class="card-body">
                <button class="detail-btn" onclick="toggleDetail(this)">Lihat Detail</button>
                <div class="detail-box">
                    <p class="card-desc">Menyeimbangkan hidrasi pada area pipi dan kontrol minyak di T-zone.</p>
                    <div class="products-list">
                        <div class="product-item"><span><i class="bi bi-sun-fill"></i></span><div><span class="product-label">Krim Pagi</span><span class="product-detail">Balancing Formula</span></div></div>
                        <div class="product-item"><span><i class="bi bi-droplet-fill"></i></span><div><span class="product-label">Moisturizer</span><span class="product-detail">Water-based Cream</span></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetail(button){
            let card = button.closest('.skin-card');
            card.classList.toggle('active');
            button.innerHTML = card.classList.contains('active') ? "Tutup Detail" : "Lihat Detail";
        }
    </script>

</body>
</html>