<?php
// View ini di-render menggunakan layout 'main'
// $destinasiPopuler dikirim dari BerandaController
?>

<!-- HEADER BERANDA -->
<header>
  <div class="logo">
    <img src="<?= BASE_URL ?>/assets/images/Logo.png" alt="Logo TOUGAR" onerror="this.style.display='none'">
    <span>TOUGAR</span>
  </div>
  <h1>TOUGAR | TOUR GARUT</h1>
  <p>Menjelajahi Keindahan Alam &amp; Budaya Garut</p>
</header>

<!-- SLIDER -->
<section class="slider">
  <div class="slides">
    <img src="<?= BASE_URL ?>/assets/images/papandayan.jpeg" alt="Gunung Papandayan">
    <img src="<?= BASE_URL ?>/assets/images/cipanas.webp"    alt="Cipanas">
    <img src="<?= BASE_URL ?>/assets/images/situ bagendit.jpg" alt="Situ Bagendit">
    <img src="<?= BASE_URL ?>/assets/images/santolo.webp"    alt="Pantai Santolo">
    <img src="<?= BASE_URL ?>/assets/images/kamojang.jpeg"   alt="Kawah Kamojang">
    <!-- duplikat untuk infinite scroll -->
    <img src="<?= BASE_URL ?>/assets/images/papandayan.jpeg" alt="Gunung Papandayan">
    <img src="<?= BASE_URL ?>/assets/images/cipanas.webp"    alt="Cipanas">
  </div>
</section>

<!-- KONTEN UTAMA -->
<main>
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
      <?php foreach ($destinasiPopuler as $d): ?>
        <li><a href="<?= BASE_URL ?>/destinasi"><?= htmlspecialchars($d['nama_wisata'] ?? $d['nama'] ?? '-') ?></a></li>
      <?php endforeach; ?>
      <?php if (empty($destinasiPopuler)): ?>
        <li><a href="<?= BASE_URL ?>/destinasi">Kolam Renang Cipanas</a></li>
        <li><a href="<?= BASE_URL ?>/destinasi">Situ Bagendit</a></li>
        <li><a href="<?= BASE_URL ?>/destinasi">Pantai Santolo</a></li>
        <li><a href="<?= BASE_URL ?>/destinasi">Kawah Kamojang</a></li>
        <li><a href="<?= BASE_URL ?>/destinasi">Gunung Papandayan</a></li>
      <?php endif; ?>
    </ul>

    <h3>Info Wisata</h3>
    <ul>
      <li><a href="#">Tips Liburan di Garut</a></li>
      <li><a href="#">Kuliner Khas Garut</a></li>
      <li><a href="#">Rute dan Transportasi</a></li>
    </ul>
  </aside>
</main>

<script src="<?= BASE_URL ?>/assets/js/Beranda.js"></script>
