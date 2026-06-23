<?php
// app/views/admin/tambah_wisata.php
// $error dikirim dari AdminController::tambahWisata()
?>

<div class="section-header">
  <h2>➕ Tambah Destinasi Baru</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/wisata/tambah">

    <div class="form-group">
      <label>Nama Destinasi</label>
      <input type="text" name="nama_wisata" required
             value="<?= htmlspecialchars($_POST['nama_wisata'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" required
             value="<?= htmlspecialchars($_POST['lokasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" name="kategori" placeholder="Contoh: Alam, Pemandian, Gunung"
             value="<?= htmlspecialchars($_POST['kategori'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="4"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label>Harga Tiket (Rp)</label>
      <input type="number" name="harga_tiket" min="0"
             value="<?= htmlspecialchars($_POST['harga_tiket'] ?? '0') ?>">
    </div>

    <div class="form-group">
      <label>Nama File Gambar</label>
      <input type="text" name="gambar" placeholder="Contoh: situ-bagendit.jpg"
             value="<?= htmlspecialchars($_POST['gambar'] ?? '') ?>">
      <small class="form-hint">File gambar harus sudah diupload ke folder <code>public/assets/images/</code>.</small>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/wisata" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Simpan Destinasi</button>
    </div>
  </form>
</div>
