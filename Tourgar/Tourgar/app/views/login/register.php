<?php
// View ini di-render menggunakan layout 'auth'
// $error dikirim dari AuthController::showRegister() / register()
?>

<div class="login-container">
  <!-- LEFT IMAGE -->
  <div class="login-image">
    <div class="overlay">
      <h1>TOUGAR</h1>
      <p>Menjelajahi Keindahan Alam &amp; Budaya Garut</p>
    </div>
  </div>

  <!-- RIGHT FORM -->
  <div class="login-form">
    <h2>Daftar Akun</h2>
    <p>Buat akun baru untuk mulai menjelajahi wisata Garut</p>

    <?php if (!empty($error)): ?>
      <div class="alert-error" style="background:#ffe0e0;color:#c00;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Form POST ke AuthController::register() -->
    <form action="<?= BASE_URL ?>/register" method="POST">
      <div class="input-group">
        <i class="fa fa-id-card"></i>
        <input type="text" name="nama" placeholder="Nama Lengkap" required
               value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
      </div>

      <div class="input-group">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <div class="input-group">
        <i class="fa fa-user"></i>
        <input type="text" name="username" placeholder="Username" required
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>

      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required>
      </div>

      <button type="submit">Daftar</button>

      <p class="register">Sudah punya akun? <a href="<?= BASE_URL ?>/login">Login di sini</a></p>
    </form>
  </div>
</div>
