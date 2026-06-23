<?php
// app/views/admin/dashboard.php
?>

<div class="stats-grid">

  <a href="<?= BASE_URL ?>/admin/wisata" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">🏞️</div>
      <div class="stat-info"><h3><?= (int)$totalWisata ?></h3><p>Total Destinasi</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/paket" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">📦</div>
      <div class="stat-info"><h3><?= (int)$totalPaket ?></h3><p>Total Paket Wisata</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/peta" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">🗺️</div>
      <div class="stat-info"><h3><?= (int)$totalPeta ?></h3><p>Total Titik Peta</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/laporan" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">📋</div>
      <div class="stat-info"><h3><?= (int)$totalLaporan ?></h3><p>Total Laporan Kunjungan</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/kontak" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">📞</div>
      <div class="stat-info"><h3><?= (int)$totalKontak ?></h3><p>Pesan Kontak</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/slider" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">🖼️</div>
      <div class="stat-info"><h3><?= (int)$totalSlider ?></h3><p>Total Slide</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/users" class="stat-card-link">
    <div class="stat-card">
      <div class="stat-icon">👥</div>
      <div class="stat-info"><h3><?= (int)$totalUser ?></h3><p>Total Pengguna</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/pesanan" class="stat-card-link">
    <div class="stat-card" style="border-left:4px solid #f0ad4e;">
      <div class="stat-icon">🛒</div>
      <div class="stat-info"><h3><?= (int)($totalPesanan ?? 0) ?></h3><p>Total Pesanan</p></div>
    </div>
  </a>

  <a href="<?= BASE_URL ?>/admin/pesanan?status=pending" class="stat-card-link">
    <div class="stat-card" style="border-left:4px solid #e63946;">
      <div class="stat-icon">⏳</div>
      <div class="stat-info"><h3><?= (int)($pesananPending ?? 0) ?></h3><p>Pesanan Pending</p></div>
    </div>
  </a>

</div>

<?php if (!empty($pesananTerbaru)): ?>
<div class="recent-activity" style="margin-top:24px;">
  <h2>🛒 Pesanan Masuk Terbaru</h2>
  <div style="overflow-x:auto;">
    <table class="data-table" style="margin-top:12px;">
      <thead>
        <tr>
          <th>Nama Pemesan</th>
          <th>Paket</th>
          <th>Tgl Perjalanan</th>
          <th>Peserta</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pesananTerbaru as $p):
          $st = $p['status'] ?? 'pending';
          $colors = ['pending'=>'#f0ad4e','konfirmasi'=>'#5bc0de','selesai'=>'#5cb85c','batal'=>'#d9534f'];
          $clr = $colors[$st] ?? '#aaa';
          $labels = ['pending'=>'⏳ Pending','konfirmasi'=>'✅ Konfirmasi','selesai'=>'🎉 Selesai','batal'=>'❌ Batal'];
        ?>
          <tr>
            <td><strong><?= htmlspecialchars($p['nama_pemesan']) ?></strong><br><small style="color:#888;"><?= htmlspecialchars($p['no_hp']) ?></small></td>
            <td><?= htmlspecialchars($p['nama_paket']) ?></td>
            <td><?= htmlspecialchars($p['tanggal_pesan'] ?? '-') ?></td>
            <td><?= (int)($p['jumlah_orang']??1) ?> org</td>
            <td><span style="background:<?= $clr ?>22;border:1px solid <?= $clr ?>;color:<?= $clr ?>;padding:2px 10px;border-radius:20px;font-size:0.78rem;"><?= $labels[$st] ?? $st ?></span></td>
            <td><a href="<?= BASE_URL ?>/admin/pesanan" class="btn-edit" style="font-size:0.78rem;padding:4px 10px;">Kelola</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div style="margin-top:12px;">
    <a href="<?= BASE_URL ?>/admin/pesanan" class="btn-primary">Lihat Semua Pesanan →</a>
  </div>
</div>
<?php else: ?>
<div class="recent-activity">
  <h2>Menu Pengelolaan</h2>
  <div class="activity-list">
    <div class="activity-item"><p><strong>Kelola Destinasi</strong> — tambah, ubah, dan hapus data destinasi wisata.</p></div>
    <div class="activity-item"><p><strong>Kelola Paket Wisata</strong> — atur paket perjalanan, durasi, harga, dan status.</p></div>
    <div class="activity-item"><p><strong>🛒 Kelola Pesanan</strong> — pantau dan proses pemesanan paket dari pengunjung.</p></div>
    <div class="activity-item"><p><strong>Kelola Peta</strong> — atur titik koordinat peta wisata interaktif.</p></div>
    <div class="activity-item"><p><strong>Pesan Kontak</strong> — lihat pesan yang dikirim wisatawan via form kontak.</p></div>
    <div class="activity-item"><p><strong>Kelola User</strong> — atur akun admin dan wisatawan.</p></div>
  </div>
</div>
<?php endif; ?>
