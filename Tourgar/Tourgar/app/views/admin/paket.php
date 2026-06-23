<?php
// app/views/admin/paket.php
// $daftarPaket dikirim dari AdminController::paket()
?>

<div class="section-header">
  <h2>📦 Kelola Paket Wisata</h2>
  <a href="<?= BASE_URL ?>/admin/paket/tambah" class="btn-primary">+ Tambah Paket</a>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Paket</th>
        <th>Durasi</th>
        <th>Harga</th>
        <th>Destinasi</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarPaket)): ?>
        <tr><td colspan="7" class="no-data">Belum ada data paket wisata</td></tr>
      <?php else: ?>
        <?php foreach ($daftarPaket as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($p['nama_paket']) ?></td>
            <td><?= htmlspecialchars($p['durasi'] ?? '-') ?></td>
            <td>Rp <?= number_format((float)($p['harga'] ?? 0), 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['destinasi'] ?? '-') ?></td>
            <td>
              <?php $status = $p['status'] ?? 'active'; ?>
              <span class="status-badge status-<?= $status === 'inactive' ? 'inactive' : 'active' ?>">
                <?= $status === 'inactive' ? 'Tidak Aktif' : 'Aktif' ?>
              </span>
            </td>
            <td>
              <a href="<?= BASE_URL ?>/admin/paket/edit?id=<?= (int)$p['id_paket'] ?>" class="btn-edit">Edit</a>
              <a href="<?= BASE_URL ?>/admin/paket/hapus?id=<?= (int)$p['id_paket'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Hapus paket wisata ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
