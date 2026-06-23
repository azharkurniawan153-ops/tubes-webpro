<?php
// app/views/admin/pesanan.php
// $daftarPesanan dikirim dari AdminController::pesanan()
?>

<div class="section-header">
  <h2>🛒 Kelola Pesanan Paket Wisata</h2>
  <span style="background:rgba(0,180,216,0.15);border:1px solid #00b4d8;color:#00b4d8;padding:5px 14px;border-radius:20px;font-size:0.85rem;">
    <?= count($daftarPesanan) ?> total pesanan
  </span>
</div>

<?php if (!empty($_SESSION['admin_success'])): ?>
  <div style="background:#d4edda;color:#155724;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
    ✅ <?= htmlspecialchars($_SESSION['admin_success']) ?>
  </div>
  <?php unset($_SESSION['admin_success']); ?>
<?php endif; ?>

<!-- Filter Status -->
<div style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">
  <?php
  $filterStatus = $_GET['status'] ?? 'all';
  $statuses = ['all'=>'Semua', 'pending'=>'Pending', 'konfirmasi'=>'Dikonfirmasi', 'selesai'=>'Selesai', 'batal'=>'Dibatalkan'];
  foreach ($statuses as $key => $label):
    $active = $filterStatus === $key ? 'background:#00b4d8;color:#fff;' : 'background:rgba(255,255,255,0.07);color:#aaa;';
  ?>
    <a href="?status=<?= $key ?>" style="<?= $active ?> border:1px solid rgba(255,255,255,0.15);padding:6px 16px;border-radius:20px;font-size:0.83rem;text-decoration:none;"><?= $label ?></a>
  <?php endforeach; ?>
</div>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pemesan</th>
        <th>No. HP</th>
        <th>Paket Wisata</th>
        <th>Harga</th>
        <th>Tgl Perjalanan</th>
        <th>Peserta</th>
        <th>Catatan</th>
        <th>Status</th>
        <th>Tanggal Masuk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $filtered = $daftarPesanan;
      if ($filterStatus !== 'all') {
          $filtered = array_filter($daftarPesanan, fn($p) => ($p['status'] ?? 'pending') === $filterStatus);
      }
      ?>
      <?php if (empty($filtered)): ?>
        <tr><td colspan="11" class="no-data">Belum ada pesanan <?= $filterStatus !== 'all' ? "dengan status \"$filterStatus\"" : '' ?></td></tr>
      <?php else: ?>
        <?php $i = 1; foreach ($filtered as $p): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><strong><?= htmlspecialchars($p['nama_pemesan']) ?></strong></td>
            <td><?= htmlspecialchars($p['no_hp']) ?></td>
            <td><?= htmlspecialchars($p['nama_paket']) ?></td>
            <td>Rp <?= number_format((float)($p['harga_paket']??0),0,',','.') ?></td>
            <td><?= htmlspecialchars($p['tanggal_pesan'] ?? '-') ?></td>
            <td style="text-align:center;"><?= (int)($p['jumlah_orang']??1) ?> org</td>
            <td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($p['catatan']??'') ?>">
              <?= htmlspecialchars(mb_strimwidth($p['catatan'] ?? '-', 0, 40, '...')) ?>
            </td>
            <td>
              <?php
              $st = $p['status'] ?? 'pending';
              $colors = ['pending'=>'#f0ad4e','konfirmasi'=>'#5bc0de','selesai'=>'#5cb85c','batal'=>'#d9534f'];
              $color = $colors[$st] ?? '#aaa';
              $labels = ['pending'=>'⏳ Pending','konfirmasi'=>'✅ Dikonfirmasi','selesai'=>'🎉 Selesai','batal'=>'❌ Dibatalkan'];
              $label = $labels[$st] ?? $st;
              ?>
              <span style="background:<?= $color ?>22;border:1px solid <?= $color ?>;color:<?= $color ?>;padding:3px 10px;border-radius:20px;font-size:0.78rem;white-space:nowrap;">
                <?= $label ?>
              </span>
            </td>
            <td style="font-size:0.82rem;color:#888;"><?= date('d/m/Y H:i', strtotime($p['created_at'] ?? 'now')) ?></td>
            <td>
              <div style="display:flex;gap:6px;flex-wrap:wrap;">
                <?php if ($st === 'pending'): ?>
                  <a href="<?= BASE_URL ?>/admin/pesanan/status?id=<?= (int)$p['id_pesanan'] ?>&status=konfirmasi"
                     class="btn-edit" style="font-size:0.75rem;padding:4px 10px;"
                     onclick="return confirm('Konfirmasi pesanan ini?')">Konfirmasi</a>
                <?php endif; ?>
                <?php if ($st === 'konfirmasi'): ?>
                  <a href="<?= BASE_URL ?>/admin/pesanan/status?id=<?= (int)$p['id_pesanan'] ?>&status=selesai"
                     class="btn-edit" style="font-size:0.75rem;padding:4px 10px;background:#5cb85c;border-color:#5cb85c;"
                     onclick="return confirm('Tandai pesanan ini selesai?')">Selesai</a>
                <?php endif; ?>
                <?php if (in_array($st, ['pending','konfirmasi'])): ?>
                  <a href="<?= BASE_URL ?>/admin/pesanan/status?id=<?= (int)$p['id_pesanan'] ?>&status=batal"
                     class="btn-delete" style="font-size:0.75rem;padding:4px 10px;"
                     onclick="return confirm('Batalkan pesanan ini?')">Batal</a>
                <?php endif; ?>
                <a href="<?= BASE_URL ?>/admin/pesanan/hapus?id=<?= (int)$p['id_pesanan'] ?>"
                   class="btn-delete" style="font-size:0.75rem;padding:4px 10px;"
                   onclick="return confirm('Hapus pesanan ini permanen?')">Hapus</a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
