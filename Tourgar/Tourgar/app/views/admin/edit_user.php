<?php
// app/views/admin/edit_user.php
// $error, $data dikirim dari AdminController::editUser()
?>

<div class="section-header">
  <h2>✏️ Edit User</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/users/edit?id=<?= (int)$data['id'] ?>">

    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" required
             value="<?= htmlspecialchars($data['nama'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" required
             value="<?= htmlspecialchars($data['email'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required
             value="<?= htmlspecialchars($data['username'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Password Baru</label>
      <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
      <small class="form-hint">Biarkan kosong jika tidak ingin mengubah password.</small>
    </div>

    <div class="form-group">
      <label>Role</label>
      <?php $roleNow = $data['role'] ?? 'wisatawan'; ?>
      <select name="role">
        <option value="wisatawan" <?= $roleNow === 'wisatawan' ? 'selected' : '' ?>>Wisatawan</option>
        <option value="admin" <?= $roleNow === 'admin' ? 'selected' : '' ?>>Admin</option>
      </select>
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
      <a href="<?= BASE_URL ?>/admin/users" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Update User</button>
    </div>
  </form>
</div>
