<?php
// app/views/admin/edit_peta.php
// $error, $data dikirim dari AdminController::editPeta()
?>

<div class="section-header">
  <h2>✏️ Edit Lokasi Peta</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/peta/edit?id=<?= (int)$data['id_peta'] ?>">

    <div class="form-group">
      <label>Nama Lokasi</label>
      <input type="text" name="nama_lokasi" required
             value="<?= htmlspecialchars($data['nama_lokasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Latitude</label>
      <input type="text" name="latitude" required
             value="<?= htmlspecialchars($data['latitude'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Longitude</label>
      <input type="text" name="longitude" required
             value="<?= htmlspecialchars($data['longitude'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <?php $katNow = $data['kategori'] ?? ''; ?>
      <select name="kategori">
        <option value="Gunung" <?= $katNow === 'Gunung' ? 'selected' : '' ?>>Gunung</option>
        <option value="Pantai" <?= $katNow === 'Pantai' ? 'selected' : '' ?>>Pantai</option>
        <option value="Danau" <?= $katNow === 'Danau' ? 'selected' : '' ?>>Danau</option>
        <option value="Wisata Air" <?= $katNow === 'Wisata Air' ? 'selected' : '' ?>>Wisata Air</option>
        <option value="Lainnya" <?= $katNow === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
      </select>
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="3"><?= htmlspecialchars($data['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/peta" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Update Lokasi</button>
    </div>
  </form>
</div>
