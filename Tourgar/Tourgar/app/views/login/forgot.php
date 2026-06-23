<?php
// View ini di-render menggunakan layout 'auth'
// $error dikirim dari AuthController::showForgot() / forgot()
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
    <h2>Lupa Password</h2>
    <p>Masukkan username dan email akun Anda untuk mengatur ulang password</p>

    <?php if (!empty($error)): ?>
      <div class="alert-error" style="background:#ffe0e0;color:#c00;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Form POST ke AuthController::forgot() -->
    <form action="<?= BASE_URL ?>/forgot-password" method="POST">
      <div class="input-group">
        <i class="fa fa-user"></i>
        <input type="text" name="username" placeholder="Username" required
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>

      <div class="input-group">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <button type="submit">Verifikasi</button>

      <p class="register">Ingat password Anda? <a href="<?= BASE_URL ?>/login">Login di sini</a></p>
    </form>
  </div>
</div>
