<?php
// app/views/admin/kontak.php
// $daftarKontak dikirim dari AdminController::kontak()
?>

<div class="section-header">
  <h2>📞 Pesan Kontak</h2>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Pesan</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarKontak)): ?>
        <tr><td colspan="7" class="no-data">Belum ada pesan kontak</td></tr>
      <?php else: ?>
        <?php foreach ($daftarKontak as $i => $k): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($k['nama']) ?></td>
            <td><?= htmlspecialchars($k['email']) ?></td>
            <td><?= htmlspecialchars($k['telepon'] ?: '-') ?></td>
            <td style="max-width: 320px;"><?= htmlspecialchars($k['pesan']) ?></td>
            <td><?= htmlspecialchars($k['created_at'] ?? '-') ?></td>
            <td>
              <a href="<?= BASE_URL ?>/admin/kontak/hapus?id=<?= (int)$k['id_kontak'] ?>"
                 class="btn-delete"
                 onclick="return confirm('Hapus pesan ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
