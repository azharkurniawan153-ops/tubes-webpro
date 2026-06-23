<?php
// app/views/landing/index.php
// Landing page publik TOUGAR — tampilan sama dengan dashboard pengunjung (Beranda)
// Login & Register terintegrasi di halaman yang sama
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOUGAR | Tour Garut</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/Beranda.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    /* ===== TAMBAHAN UNTUK LANDING: LOGIN/REGISTER SECTION ===== */
    #auth-section {
      background: #edf6f9;
      padding: 50px 20px;
    }

    .auth-container {
      max-width: 900px;
      margin: 0 auto;
    }

    .auth-tabs {
      display: flex;
      gap: 0;
      margin-bottom: 0;
      border-bottom: 3px solid #006d77;
    }

    .auth-tab-btn {
      flex: 1;
      padding: 14px 0;
      background: #c1dfe2;
      color: #006d77;
      border: none;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s;
      font-family: 'Poppins', sans-serif;
    }

    .auth-tab-btn.active {
      background: #006d77;
      color: #fff;
    }

    .auth-tab-btn:hover:not(.active) {
      background: #83c5be;
    }

    .auth-form-box {
      background: #fff;
      border-radius: 0 0 14px 14px;
      box-shadow: 0 4px 16px rgba(0,109,119,0.12);
      padding: 36px 40px;
      display: none;
    }

    .auth-form-box.active {
      display: block;
    }

    .auth-form-box h2 {
      color: #006d77;
      font-size: 1.5rem;
      margin-bottom: 6px;
      border-bottom: 3px solid #83c5be;
      display: inline-block;
      padding-bottom: 4px;
    }

    .auth-form-box p.sub {
      color: #888;
      font-size: 0.95rem;
      margin-bottom: 24px;
    }

    .auth-form-box .alert-error {
      background: #ffe0e0;
      color: #c00;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 14px;
      font-size: 0.9rem;
    }

    .auth-form-box .alert-success {
      background: #d4edda;
      color: #155724;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 14px;
      font-size: 0.9rem;
    }

    .auth-form-box .input-group {
      display: flex;
      align-items: center;
      border: 1px solid #b2d8db;
      border-radius: 8px;
      margin-bottom: 16px;
      overflow: hidden;
      background: #f0f9fa;
    }

    .auth-form-box .input-group i {
      padding: 12px 14px;
      color: #006d77;
      font-size: 1rem;
      background: #d4eef0;
    }

    .auth-form-box .input-group input {
      flex: 1;
      border: none;
      outline: none;
      padding: 12px 14px;
      font-size: 1rem;
      background: transparent;
      font-family: 'Poppins', sans-serif;
      color: #333;
    }

    .auth-form-box .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.88rem;
      margin-bottom: 18px;
      color: #555;
    }

    .auth-form-box .options a {
      color: #006d77;
      text-decoration: none;
    }

    .auth-form-box .options a:hover {
      text-decoration: underline;
    }

    .auth-form-box button[type="submit"] {
      width: 100%;
      background: #006d77;
      color: #fff;
      border: none;
      padding: 13px;
      border-radius: 8px;
      font-size: 1.05rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s;
      font-family: 'Poppins', sans-serif;
    }

    .auth-form-box button[type="submit"]:hover {
      background: #004f56;
    }

    .auth-form-box .switch-link {
      text-align: center;
      margin-top: 16px;
      font-size: 0.9rem;
      color: #555;
    }

    .auth-form-box .switch-link a {
      color: #006d77;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
    }

    .auth-form-box .switch-link a:hover {
      text-decoration: underline;
    }

    /* Notif toast */
    .toast-notif {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      padding: 14px 22px;
      border-radius: 10px;
      font-size: 0.95rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      display: none;
    }

    .toast-notif.success {
      background: #d4edda;
      color: #155724;
      border-left: 4px solid #28a745;
    }

    .toast-notif.error {
      background: #ffe0e0;
      color: #c00;
      border-left: 4px solid #dc3545;
    }

    /* Paket section */
    .paket-section {
      padding: 40px 20px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .paket-section h2 {
      color: #006d77;
      border-bottom: 3px solid #83c5be;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 28px;
      font-size: 1.8rem;
    }

    .paket-grid-land {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 22px;
    }

    .paket-card-land {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 12px rgba(0,109,119,0.12);
      overflow: hidden;
      transition: transform 0.2s;
    }

    .paket-card-land:hover {
      transform: translateY(-4px);
    }

    .paket-card-land img {
      width: 100%;
      height: 170px;
      object-fit: cover;
    }

    .paket-card-body {
      padding: 18px;
    }

    .paket-card-body h3 {
      color: #006d77;
      font-size: 1rem;
      margin-bottom: 6px;
    }

    .paket-card-body p {
      color: #666;
      font-size: 0.88rem;
      line-height: 1.5;
      margin-bottom: 10px;
    }

    .paket-price {
      color: #006d77;
      font-weight: 700;
      font-size: 1rem;
    }

    .btn-pesan-land {
      display: inline-block;
      margin-top: 10px;
      background: #006d77;
      color: #fff;
      padding: 8px 18px;
      border-radius: 20px;
      font-size: 0.88rem;
      border: none;
      cursor: pointer;
      transition: background 0.2s;
      font-family: 'Poppins', sans-serif;
    }

    .btn-pesan-land:hover {
      background: #004f56;
    }

    /* Nav Login Button */
    .nav-login-btn {
      background: #fff;
      color: #006d77;
      border: none;
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 800;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s, color 0.2s;
    }

    .nav-login-btn:hover {
      background: #83c5be;
      color: #fff;
    }

    /* Modal Pemesanan */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      z-index: 2000;
      align-items: center;
      justify-content: center;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-box {
      background: #fff;
      border-radius: 16px;
      padding: 34px 30px;
      max-width: 460px;
      width: 92%;
      position: relative;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-close-btn {
      position: absolute;
      top: 12px;
      right: 16px;
      background: none;
      border: none;
      font-size: 1.4rem;
      cursor: pointer;
      color: #888;
    }

    .modal-box h3 {
      color: #006d77;
      font-size: 1.2rem;
      margin-bottom: 4px;
    }

    .modal-box .modal-sub {
      color: #888;
      font-size: 0.88rem;
      margin-bottom: 18px;
    }

    .modal-paket-info {
      background: #edf6f9;
      border: 1px solid #83c5be;
      border-radius: 8px;
      padding: 12px 14px;
      margin-bottom: 18px;
      font-size: 0.9rem;
      color: #006d77;
    }

    .modal-box .form-group {
      margin-bottom: 14px;
    }

    .modal-box .form-group label {
      display: block;
      font-size: 0.88rem;
      color: #555;
      margin-bottom: 5px;
    }

    .modal-box .form-group input,
    .modal-box .form-group textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #b2d8db;
      border-radius: 7px;
      font-size: 0.9rem;
      font-family: 'Poppins', sans-serif;
      outline: none;
      background: #f0f9fa;
      color: #333;
    }

    .modal-box .form-group textarea {
      resize: vertical;
      min-height: 70px;
    }

    .modal-box .btn-submit {
      width: 100%;
      background: #006d77;
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      transition: background 0.2s;
    }

    .modal-box .btn-submit:hover {
      background: #004f56;
    }

    @media (max-width: 600px) {
      .auth-form-box { padding: 22px 16px; }
    }
  </style>
</head>
<body>

<!-- TOAST NOTIFIKASI -->
<?php if (!empty($pesanSuccess)): ?>
<div class="toast-notif success" id="toastNotif" style="display:block;">
  ✅ <?= htmlspecialchars($pesanSuccess) ?>
  <div style="margin-top:6px;font-size:0.82rem;color:#155724;">Tim kami akan menghubungi Anda segera via WhatsApp.</div>
</div>
<?php elseif (!empty($pesanError)): ?>
<div class="toast-notif error" id="toastNotif" style="display:block;">
  ❌ <?= htmlspecialchars($pesanError) ?>
</div>
<?php endif; ?>

<!-- HEADER -->
<header>
  <div class="logo">
    <img src="<?= BASE_URL ?>/assets/images/Logo.png" alt="Logo TOUGAR" onerror="this.style.display='none'">
    <span style="color:#fff;font-weight:700;font-size:1rem;">TOUGAR</span>
  </div>
  <h1>TOUGAR | TOUR GARUT</h1>
  <p>Menjelajahi Keindahan Alam &amp; Budaya Garut</p>
</header>

<!-- NAVBAR -->
<nav>
  <a href="#beranda-content">Beranda</a>
  <a href="#paket-section">Paket Wisata</a>
  <a href="#auth-section">Login</a>
  <a href="#auth-section" class="nav-login-btn" onclick="showTab('register')">Daftar</a>
</nav>

<!-- SLIDER -->
<section class="slider">
  <div class="slides">
    <img src="<?= BASE_URL ?>/assets/images/papandayan.jpeg"    alt="Gunung Papandayan">
    <img src="<?= BASE_URL ?>/assets/images/cipanas.webp"       alt="Cipanas">
    <img src="<?= BASE_URL ?>/assets/images/situ bagendit.jpg"  alt="Situ Bagendit">
    <img src="<?= BASE_URL ?>/assets/images/santolo.webp"       alt="Pantai Santolo">
    <img src="<?= BASE_URL ?>/assets/images/kamojang.jpeg"      alt="Kawah Kamojang">
    <!-- duplikat untuk seamless loop -->
    <img src="<?= BASE_URL ?>/assets/images/papandayan.jpeg"    alt="Gunung Papandayan">
    <img src="<?= BASE_URL ?>/assets/images/cipanas.webp"       alt="Cipanas">
  </div>
</section>

<!-- KONTEN UTAMA -->
<main id="beranda-content">
  <article>
    <h2>TOUGAR | TOUR GARUT</h2>
    <img src="<?= BASE_URL ?>/assets/images/Logo.png" alt="TOUGAR" onerror="this.style.display='none'">
    <p>Nikmati pengalaman tak terlupakan menjelajahi keindahan alam dan budaya khas Garut bersama
       <strong>TOUGAR | TOUR GARUT</strong>. Dalam perjalanan ini, Anda akan diajak menikmati
       udara sejuk pegunungan, relaksasi di pemandian air panas alami, serta mencicipi kuliner
       legendaris seperti dodol Garut dan sambal cibiuk yang menggugah selera.</p>
    <p>Paket tour kami dirancang untuk menghadirkan keseimbangan antara petualangan dan kenyamanan.
       Dengan pemandu profesional dan fasilitas terbaik, TOUGAR siap membawa Anda menikmati
       keindahan Garut dengan cara yang berbeda: <em>lebih dekat, lebih hangat, dan lebih berkesan.</em></p>
  </article>

  <aside>
    <h3>Destinasi Populer</h3>
    <ul>
      <li><a href="#auth-section">Kolam Renang Cipanas</a></li>
      <li><a href="#auth-section">Situ Bagendit</a></li>
      <li><a href="#auth-section">Pantai Santolo</a></li>
      <li><a href="#auth-section">Kawah Kamojang</a></li>
      <li><a href="#auth-section">Gunung Papandayan</a></li>
    </ul>

    <h3 style="margin-top:22px;">Info Wisata</h3>
    <ul>
      <li><a href="#auth-section">Tips Liburan di Garut</a></li>
      <li><a href="#auth-section">Kuliner Khas Garut</a></li>
      <li><a href="#auth-section">Rute dan Transportasi</a></li>
    </ul>

    <div style="margin-top:24px;text-align:center;">
      <a href="#auth-section" onclick="showTab('login')"
         style="background:#006d77;color:#fff;padding:10px 24px;border-radius:20px;text-decoration:none;font-weight:700;font-size:0.95rem;">
        Masuk Sekarang
      </a>
    </div>
  </aside>
</main>

<!-- PAKET WISATA SECTION -->
<section id="paket-section" style="background:#e0f7fa; padding: 40px 0;">
  <div class="paket-section">
    <h2>Paket Wisata Unggulan</h2>
    <div class="paket-grid-land">
      <?php if (!empty($paketWisata)): ?>
        <?php foreach (array_slice($paketWisata, 0, 3) as $p): ?>
        <div class="paket-card-land">
          <img src="<?= BASE_URL ?>/assets/images/papandayan.jpeg"
               alt="<?= htmlspecialchars($p['nama_paket']) ?>"
               onerror="this.src='<?= BASE_URL ?>/assets/images/papandayan.jpeg'">
          <div class="paket-card-body">
            <h3><?= htmlspecialchars($p['nama_paket']) ?></h3>
            <p><?= htmlspecialchars(mb_strimwidth($p['fasilitas'] ?? '', 0, 80, '...')) ?></p>
            <div class="paket-price">Rp <?= number_format((float)($p['harga'] ?? 0), 0, ',', '.') ?></div>
            <button class="btn-pesan-land"
              onclick="openPesanModal(<?= $p['id_paket'] ?>, '<?= addslashes($p['nama_paket']) ?>', <?= (int)($p['harga'] ?? 0) ?>)">
              Pesan Sekarang
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <?php $preview = [
          ['nama'=>'Paket Darajat Pass',   'harga'=>350000, 'desc'=>'Kolam air panas, view perbukitan, flying fox, Hotel bintang', 'img'=>'darajat-pass-garut.png'],
          ['nama'=>'Paket Situ Bagendit',  'harga'=>200000, 'desc'=>'Danau legenda, perahu wisata, spot foto instagramable',        'img'=>'situ bagendit.jpg'],
          ['nama'=>'Paket Kawah Kamojang', 'harga'=>300000, 'desc'=>'Petualangan seru di sekitar kawah, hiking, spot foto indah',   'img'=>'kamojang.jpeg'],
        ];
        foreach ($preview as $p): ?>
        <div class="paket-card-land">
          <img src="<?= BASE_URL ?>/assets/images/<?= urlencode($p['img']) ?>"
               alt="<?= $p['nama'] ?>"
               onerror="this.src='<?= BASE_URL ?>/assets/images/papandayan.jpeg'">
          <div class="paket-card-body">
            <h3><?= $p['nama'] ?></h3>
            <p><?= $p['desc'] ?></p>
            <div class="paket-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
            <button class="btn-pesan-land"
              onclick="openPesanModal(0, '<?= $p['nama'] ?>', <?= $p['harga'] ?>)">
              Pesan Sekarang
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div style="text-align:center; margin-top:30px;">
      <a href="#auth-section" onclick="showTab('login')"
         style="background:#006d77;color:#fff;padding:12px 32px;border-radius:24px;text-decoration:none;font-weight:700;font-size:1rem;">
        Lihat Semua Paket →
      </a>
    </div>
  </div>
</section>

<!-- LOGIN / REGISTER SECTION -->
<section id="auth-section">
  <div class="auth-container">

    <div style="text-align:center; margin-bottom:28px;">
      <h2 style="color:#006d77; font-size:1.8rem; border-bottom:3px solid #83c5be; display:inline-block; padding-bottom:6px;">
        Akses TOUGAR
      </h2>
      <p style="color:#666; margin-top:8px; font-size:0.95rem;">Masuk atau daftar untuk menikmati semua fitur wisata Garut</p>
    </div>

    <!-- TABS -->
    <div class="auth-tabs">
      <button class="auth-tab-btn active" id="tab-login" onclick="showTab('login')">
        Masuk
      </button>
      <button class="auth-tab-btn" id="tab-register" onclick="showTab('register')">
        Daftar Akun
      </button>
    </div>

    <!-- FORM LOGIN -->
    <div class="auth-form-box active" id="form-login">
      <h2>Login Akun</h2>
      <p class="sub">Silakan masuk untuk melanjutkan</p>

      <?php if (!empty($error)): ?>
        <div class="alert-error"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if (!empty($_SESSION['register_success'])): ?>
        <div class="alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['register_success']) ?></div>
        <?php unset($_SESSION['register_success']); ?>
      <?php endif; ?>

      <form action="<?= BASE_URL ?>/login" method="POST">
        <div class="input-group">
          <i class="fa fa-user"></i>
          <input type="text" name="username" placeholder="Username" required
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="options">
          <label><input type="checkbox" name="ingat"> Ingat saya</label>
          <a href="<?= BASE_URL ?>/forgot-password">Lupa password?</a>
        </div>
        <button type="submit">Masuk →</button>
        <p class="switch-link">Belum punya akun?
          <a onclick="showTab('register')">Daftar sekarang</a>
        </p>
      </form>
    </div>

    <!-- FORM REGISTER -->
    <div class="auth-form-box" id="form-register">
      <h2>Daftar Akun</h2>
      <p class="sub">Buat akun baru untuk mulai menjelajahi wisata Garut</p>

      <form action="<?= BASE_URL ?>/register" method="POST">
        <div class="input-group">
          <i class="fa fa-id-card"></i>
          <input type="text" name="nama" placeholder="Nama Lengkap" required
                 value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
        </div>
        <div class="input-group">
          <i class="fa fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="input-group">
          <i class="fa fa-user"></i>
          <input type="text" name="username" placeholder="Username" required
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required>
        </div>
        <button type="submit">Daftar Sekarang</button>
        <p class="switch-link">Sudah punya akun?
          <a onclick="showTab('login')">Login di sini</a>
        </p>
      </form>
    </div>

  </div>
</section>

<!-- FOOTER -->
<footer class="footer-dark">
  <div class="footer-container">
    <div class="footer-brand">
      <p>TOUGAR | TOUR GARUT</p>
    </div>
    <div class="footer-column">
      <h4>Menu</h4>
      <a href="#beranda-content">Beranda</a>
      <a href="#paket-section">Paket Wisata</a>
      <a href="#auth-section" onclick="showTab('login')">Login</a>
      <a href="#auth-section" onclick="showTab('register')">Daftar</a>
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

<!-- MODAL PEMESANAN -->
<div class="modal-overlay" id="pesanModal">
  <div class="modal-box">
    <button class="modal-close-btn" onclick="closePesanModal()">&#215;</button>
    <h3>Pesan Paket Wisata</h3>
    <p class="modal-sub">Isi data diri Anda untuk memesan paket ini</p>
    <div class="modal-paket-info" id="modalPaketInfo">
      <strong>Paket:</strong> <span id="modalPaketNama">-</span><br>
      <strong>Harga:</strong> Rp <span id="modalPaketHarga">-</span>
    </div>
    <form action="<?= BASE_URL ?>/pesan-paket" method="POST">
      <input type="hidden" name="id_paket"    id="inputIdPaket">
      <input type="hidden" name="nama_paket"  id="inputNamaPaket">
      <input type="hidden" name="harga_paket" id="inputHargaPaket">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text"   name="nama_pemesan"  placeholder="Nama lengkap Anda" required>
      </div>
      <div class="form-group">
        <label>No. HP / WhatsApp</label>
        <input type="text"   name="no_hp"          placeholder="Contoh: 08123456789" required>
      </div>
      <div class="form-group">
        <label>Tanggal Perjalanan</label>
        <input type="date"   name="tanggal_pesan"  required min="<?= date('Y-m-d') ?>">
      </div>
      <div class="form-group">
        <label>Jumlah Peserta</label>
        <input type="number" name="jumlah_orang"   placeholder="Jumlah orang" required min="1" value="1">
      </div>
      <div class="form-group">
        <label>Catatan (opsional)</label>
        <textarea name="catatan" placeholder="Permintaan khusus, kebutuhan, dll..."></textarea>
      </div>
      <button type="submit" class="btn-submit">Kirim Pesanan</button>
    </form>
  </div>
</div>

<script src="<?= BASE_URL ?>/assets/js/Beranda.js"></script>
<script>
// ===== TAB LOGIN / REGISTER =====
function showTab(tab) {
  document.getElementById('form-login').classList.remove('active');
  document.getElementById('form-register').classList.remove('active');
  document.getElementById('tab-login').classList.remove('active');
  document.getElementById('tab-register').classList.remove('active');

  if (tab === 'register') {
    document.getElementById('form-register').classList.add('active');
    document.getElementById('tab-register').classList.add('active');
  } else {
    document.getElementById('form-login').classList.add('active');
    document.getElementById('tab-login').classList.add('active');
  }

  // Scroll ke section
  document.getElementById('auth-section').scrollIntoView({ behavior: 'smooth' });
}

// ===== MODAL PEMESANAN =====
function openPesanModal(id, nama, harga) {
  document.getElementById('inputIdPaket').value    = id;
  document.getElementById('inputNamaPaket').value  = nama;
  document.getElementById('inputHargaPaket').value = harga;
  document.getElementById('modalPaketNama').textContent  = nama;
  document.getElementById('modalPaketHarga').textContent = Number(harga).toLocaleString('id-ID');
  document.getElementById('pesanModal').classList.add('active');
}

function closePesanModal() {
  document.getElementById('pesanModal').classList.remove('active');
}

document.getElementById('pesanModal').addEventListener('click', function(e) {
  if (e.target === this) closePesanModal();
});

// ===== SMOOTH SCROLL UNTUK SEMUA ANCHOR =====
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
  a.addEventListener('click', function(e) {
    var href = this.getAttribute('href');
    if (href === '#') return;
    var target = document.querySelector(href);
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

// ===== AUTO HIDE TOAST =====
var toast = document.getElementById('toastNotif');
if (toast) {
  setTimeout(function() { toast.style.display = 'none'; }, 5000);
}

// ===== JIKA ADA ERROR REGISTER, TAMPILKAN TAB REGISTER =====
<?php if (!empty($error) && isset($_POST['nama'])): ?>
showTab('register');
<?php endif; ?>
</script>
</body>
</html>
