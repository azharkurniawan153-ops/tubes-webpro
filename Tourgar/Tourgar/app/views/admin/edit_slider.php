<?php
// app/views/admin/edit_slider.php
// $error, $data dikirim dari AdminController::editSlider()
?>

<div class="section-header">
  <h2>✏️ Edit Slide</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/slider/edit?id=<?= (int)$data['id_slider'] ?>">

    <div class="form-group">
      <label>Judul Slide</label>
      <input type="text" name="judul" required
             value="<?= htmlspecialchars($data['judul'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Nama File Gambar</label>
      <input type="text" name="gambar" required
             value="<?= htmlspecialchars($data['gambar'] ?? '') ?>">
      <small class="form-hint">
        File gambar harus sudah diupload ke folder <code>public/assets/images/</code>.
      </small>
    </div>

    <div class="form-group">
      <label>Urutan Tampil</label>
      <input type="number" name="urutan" min="0"
             value="<?= htmlspecialchars($data['urutan'] ?? '0') ?>">
    </div>

    <?php if (!empty($data['gambar'])): ?>
      <div class="form-group">
        <label>Pratinjau Saat Ini</label>
        <img src="<?= htmlspecialchars($data['gambar']) ?>" alt="Pratinjau"
             style="max-width:220px;border-radius:12px;box-shadow:0 2px 8px rgba(15,23,42,0.15);">
      </div>
    <?php endif; ?>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/slider" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Update Slide</button>
    </div>
  </form>
</div>
