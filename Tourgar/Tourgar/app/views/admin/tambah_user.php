<?php
// app/views/admin/tambah_user.php
// $error dikirim dari AdminController::tambahUser()
?>

<div class="section-header">
  <h2>➕ Tambah User</h2>
</div>

<?php if (!empty($error)): ?>
  <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-form-card">
  <form method="POST" action="<?= BASE_URL ?>/admin/users/tambah">

    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" required
             value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" required
             value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required
             value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>

    <div class="form-group">
      <label>Role</label>
      <select name="role">
        <option value="wisatawan">Wisatawan</option>
        <option value="admin">Admin</option>
      </select>
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status">
        <option value="active">Aktif</option>
        <option value="inactive">Tidak Aktif</option>
      </select>
    </div>

    <div class="form-actions">
      <a href="<?= BASE_URL ?>/admin/users" class="btn-secondary">Batal</a>
      <button type="submit" class="btn-primary">Simpan User</button>
    </div>
  </form>
</div>
