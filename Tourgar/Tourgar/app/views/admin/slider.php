<?php
// app/views/admin/slider.php
// $daftarSlider dikirim dari AdminController::slider()
?>

<div class="section-header">
  <h2>🖼️ Kelola Slider</h2>
  <a href="<?= BASE_URL ?>/admin/slider/tambah" class="btn-primary">+ Tambah Slide</a>
</div>

<?php if (empty($daftarSlider)): ?>
  <p class="no-data">Belum ada slide</p>
<?php else: ?>
  <div class="slider-grid">
    <?php foreach ($daftarSlider as $s): ?>
      <div class="slider-card">
        <img src="<?= htmlspecialchars($s['gambar']) ?>" alt="<?= htmlspecialchars($s['judul']) ?>">
        <div class="slider-card-body">
          <h4><?= htmlspecialchars($s['judul']) ?></h4>
          <div class="slider-card-actions">
            <a href="<?= BASE_URL ?>/admin/slider/edit?id=<?= (int)$s['id_slider'] ?>" class="btn-edit">Edit</a>
            <a href="<?= BASE_URL ?>/admin/slider/hapus?id=<?= (int)$s['id_slider'] ?>"
               class="btn-delete"
               onclick="return confirm('Hapus slide ini?')">Hapus</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
