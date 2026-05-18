<?php
include 'auth_check.php';
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM konsultasi ORDER BY created_at DESC");


function getResep($jenis_kulit) {
    $resep = [
        'Kering'    => ['<i class="bi bi-cup"></i> Cuci Muka Gentle',   '<i class="bi bi-sun-fill"></i> Krim Pagi SPF', '<i class="bi bi-moon-fill"></i> Krim Malam Intensif', '<i class="bi bi-droplet-fill"></i> Toner Hydrating',     '<i class="bi bi-stars"></i> Serum Hyaluronic'],
        'Berminyak' => ['<i class="bi bi-cup"></i> Sabun Oil Control',   '<i class="bi bi-droplet-fill"></i> Toner Balancing', '<i class="bi bi-moon-fill"></i> Krim Malam Ringan',  '<i class="bi bi-sliders2"></i> Krim Oles Jerawat',  '<i class="bi bi-stars"></i> Serum Niacinamide'],
        'Kombinasi' => ['<i class="bi bi-cup"></i> Cuci Muka',           '<i class="bi bi-sun-fill"></i> Krim Pagi',       '<i class="bi bi-moon-fill"></i> Krim Malam',         '<i class="bi bi-droplet-fill"></i> Toner',              '<i class="bi bi-sliders2"></i> Krim Oles Jerawat'],
        'Sensitif'  => ['<i class="bi bi-cup"></i> Cuci Muka Hypoallergenic', '<i class="bi bi-sun-fill"></i> Krim Pagi SPF Mineral', '<i class="bi bi-moon-fill"></i> Krim Malam Soothing', '<i class="bi bi-droplet-fill"></i> Toner Bebas Alkohol', '<i class="bi bi-stars"></i> Serum Centella'],
        'Normal'    => ['<i class="bi bi-cup"></i> Cuci Muka',           '<i class="bi bi-sun-fill"></i> Krim Pagi SPF',   '<i class="bi bi-moon-fill"></i> Krim Malam',         '<i class="bi bi-droplet-fill"></i> Toner',              '<i class="bi bi-stars"></i> Vitamin C Serum'],
    ];
    return $resep[$jenis_kulit] ?? ['<i class="bi bi-cup"></i> Cuci Muka', '<i class="bi bi-moon-fill"></i> Krim Malam', '<i class="bi bi-sun-fill"></i> Krim Pagi', '<i class="bi bi-droplet-fill"></i> Toner', '<i class="bi bi-sliders2"></i> Krim Oles Jerawat'];
}

