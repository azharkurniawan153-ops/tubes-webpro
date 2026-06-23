<?php
// app/views/admin/edit_wisata.php
// $error, $data dikirim dari AdminController::editWisata()
?>

<div class="section-header">
  <h2>✏️ Edit Destinasi</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/wisata/edit?id=<?= (int)$data['id_wisata'] ?>">

    <div class="form-group">
      <label>Nama Destinasi</label>
      <input type="text" name="nama_wisata" required
             value="<?= htmlspecialchars($data['nama_wisata'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" required
             value="<?= htmlspecialchars($data['lokasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" name="kategori"
             value="<?= htmlspecialchars($data['kategori'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="4"><?= htmlspecialchars($data['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label>Harga Tiket (Rp)</label>
      <input type="number" name="harga_tiket" min="0"
             value="<?= htmlspecialchars($data['harga_tiket'] ?? '0') ?>">
    </div>

    <div class="form-group">
      <label>Nama File Gambar</label>
      <input type="text" name="gambar"
             value="<?= htmlspecialchars($data['gambar'] ?? '') ?>">
      <small class="form-hint">File gambar harus sudah diupload ke folder <code>public/assets/images/</code>.</small>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/wisata" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Update Destinasi</button>
    </div>
  </form>
</div>
