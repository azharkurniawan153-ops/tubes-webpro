<?php
// app/views/admin/users.php
// $daftarUser dikirim dari AdminController::users()
$currentUserId = (int)($_SESSION['user_id'] ?? 0);
?>

<div class="section-header">
  <h2>👥 Kelola User</h2>
  <a href="<?= BASE_URL ?>/admin/users/tambah" class="btn-primary">+ Tambah User</a>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($daftarUser)): ?>
        <tr><td colspan="7" class="no-data">Belum ada data user</td></tr>
      <?php else: ?>
        <?php foreach ($daftarUser as $i => $u): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($u['nama']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
              <span class="role-badge role-<?= $u['role'] === 'admin' ? 'admin' : 'wisatawan' ?>">
                <?= $u['role'] === 'admin' ? 'Admin' : 'Wisatawan' ?>
              </span>
            </td>
            <td>
              <?php $status = $u['status'] ?? 'active'; ?>
              <span class="status-badge status-<?= $status === 'inactive' ? 'inactive' : 'active' ?>">
                <?= $status === 'inactive' ? 'Tidak Aktif' : 'Aktif' ?>
              </span>
            </td>
            <td>
              <a href="<?= BASE_URL ?>/admin/users/edit?id=<?= (int)$u['id'] ?>" class="btn-edit">Edit</a>
              <?php if ((int)$u['id'] !== $currentUserId): ?>
                <a href="<?= BASE_URL ?>/admin/users/hapus?id=<?= (int)$u['id'] ?>"
                   class="btn-delete"
                   onclick="return confirm('Hapus user ini?')">Hapus</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
