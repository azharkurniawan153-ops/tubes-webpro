<?php
// View ini di-render menggunakan layout 'auth'
// $error dikirim dari AuthController::showReset() / resetPassword()
// Hanya bisa diakses setelah verifikasi username+email berhasil
// (lihat AuthController::forgot())
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
    <h2>Atur Password Baru</h2>
    <p>Verifikasi berhasil. Silakan masukkan password baru Anda</p>

    <?php if (!empty($error)): ?>
      <div class="alert-error" style="background:#ffe0e0;color:#c00;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Form POST ke AuthController::resetPassword() -->
    <form action="<?= BASE_URL ?>/reset-password" method="POST">
      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password Baru" required>
      </div>

      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password Baru" required>
      </div>

      <button type="submit">Simpan Password</button>
    </form>
  </div>
</div>
