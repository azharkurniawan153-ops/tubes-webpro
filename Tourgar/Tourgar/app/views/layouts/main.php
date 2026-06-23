<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'TOUGAR') ?></title>

  <!-- CSS Beranda dipakai sebagai layout utama -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/Beranda.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    /* Navbar global */
    .main-nav {
      background: #006d77;
      padding: 12px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .main-nav .logo-text { color: #fff; font-size: 1.4rem; font-weight: 700; text-decoration: none; }
    .main-nav ul { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
    .main-nav ul li a { color: #ffffff; text-decoration: none; font-size: 0.95rem; transition: color .2s; }
    .main-nav ul li a:hover { color: #00b4d8; }
    .nav-user { color: #ffffff; font-size: 0.85rem; }
    .btn-logout { background: #e63946; color: #fff; border: none; padding: 6px 14px;
                  border-radius: 4px; cursor: pointer; font-size: 0.85rem; text-decoration: none; }
    .btn-logout:hover { background: #c1121f; }
  </style>
</head>
<body>

<!-- NAVIGASI GLOBAL -->
<nav class="main-nav">
  <a href="<?= BASE_URL ?>/beranda" class="logo-text">TOUGAR</a>
  <ul>
    <li><a href="<?= BASE_URL ?>/beranda">Beranda</a></li>
    <li><a href="<?= BASE_URL ?>/destinasi">Destinasi</a></li>
    <li><a href="<?= BASE_URL ?>/paket-wisata">Paket Wisata</a></li>
    <li><a href="<?= BASE_URL ?>/peta-wisata">Peta Wisata</a></li>
    <li><a href="<?= BASE_URL ?>/laporan">Laporan</a></li>
    <li><a href="<?= BASE_URL ?>/kontak">Kontak</a></li>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li><a href="<?= BASE_URL ?>/admin">Admin</a></li>
    <?php endif; ?>
  </ul>
  <div class="nav-user">
    <?= htmlspecialchars($_SESSION['nama'] ?? '') ?>
    &nbsp;
    <a href="<?= BASE_URL ?>/logout" class="btn-logout">Logout</a>
  </div>
</nav>

<!-- KONTEN HALAMAN -->
<?= $content ?>

<!-- FOOTER GLOBAL -->
<footer class="footer-dark">
  <div class="footer-container">
    <div class="footer-brand">
      <p>TOUGAR | TOUR GARUT</p>
    </div>
    <div class="footer-column">
      <h4>Menu</h4>
      <a href="<?= BASE_URL ?>/beranda">Beranda</a>
      <a href="<?= BASE_URL ?>/destinasi">Destinasi</a>
      <a href="<?= BASE_URL ?>/paket-wisata">Paket Wisata</a>
      <a href="<?= BASE_URL ?>/kontak">Kontak</a>
    </div>
    <div class="footer-column">
      <h4>Informasi</h4>
      <a href="#">Tentang Kami</a>
      <a href="#">Kebijakan Privasi</a>
      <a href="#">Syarat &amp; Ketentuan</a>
    </div>
    <div class="footer-column">
      <h4>Media Sosial</h4>
      <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
      <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
      <a href="#"><i class="fab fa-tiktok"></i> TikTok</a>
    </div>
  </div>
  <div class="footer-bottom">© 2025 TOUGAR | TOUR GARUT — Jelajahi Alam &amp; Budaya Garut</div>
</footer>

</body>
</html>
