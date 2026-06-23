<?php
// app/views/admin/tambah_slider.php
// $error dikirim dari AdminController::tambahSlider()
?>

<div class="section-header">
  <h2>➕ Tambah Slide</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/slider/tambah">

    <div class="form-group">
      <label>Judul Slide</label>
      <input type="text" name="judul" required
             value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Nama File Gambar</label>
      <input type="text" name="gambar" placeholder="Contoh: papandayan.jpeg" required
             value="<?= htmlspecialchars($_POST['gambar'] ?? '') ?>">
      <small class="form-hint">
        File gambar harus sudah diupload ke folder <code>public/assets/images/</code>.
        Tulis path lengkap jika ingin pakai URL eksternal.
      </small>
    </div>

    <div class="form-group">
      <label>Urutan Tampil</label>
      <input type="number" name="urutan" min="0"
             value="<?= htmlspecialchars($_POST['urutan'] ?? '0') ?>">
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/slider" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Simpan Slide</button>
    </div>
  </form>
</div>
