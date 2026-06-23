<?php
// $destinasi dikirim dari DestinasiController
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/destinasi.css">

<header class="header">
  <h1>Destinasi Wisata Garut</h1>
  <p>Temukan wisata alam terbaik yang wajib kamu kunjungi!</p>
</header>

<section class="destinasi-container">
  <?php foreach ($destinasi as $item): ?>
    <div class="card" data-animate>
      <?php if (!empty($item['gambar'])): ?>
        <img src="<?= htmlspecialchars($item['gambar']) ?>"
             alt="<?= htmlspecialchars($item['nama_wisata']) ?>"
             onerror="this.src='<?= BASE_URL ?>/assets/images/papandayan.jpeg'">
      <?php endif; ?>
      <h3><?= htmlspecialchars($item['nama_wisata']) ?></h3>
      <p><?= htmlspecialchars($item['deskripsi']) ?></p>
      <?php if (!empty($item['harga_tiket'])): ?>
        <p><strong>Harga tiket: </strong>Rp <?= number_format($item['harga_tiket'], 0, ',', '.') ?></p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</section>

<script src="<?= BASE_URL ?>/assets/js/destinasi.js"></script>
