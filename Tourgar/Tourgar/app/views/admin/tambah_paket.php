<?php
// app/views/admin/tambah_paket.php
// $error dikirim dari AdminController::tambahPaket()
?>

<div class="section-header">
  <h2>➕ Tambah Paket Wisata</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/paket/tambah">

    <div class="form-group">
      <label>Nama Paket</label>
      <input type="text" name="nama_paket" required
             value="<?= htmlspecialchars($_POST['nama_paket'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Durasi</label>
      <input type="text" name="durasi" placeholder="3 Hari 2 Malam"
             value="<?= htmlspecialchars($_POST['durasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Harga (Rp)</label>
      <input type="number" name="harga" min="0"
             value="<?= htmlspecialchars($_POST['harga'] ?? '0') ?>">
    </div>

    <div class="form-group">
      <label>Destinasi yang Dikunjungi</label>
      <input type="text" name="destinasi" placeholder="Contoh: Papandayan, Kamojang, Santolo"
             value="<?= htmlspecialchars($_POST['destinasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Fasilitas</label>
      <textarea name="fasilitas" rows="3" placeholder="Contoh: Transport, Hotel, Tiket Masuk"><?= htmlspecialchars($_POST['fasilitas'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status">
        <option value="active">Aktif</option>
        <option value="inactive">Tidak Aktif</option>
      </select>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/paket" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Simpan Paket</button>
    </div>
  </form>
</div>
