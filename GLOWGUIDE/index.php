<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>GLOWGUIDE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;

            background:
                linear-gradient(120deg,
                    #ffe4ec,
                    #fff0f5,
                    #ffd6e7,
                    #fff0f5);

            background-size: 300% 300%;
            animation: shimmerBg 8s ease infinite;

            overflow-x: hidden;
        }

        
        .sparkle {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            pointer-events: none;

            background-image:
                radial-gradient(white 2px, transparent 2px),
                radial-gradient(pink 1px, transparent 1px),
                radial-gradient(#ffb6c1 2px, transparent 2px);

            background-size: 100px 100px;
            background-position: 0 0, 50px 50px, 25px 25px;

            animation: sparkleMove 6s linear infinite;

            opacity: 0.7;
            z-index: 0;
        }

        @keyframes sparkleMove {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(50px);
            }
        }

        @keyframes shimmerBg {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* NAVBAR */
        .custom-navbar {
            background-color: #ffb6c1;
            padding: 15px;

            animation: glow 2s infinite alternate;

            position: relative;
            z-index: 2;
        }

        @keyframes glow {
            from {
                box-shadow:
                    0 0 5px white,
                    0 0 10px pink;
            }

            to {
                box-shadow:
                    0 0 15px white,
                    0 0 25px hotpink;
            }
        }

        /* HERO */
        .hero {
            text-align: center;
            margin-top: 60px;

            position: relative;
            z-index: 1;
        }

        .logo {
            width: 220px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 45px;
            color: #d63384;
        }

        .hero p {
            color: #555;
            font-size: 18px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;

            margin-top: 50px;
            margin-bottom: 50px;

            position: relative;
            z-index: 1;
        }

        .card {
            background: white;
            width: 220px;

            border-radius: 20px;
            padding: 15px;

            text-align: center;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

            cursor: pointer;

            transition: 0.3s;

            overflow: hidden;

            position: relative;
        }

        .card:hover {
            transform: scale(1.05);

            box-shadow:
                0 0 15px white,
                0 0 25px pink,
                0 0 35px #ffb6c1;
        }

        .card::before {
            content: "";

            position: absolute;

            top: 0;
            left: -100px;

            width: 50px;
            height: 100%;

            background: rgba(255, 255, 255, 0.5);

            transform: skewX(-20deg);

            animation: cardShimmer 3s infinite;
        }

        @keyframes cardShimmer {
            100% {
                left: 300px;
            }
        }

    
        .card img {
            width: 100%;
            height: 170px;

            object-fit: cover;

            border-radius: 15px;

            display: block;
        }

      
        .card h3 {
            margin-top: 15px;
            color: #d63384;
        }

        .card p {
            color: #555;
        }

       
        .detail {
            display: none;

            margin-top: 10px;

            background: #fff0f5;

            padding: 10px;

            border-radius: 10px;

            font-size: 14px;

            color: #777;
        }
    </style>
</head>

<body>

    <div class="sparkle"></div>

    
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">

        <div class="container-fluid">

            <a class="navbar-brand fw-bold text-white" href="#">
                <i class="bi bi-heart-fill"></i> GLOWGUIDE
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#skin">
                            Skin Type
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="register.php">
                            Register
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

   
    <div class="hero">

        <img src="images/logo.jpeg" class="logo">

        <h1>HELLO GLOWIS!</h1>

        <p>
            Ingin tahu solusi kulit sehatmu <br>
            kunjungi kami dengan klik dibawah sini <i class="bi bi-stars"></i>
        </p>

    </div>

   
    <div class="card-container" id="skin">

        <div class="card" onclick="toggleDetail('kering')">

            <img src="images/kulit_kering.jpg">

            <h3>Kulit Kering</h3>

            <p>Butuh hidrasi ekstra <i class="bi bi-droplet-fill"></i></p>

            <div class="detail" id="kering">
                Kulit terasa kasar, kaku, dan mudah mengelupas.
            </div>

        </div>

        <div class="card" onclick="toggleDetail('berminyak')">

            <img src="images/kulit_berminyak.jpg">

            <h3>Kulit Berminyak</h3>

            <p>Kontrol minyak <i class="bi bi-stars"></i></p>

            <div class="detail" id="berminyak">
                Wajah mudah berminyak dan rentan muncul jerawat.
            </div>

        </div>

        <div class="card" onclick="toggleDetail('kombinasi')">

            <img src="images/kulit_kombinasi.jpg">

            <h3>Kulit Kombinasi</h3>

            <p>Seimbang & tricky 😆</p>

            <div class="detail" id="kombinasi">
                Area T-zone berminyak tetapi pipi terasa kering.
            </div>

        </div>

        <div class="card" onclick="toggleDetail('jerawat')">

            <img src="images/kulit_berjerawat.jpg">

            <h3>Kulit Berjerawat</h3>

            <p>Butuh perawatan anti acne <i class="bi bi-flower1"></i></p>

            <div class="detail" id="jerawat">
                Kulit rentan jerawat, kemerahan, dan bekas noda.
            </div>

        </div>
<!-- toggle detail -->
        <div class="card" onclick="toggleDetail('sensitif')">

            <img src="images/kulit_sensitif.jpg">

            <h3>Kulit Sensitif</h3>

            <p>Butuh skincare yang lembut <i class="bi bi-heart-fill"></i></p>

            <div class="detail" id="sensitif">
                Mudah iritasi, kemerahan, dan terasa perih.
            </div>

        </div>

    </div>

    <script>
// fungsi untuk toggle detail
        function toggleDetail(id) {

            var detail = document.getElementById(id);

            if (detail.style.display === "block") {
                detail.style.display = "none";
            } else {
                detail.style.display = "block";
            }

        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>