function getSkinColor($jenis_kulit) {
    $colors = [
        'Kering'    => ['bg' => '#e8f4ff', 'text' => '#1a7abf', 'border' => '#b3d9f5'],
        'Berminyak' => ['bg' => '#fff8e1', 'text' => '#b8860b', 'border' => '#ffe082'],
        'Kombinasi' => ['bg' => '#f3e5f5', 'text' => '#7b1fa2', 'border' => '#ce93d8'],
        'Sensitif'  => ['bg' => '#fce4ec', 'text' => '#c62828', 'border' => '#f48fb1'],
        'Normal'    => ['bg' => '#e8f5e9', 'text' => '#2e7d32', 'border' => '#a5d6a7'],
    ];
    return $colors[$jenis_kulit] ?? ['bg' => '#fce4ec', 'text' => '#d63384', 'border' => '#ffb6c1'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Konsultasi – GLOWGUIDE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffe4ec 0%, #fff0f5 50%, #ffd6e7 100%);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #d63384, #ff6eb4);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 20px rgba(214,51,132,0.3);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .navbar-brand { color: white; font-size: 18px; font-weight: 700; text-decoration: none; }

        .navbar-actions { display: flex; gap: 10px; }

        .btn-nav {
            padding: 8px 18px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-nav-white {
            background: white;
            color: #d63384;
        }

        .btn-nav-white:hover { background: #ffeef6; transform: translateY(-1px); }

        .btn-nav-outline {
            background: transparent;
            color: white;
            border: 1.5px solid rgba(255,255,255,0.6);
        }

        .btn-nav-outline:hover { background: rgba(255,255,255,0.15); }

        .page-header {
            text-align: center;
            padding: 36px 16px 20px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #d63384;
        }

        .page-header p { color: #aaa; font-size: 14px; margin-top: 4px; }

      
        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 0 auto 32px;
            padding: 0 16px;
            max-width: 700px;
            flex-wrap: wrap;
        }

        .stat-pill {
            background: white;
            padding: 10px 22px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .stat-pill strong { color: #d63384; }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 22px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px 60px;
        }

        
        .consult-card {
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(214,51,132,0.10);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .consult-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(214,51,132,0.18);
        }

       
        .card-strip {
            height: 6px;
            background: linear-gradient(90deg, #d63384, #ff6eb4);
        }

        .card-body { padding: 20px; }

     
        .card-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd6e7, #ffb6c1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .nama-block { flex: 1; margin-left: 12px; }

        .nama-block h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2a2a2a;
            line-height: 1.2;
        }

        .nama-block span {
            font-size: 12px;
            color: #aaa;
        }

        .skin-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 16px;
        }

        .info-item {
            background: #fafafa;
            border-radius: 10px;
            padding: 9px 12px;
        }

        .info-item .info-label {
            font-size: 10px;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-item .info-val {
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

       
        .keluhan-box {
            background: #fff8fb;
            border-left: 3px solid #ffb6c1;
            border-radius: 0 10px 10px 0;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }

        .divider {
            border: none;
            border-top: 1px dashed #ffe0ee;
            margin: 14px 0;
        }

       
        .resep-title {
            font-size: 12px;
            font-weight: 700;
            color: #d63384;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 10px;
        }

        .resep-items {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 16px;
        }

        .resep-item {
            background: #ffeef6;
            color: #d63384;
            border: 1px solid #ffcce0;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 500;
        }
         .qris-img{
    width: 120px;
    border-radius: 12px;
    margin-bottom: 10px;
    border: 2px solid rgba(255,255,255,0.3);
    background: white;
    padding: 5px;
}
       
        .payment-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #d63384, #ff6eb4);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 14px;
            color: white;
        }

        .payment-row .pay-label { font-size: 11px; opacity: 0.85; }
        .payment-row .pay-amount { font-size: 18px; font-weight: 700; }
        .payment-row .pay-status {
            background: rgba(255,255,255,0.25);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .card-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            flex: 1;
            padding: 9px;
            border-radius: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #fff0f5;
            color: #d63384;
            border: 1.5px solid #ffb6c1;
        }

        .btn-edit:hover { background: #ffd6e7; }

        .btn-hapus {
            background: #fff0f0;
            color: #e53e3e;
            border: 1.5px solid #fed7d7;
        }

        .btn-hapus:hover { background: #fed7d7; }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .empty-state .empty-icon { font-size: 64px; margin-bottom: 16px; }
        .empty-state h3 { color: #ccc; font-size: 18px; }
        .empty-state p { color: #ddd; font-size: 14px; margin-top: 6px; }
        .empty-state a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #d63384, #ff6eb4);
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }
            .navbar-brand { font-size: 15px; }
        }

    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    
    <div class="page-header">
        <h1><i class="bi bi-list-check"></i> Data Konsultasi</h1>
        <p>Daftar semua konsultasi yang masuk</p>
    </div>

    <?php
   
    $total = mysqli_num_rows($data);
    mysqli_data_seek($data, 0); 
    ?>

    <div class="stats-bar">
        <div class="stat-pill">Total Konsultasi: <strong><?= $total ?></strong></div>
        <div class="stat-pill">Biaya/sesi: <strong>Rp 50.000</strong></div>
        <div class="stat-pill">Total Pendapatan: <strong>Rp <?= number_format($total * 50000, 0, ',', '.') ?></strong></div>
    </div>

    
    <div class="grid">

        <?php if ($total == 0): ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-flower1"></i></div>
                <h3>Belum ada konsultasi</h3>
                <p>Tambahkan konsultasi pertama sekarang!</p>
                <a href="tambah.php"><i class="bi bi-plus-circle-fill"></i> Tambah Konsultasi</a>
            </div>
        <?php else: ?>

        <?php while ($d = mysqli_fetch_array($data)):
            $resep      = getResep($d['jenis_kulit']);
            $skinColor  = getSkinColor($d['jenis_kulit']);
            $avatar     = ($d['jenis_kelamin'] == 'Laki-laki') ? '<i class="bi bi-person-fill"></i>' : '<i class="bi bi-person-fill"></i>';
            $tanggal    = isset($d['created_at']) ? date('d M Y', strtotime($d['created_at'])) : '-';
        ?>

        <div class="consult-card">
            <div class="card-strip"></div>
            <div class="card-body">

               
                <div class="card-header-row">
                    <div class="avatar"><?= $avatar ?></div>
                    <div class="nama-block">
                        <h3><?= htmlspecialchars($d['nama']) ?></h3>
                        <span><?= htmlspecialchars($d['email'] ?? '-') ?></span>
                    </div>
                    <span class="skin-badge" style="background:<?= $skinColor['bg'] ?>;color:<?= $skinColor['text'] ?>;border:1px solid <?= $skinColor['border'] ?>">
                        <?= $d['jenis_kulit'] ?>
                    </span>
                </div>

                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Umur</div>
                        <div class="info-val"><?= $d['umur'] ?> tahun</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-val"><?= htmlspecialchars($d['jenis_kelamin'] ?? '-') ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Profesi</div>
                        <div class="info-val"><?= htmlspecialchars($d['profesi'] ?? '-') ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Tanggal</div>
                        <div class="info-val"><?= $tanggal ?></div>
                    </div>
                </div>

               
                <div class="keluhan-box">
                    <strong style="font-size:11px;color:#d63384;text-transform:uppercase;letter-spacing:.5px;">Keluhan:</strong><br>
                    <?= htmlspecialchars($d['keluhan']) ?>
                </div>

                <hr class="divider">

               
                <div class="resep-title">💊 Saya Akan Meresepkan</div>
                <div class="resep-items">
                    <?php foreach ($resep as $item): ?>
                        <span class="resep-item"><?= $item ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="payment-row">
                    <div>
                         <img src="images/qris_pembayaran.jpeg" class="qris-img">
                        <div class="pay-label"> Biaya Konsultasi  </div>
                        <div class="pay-amount">Rp 50.000</div>
                    </div>
                    <div class="pay-status">💳 Lunas</div>
                </div>
                
                
                <div class="card-actions">
                    <a href="edit.php?id=<?= $d['id'] ?>" class="btn-action btn-edit">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $d['id'] ?>"
                       class="btn-action btn-hapus"
                       onclick="return confirm('Yakin ingin menghapus konsultasi <?= addslashes(htmlspecialchars($d['nama'])) ?>?')">
                        🗑️ Hapus
                    </a>
                </div>

            </div>
        </div>

        <?php endwhile; ?>
        <?php endif; ?>

    </div>

</body>

</html>