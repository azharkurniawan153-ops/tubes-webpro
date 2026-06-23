<?php
// $koordinatWisata dikirim dari PetaWisataController
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/peta-wisata.css">

<header class="page-header fade-zoom">
  <h1>Peta Wisata Garut</h1>
  <p>Jelajahi lokasi wisata Garut melalui peta interaktif dengan detail lengkap.</p>
</header>

<section class="map-container fade-zoom">
  <div id="map" style="height:500px;"></div>
</section>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
// Koordinat dari Controller (PHP → JavaScript)
const wisataMarkers = <?= json_encode($koordinatWisata) ?>;

const map = L.map('map').setView([-7.2197, 107.9089], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

wisataMarkers.forEach(function(w) {
  L.marker([w.lat, w.lng])
    .addTo(map)
    .bindPopup('<b>' + w.nama + '</b><br>' + w.deskripsi);
});
</script>
