<?php
// app/views/admin/peta.php
// $daftarPeta dikirim dari AdminController::peta()
?>

<div class="section-header">
  <h2>🗺️ Kelola Peta</h2>
  <a href="<?= BASE_URL ?>/admin/peta/tambah" class="btn-primary">+ Tambah Lokasi</a>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Lokasi</th>
        <th>Koordinat</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarPeta)): ?>
        <tr><td colspan="6" class="no-data">Belum ada data lokasi</td></tr>
      <?php else: ?>
        <?php foreach ($daftarPeta as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($p['nama_lokasi']) ?></td>
            <td><?= htmlspecialchars($p['latitude']) ?>, <?= htmlspecialchars($p['longitude']) ?></td>
            <td><?= htmlspecialchars($p['kategori'] ?? '-') ?></td>
            <td style="max-width: 320px;"><?= htmlspecialchars($p['deskripsi'] ?? '-') ?></td>
            <td>
              <a href="<?= BASE_URL ?>/admin/peta/edit?id=<?= (int)$p['id_peta'] ?>" class="btn-edit">Edit</a>
              <a href="<?= BASE_URL ?>/admin/peta/hapus?id=<?= (int)$p['id_peta'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Hapus lokasi ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
