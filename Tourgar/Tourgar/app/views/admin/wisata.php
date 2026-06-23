<?php
// app/views/admin/wisata.php
// $daftarWisata dikirim dari AdminController::wisata()
?>

<div class="section-header">
  <h2>🏞️ Kelola Destinasi</h2>
  <a href="<?= BASE_URL ?>/admin/wisata/tambah" class="btn-primary">+ Tambah Destinasi</a>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Destinasi</th>
        <th>Lokasi</th>
        <th>Kategori</th>
        <th>Harga Tiket</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarWisata)): ?>
        <tr><td colspan="6" class="no-data">Belum ada data destinasi</td></tr>
      <?php else: ?>
        <?php foreach ($daftarWisata as $i => $w): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($w['nama_wisata']) ?></td>
            <td><?= htmlspecialchars($w['lokasi']) ?></td>
            <td><?= htmlspecialchars($w['kategori'] ?? '-') ?></td>
            <td>Rp <?= number_format((float)($w['harga_tiket'] ?? 0), 0, ',', '.') ?></td>
            <td>
              <a href="<?= BASE_URL ?>/admin/wisata/edit?id=<?= (int)$w['id_wisata'] ?>" class="btn-edit">Edit</a>
              <a href="<?= BASE_URL ?>/admin/wisata/hapus?id=<?= (int)$w['id_wisata'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Hapus destinasi ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
