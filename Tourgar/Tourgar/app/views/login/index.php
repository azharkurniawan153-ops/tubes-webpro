<?php
// View ini di-render menggunakan layout 'auth'
// $error dikirim dari AuthController
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
    <h2>Login Akun</h2>
    <p>Silakan masuk untuk melanjutkan perjalanan wisata Anda</p>

    <?php if (!empty($error)): ?>
      <div class="alert-error" style="background:#ffe0e0;color:#c00;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['register_success'])): ?>
      <div class="alert-success" style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:15px;">
        <?= htmlspecialchars($_SESSION['register_success']) ?>
      </div>
      <?php unset($_SESSION['register_success']); ?>
    <?php endif; ?>

    <!-- Form POST ke AuthController::login() -->
    <form action="<?= BASE_URL ?>/login" method="POST">
      <div class="input-group">
        <i class="fa fa-user"></i>
        <input type="text" name="username" placeholder="Username" required
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>

      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="options">
        <label><input type="checkbox" name="ingat"> Ingat saya</label>
        <a href="<?= BASE_URL ?>/forgot-password">Lupa password?</a>
      </div>

      <button type="submit">Masuk</button>

      <p class="register">Belum punya akun? <a href="<?= BASE_URL ?>/register">Daftar sekarang</a></p>
    </form>
  </div>
</div>
