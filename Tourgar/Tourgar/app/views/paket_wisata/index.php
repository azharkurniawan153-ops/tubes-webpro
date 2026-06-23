<?php
// $paket dikirim dari PaketWisataController
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/paket-wisata.css">

<header class="header">
  <h1>Paket Wisata Garut</h1>
  <p>Pilih paket terbaik, klik "Detail" untuk informasi dan "Pesan" untuk booking.</p>
</header>

<main class="paket-container" id="paketContainer">

  <?php if (!empty($paket)): ?>
    <!-- Paket dari database -->
    <?php foreach ($paket as $p): ?>
      <article class="paket-card">
        <div class="card-body">
          <h3><?= htmlspecialchars($p['nama_paket']) ?></h3>
          <p class="muted"><?= htmlspecialchars($p['fasilitas']) ?></p>
          <div class="card-footer">
            <span class="price">Mulai Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
            <div class="actions">
              <button class="btn btn-detail">Detail</button>
              <button class="btn btn-pesan">Pesan</button>
            </div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>

  <?php else: ?>
    <!-- Fallback: paket statis dari HTML asli -->
    <?php
    $paketStatis = [
      ['id'=>'pkt1','title'=>'Paket Darajat Pass',         'img'=>BASE_URL.'/assets/images/darajat-pass-garut.png', 'badge'=>'⭐ Populer', 'desc'=>'Kolam air panas, view perbukitan, flying fox, Hotel','harga'=>200000],
      ['id'=>'pkt2','title'=>'Paket Situ Bagendit',        'img'=>BASE_URL.'/assets/images/situ-bagendit.jpg',      'badge'=>'🌈 Best View','desc'=>'Danau legenda, perahu wisata, spot foto instagramable','harga'=>200000],
      ['id'=>'pkt3','title'=>'Paket Kawah Kamojang',       'img'=>BASE_URL.'/assets/images/Kamojang_Hill_Bridge.jpg','badge'=>'⛰️ Mountain','desc'=>'Petualangan seru di sekitar kawah, hiking, spot foto', 'harga'=>300000],
      ['id'=>'pkt4','title'=>'Paket Talaga Bodas',         'img'=>BASE_URL.'/assets/images/Talaga-Bodas.jpeg',      'desc'=>'Danau vulkanis, perahu wisata, spot foto',                                  'harga'=>200000],
      ['id'=>'pkt5','title'=>'Paket Gunung Papandayan',    'img'=>BASE_URL.'/assets/images/papandayan.jpeg',        'desc'=>'Pendakian, edelweiss, view pegunungan indah',                               'harga'=>200000],
      ['id'=>'pkt6','title'=>'Paket Kolam Renang Cipanas', 'img'=>BASE_URL.'/assets/images/cipanas.webp',           'desc'=>'Air panas alami, kolam keluarga, hotel',                                    'harga'=>200000],
      ['id'=>'pkt7','title'=>'Paket Gunung Cikuray',       'img'=>BASE_URL.'/assets/images/Gunung-Cikuray.jpeg',   'desc'=>'Pendakian gunung tertinggi Garut',                                          'harga'=>200000],
      ['id'=>'pkt8','title'=>'Paket Kawah Kamojang',       'img'=>BASE_URL.'/assets/images/Kamojang_Hill_Bridge.jpg','desc'=>'Spot foto, kawah belerang, alam sejuk',                                   'harga'=>200000],
      ['id'=>'pkt9','title'=>'Paket Dinoland Garut',       'img'=>BASE_URL.'/assets/images/Dinoland.jpg',          'desc'=>'Taman dinosaurus, wahana anak, edukasi alam',                               'harga'=>200000],
    ];
    foreach ($paketStatis as $p): ?>
      <article class="paket-card" data-id="<?= $p['id'] ?>">
        <div class="card-media">
          <img src="<?= htmlspecialchars($p['img']) ?>"
               alt="<?= htmlspecialchars($p['title']) ?>"
               onerror="this.src='<?= BASE_URL ?>/assets/images/papandayan.jpeg'">
          <?php if (!empty($p['badge'])): ?>
            <div class="badge"><?= $p['badge'] ?></div>
          <?php endif; ?>
        </div>
        <div class="card-body">
          <h3><?= htmlspecialchars($p['title']) ?></h3>
          <p class="muted"><?= htmlspecialchars($p['desc']) ?></p>
          <div class="card-footer">
            <?php if (!empty($p['harga'])): ?>
              <span class="price">Mulai <?= number_format($p['harga'],0,',','.') ?>rb</span>
            <?php endif; ?>
            <div class="actions">
              <button class="btn btn-detail" data-action="detail">Detail</button>
              <button class="btn btn-pesan" data-action="pesan">Pesan</button>
            </div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  <?php endif; ?>

</main>

<!-- Modal -->
<div class="modal" id="modal" aria-hidden="true">
  <div class="modal-backdrop" id="modalBackdrop"></div>
  <div class="modal-panel">
    <button class="modal-close" id="modalClose">×</button>
    <div class="modal-content" id="modalContent"></div>
  </div>
</div>

<script src="<?= BASE_URL ?>/assets/js/paket-wisata.js"></script>
