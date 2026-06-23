<?php
// app/views/admin/laporan.php
// $daftarLaporan dikirim dari AdminController::laporan()
?>

<div class="section-header">
  <h2>📋 Kelola Laporan Kunjungan</h2>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pengunjung</th>
        <th>Wisata</th>
        <th>Tanggal</th>
        <th>Jumlah Orang</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarLaporan)): ?>
        <tr><td colspan="6" class="no-data">Belum ada laporan kunjungan</td></tr>
      <?php else: ?>
        <?php foreach ($daftarLaporan as $i => $l): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($l['nama_pengunjung'] ?? '-') ?></td>
            <td><?= htmlspecialchars($l['wisata'] ?? '-') ?></td>
            <td><?= htmlspecialchars($l['tanggal'] ?? '-') ?></td>
            <td><?= (int)($l['jumlah_orang'] ?? 0) ?></td>
            <td>
              <a href="<?= BASE_URL ?>/admin/laporan/hapus?id=<?= (int)$l['id_laporan'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Hapus laporan ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
