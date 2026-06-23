<?php
// app/views/admin/tambah_peta.php
// $error dikirim dari AdminController::tambahPeta()
?>

<div class="section-header">
  <h2>➕ Tambah Lokasi Peta</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/peta/tambah">

    <div class="form-group">
      <label>Nama Lokasi</label>
      <input type="text" name="nama_lokasi" required
             value="<?= htmlspecialchars($_POST['nama_lokasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Latitude</label>
      <input type="text" name="latitude" placeholder="-7.3197" required
             value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Longitude</label>
      <input type="text" name="longitude" placeholder="107.7300" required
             value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <select name="kategori">
        <option value="Gunung">Gunung</option>
        <option value="Pantai">Pantai</option>
        <option value="Danau">Danau</option>
        <option value="Wisata Air">Wisata Air</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="3"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/peta" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Simpan Lokasi</button>
    </div>
  </form>
</div>
