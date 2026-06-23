<?php
// $statistikLokasi dan $trenBulanan dikirim dari LaporanController
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/Laporan.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<header class="hero-header">
  <div class="hero-content">
    <h1>Laporan Statistik Pariwisata Garut</h1>
    <p>Pantau tren kunjungan wisata, destinasi favorit, dan perkembangan sektor pariwisata Kabupaten Garut.</p>
  </div>
</header>

<div class="background-overlay"></div>

<div class="container">
  <div class="card">
    <h2>Pengunjung Lokasi Populer</h2>
    <p class="subtitle">Jumlah Pengunjung</p>
    <canvas id="lokasiChart"></canvas>
  </div>

  <div class="card">
    <h2>Tren Wisata</h2>
    <p class="subtitle">Jumlah Pengunjung Per Bulan</p>
    <canvas id="trenChart"></canvas>
  </div>
</div>

<script>
// Data dari Controller (PHP → JavaScript)
const lokasiData = {
  labels: <?= json_encode(array_column($statistikLokasi, 'wisata')) ?>,
  datasets: [{
    label: 'Pengunjung',
    data:  <?= json_encode(array_column($statistikLokasi, 'total_pengunjung')) ?>,
    backgroundColor: ['#00b4d8','#0077b6','#48cae4','#90e0ef','#caf0f8'],
    borderRadius: 6
  }]
};

const trenData = {
  labels: <?= json_encode(array_column($trenBulanan, 'bulan')) ?>,
  datasets: [{
    label: 'Pengunjung',
    data:  <?= json_encode(array_column($trenBulanan, 'total_pengunjung')) ?>,
    borderColor: '#00b4d8',
    backgroundColor: 'rgba(0,180,216,0.15)',
    tension: 0.4,
    fill: true
  }]
};

new Chart(document.getElementById('lokasiChart'), { type: 'bar',  data: lokasiData });
new Chart(document.getElementById('trenChart'),   { type: 'line', data: trenData   });
</script>
