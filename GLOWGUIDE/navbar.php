<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>

<nav class="glow-navbar">
  <a href="dashboard.php" class="nav-brand"
    ><i class="bi bi-heart-fill"></i> GLOWGUIDE</a
  >

  <button class="nav-toggle" onclick="toggleNav()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>

  <div class="nav-links" id="navLinks">
    <a
      href="dashboard.php"
      class="nav-link <?= $current == 'dashboard.php' ? 'active' : '' ?>"
    >
      <i class="bi bi-house-fill"></i> <span>Dashboard</span>
    </a>
    <a
      href="konsultasi.php"
      class="nav-link <?= $current == 'konsultasi.php' ? 'active' : '' ?>"
    >
      <i class="bi bi-list-check"></i> <span>Data Konsultasi</span>
    </a>
    <a
      href="tambah.php"
      class="nav-link <?= $current == 'tambah.php' ? 'active' : '' ?>"
    >
      <i class="bi bi-plus-circle-fill"></i> <span>Tambah</span>
    </a>
    <a
      href="receipt.php"
      class="nav-link <?= $current == 'receipt.php' ? 'active' : '' ?>"
    >
      <i class="bi bi-receipt"></i> <span>Receipt</span>
    </a>
    <a
      href="progress.php"
      class="nav-link <?= $current == 'progress.php' ? 'active' : '' ?>"
    >
      <i class="bi bi-graph-up-arrow"></i> <span>Progress</span>
    </a>
    <a href="logout.php" class="nav-link nav-logout">
      <i class="bi bi-door-closed"></i> <span>Logout</span>
    </a>
  </div>
</nav>

<style>
  .glow-navbar {
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 28px;
    height: 60px;
    background: linear-gradient(135deg, #d63384 0%, #ff6eb4 100%);
    box-shadow: 0 3px 20px rgba(214, 51, 132, 0.35);
  }

  .nav-brand {
    font-size: 18px;
    font-weight: 700;
    color: white;
    text-decoration: none;
    letter-spacing: 0.5px;
    white-space: nowrap;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .nav-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 30px;
    color: rgba(255, 255, 255, 0.88);
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    font-family: "Poppins", sans-serif;
    transition: background 0.2s, color 0.2s, transform 0.15s;
    white-space: nowrap;
  }

  .nav-link:hover {
    background: rgba(255, 255, 255, 0.18);
    color: white;
    transform: translateY(-1px);
  }

  .nav-link.active {
    background: rgba(255, 255, 255, 0.25);
    color: white;
    font-weight: 700;
    box-shadow: inset 0 0 0 1.5px rgba(255, 255, 255, 0.5);
  }

  .nav-logout {
    margin-left: 8px;
    background: rgba(255, 255, 255, 0.15);
    border: 1.5px solid rgba(255, 255, 255, 0.35);
  }

  .nav-logout:hover {
    background: rgba(255, 60, 60, 0.25);
    border-color: rgba(255, 255, 255, 0.6);
  }

  .nav-toggle {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
    border-radius: 8px;
  }

  .nav-toggle span {
    display: block;
    width: 22px;
    height: 2px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s;
  }

  @media (max-width: 600px) {
    .glow-navbar {
      flex-wrap: wrap;
      height: auto;
      padding: 12px 18px;
    }

    .nav-toggle {
      display: flex;
    }

    .nav-links {
      display: none;
      width: 100%;
      flex-direction: column;
      align-items: stretch;
      gap: 4px;
      padding: 10px 0 4px;
    }

    .nav-links.open {
      display: flex;
    }

    .nav-link {
      padding: 11px 16px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      justify-content: flex-start;
    }

    .nav-logout {
      margin-left: 0;
    }
  }
</style>

<script>
  function toggleNav() {
    document.getElementById("navLinks").classList.toggle("open");
  }
</script>
