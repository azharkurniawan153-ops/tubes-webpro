<?php
// $success dan $error dikirim dari KontakController
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/kontak.css">

<section class="kontak-section">
  <div class="overlay"></div>
  <div class="kontak-container">
    <h1 class="judul">Kontak TOUGAR</h1>
    <p class="subjudul">Hubungi kami untuk informasi wisata, rekomendasi tempat, dan saran perjalanan terbaik di Garut.</p>

    <?php if (!empty($success)): ?>
      <div style="background:#d4edda;color:#155724;padding:12px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
      <div style="background:#f8d7da;color:#721c24;padding:12px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Form POST ke KontakController::send() -->
    <form class="kontak-form" action="<?= BASE_URL ?>/kontak/send" method="POST">
      <input type="text"  name="nama"  placeholder="Nama Anda"   required>
      <input type="email" name="email" placeholder="Email Anda"  required>
      <input type="text"  name="telepon" placeholder="No. Telepon (opsional)">
      <textarea name="pesan" placeholder="Pesan Anda..." required></textarea>
      <button type="submit">Kirim Pesan</button>
    </form>

    <div class="info-box">
      <h3>Informasi Kontak</h3>
      <p>Alamat: Garut Kota, Jawa Barat</p>
      <p>Telepon: 0812-3456-7890</p>
      <p>Email: tougar@gmail.com</p>
    </div>
  </div>
</section>
