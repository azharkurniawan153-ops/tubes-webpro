<?php
// app/views/admin/edit_paket.php
// $error, $data dikirim dari AdminController::editPaket()
?>

<div class="section-header">
  <h2>✏️ Edit Paket Wisata</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/paket/edit?id=<?= (int)$data['id_paket'] ?>">

    <div class="form-group">
      <label>Nama Paket</label>
      <input type="text" name="nama_paket" required
             value="<?= htmlspecialchars($data['nama_paket'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Durasi</label>
      <input type="text" name="durasi"
             value="<?= htmlspecialchars($data['durasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Harga (Rp)</label>
      <input type="number" name="harga" min="0"
             value="<?= htmlspecialchars($data['harga'] ?? '0') ?>">
    </div>

    <div class="form-group">
      <label>Destinasi yang Dikunjungi</label>
      <input type="text" name="destinasi"
             value="<?= htmlspecialchars($data['destinasi'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Fasilitas</label>
      <textarea name="fasilitas" rows="3"><?= htmlspecialchars($data['fasilitas'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label>Status</label>
      <?php $statusNow = $data['status'] ?? 'active'; ?>
      <select name="status">
        <option value="active" <?= $statusNow === 'active' ? 'selected' : '' ?>>Aktif</option>
        <option value="inactive" <?= $statusNow === 'inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
      </select>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/paket" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Update Paket</button>
    </div>
  </form>
</div>
