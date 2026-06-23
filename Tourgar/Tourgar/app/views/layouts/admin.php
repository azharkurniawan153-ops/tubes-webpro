<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Admin | TOUGAR') ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <img src="<?= BASE_URL ?>/assets/images/Logo.png" alt="Logo TOUGAR">
      <h2>TOUGAR Admin</h2>
    </div>

    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin" class="nav-link<?= ($activeMenu ?? '') === 'dashboard' ? ' active' : '' ?>">
        <span>📊</span> Dashboard
      </a>
      <a href="<?= BASE_URL ?>/admin/wisata" class="nav-link<?= ($activeMenu ?? '') === 'wisata' ? ' active' : '' ?>">
        <span>🏞️</span> Kelola Destinasi
      </a>
      <a href="<?= BASE_URL ?>/admin/paket" class="nav-link<?= ($activeMenu ?? '') === 'paket' ? ' active' : '' ?>">
        <span>📦</span> Kelola Paket Wisata
      </a>
      <a href="<?= BASE_URL ?>/admin/peta" class="nav-link<?= ($activeMenu ?? '') === 'peta' ? ' active' : '' ?>">
        <span>🗺️</span> Kelola Peta
      </a>
      <a href="<?= BASE_URL ?>/admin/laporan" class="nav-link<?= ($activeMenu ?? '') === 'laporan' ? ' active' : '' ?>">
        <span>📋</span> Kelola Laporan
      </a>
      <a href="<?= BASE_URL ?>/admin/kontak" class="nav-link<?= ($activeMenu ?? '') === 'kontak' ? ' active' : '' ?>">
        <span>📞</span> Pesan Kontak
      </a>
      <a href="<?= BASE_URL ?>/admin/slider" class="nav-link<?= ($activeMenu ?? '') === 'slider' ? ' active' : '' ?>">
        <span>🖼️</span> Kelola Slider
      </a>
      <a href="<?= BASE_URL ?>/admin/users" class="nav-link<?= ($activeMenu ?? '') === 'users' ? ' active' : '' ?>">
        <span>👥</span> Kelola User
      </a>
      <a href="<?= BASE_URL ?>/admin/pesanan" class="nav-link<?= ($activeMenu ?? '') === 'pesanan' ? ' active' : '' ?>" style="border-left:3px solid #f0ad4e;">
        <span>🛒</span> Pesanan Paket
      </a>
    </nav>

    <div class="sidebar-footer">
      <a href="<?= BASE_URL ?>/beranda" class="btn-logout">
        <span>🚪</span> Kembali ke Website
      </a>
      <a href="<?= BASE_URL ?>/logout" class="btn-logout btn-logout-danger">
        <span>🔒</span> Logout
      </a>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <!-- HEADER -->
    <header class="top-header">
      <h1><?= htmlspecialchars($pageTitle ?? 'Admin') ?></h1>
      <div class="admin-info">
        <span>Admin: <strong><?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?></strong></span>
      </div>
    </header>

    <section class="content-section active">
      <?= $content ?>
    </section>

    <!-- FOOTER -->
    <footer class="footer-dark">
      <div class="footer-bottom">
        © <?= date('Y') ?> TOUGAR | TOUR GARUT — Jelajahi Alam &amp; Budaya Garut
      </div>
    </footer>

  </main>

</body>
</html>
