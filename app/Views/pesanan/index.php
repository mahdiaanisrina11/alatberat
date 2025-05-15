<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Tanggal Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="container my-5">  
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-4">Pilih Tanggal Pemesanan</h2>

        <a href="<?= base_url('/') ?>" class="btn btn-outline-success">
            <i class="bi bi-house-fill"></i> Home
        </a>
    </div>

    <?php
    $today = date('Y-m-d'); // hari ini
    $nextMonth = date('Y-m-d', strtotime('+1 month')); // sebulan dari hari ini
    ?>

    <form method="post" action="<?= base_url('pesanan/cek') ?>" class="mb-5">
        <?= csrf_field() ?>
        <input 
            type="date" 
            name="tanggal" 
            required 
            class="form-control w-25 d-inline" 
            value="<?= isset($tanggal) ? $tanggal : '' ?>"
            min="<?= $today ?>" 
            max="<?= $nextMonth ?>"
        >
        <button class="btn btn-primary">Cek Ketersediaan</button>
    </form>

    <?php if (isset($alatList)): ?>
    <?php if (!empty($alatList)): ?>
        <hr>
        <form method="post" action="<?= base_url('pesanan/pesan') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
            <h4 class="mb-3">Alat Berat Tersedia di Tanggal <?= $tanggal ?></h4>

            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari nama alat berat...">
            </div>

            <div id="alatList" class="row">
            <?php foreach ($alatList as $alat): ?>
    <div class="col-6 col-md-4 col-lg-3 mb-4 alat-item text-center">
        <a href="<?= base_url('pesanan/form/' . $alat['id'] . '?tanggal=' . $tanggal) ?>" 
           class="d-block p-3 border rounded text-decoration-none h-100">
            
            <img src="<?= base_url('public/uploads/' . $alat['gambar']) ?>" 
                 alt="<?= esc($alat['nama']) ?>" 
                 class="img-fluid mb-2" 
                 style="max-height: 150px; object-fit: cover;">

            <div class="fw-bold"><?= esc($alat['nama']) ?></div>

            <div class="small text-muted mt-1">
                Harga Perjam : Rp<?= number_format($alat['harga_jaman']) ?>/jam<br>
                Harga Harian : Rp<?= number_format($alat['harga_harian']) ?>/hari<br>
                Harga Mingguan : Rp<?= number_format($alat['harga_mingguan']) ?>/minggu<br>
                Harga Bulanan : Rp<?= number_format($alat['harga_bulanan']) ?>/bulan
            </div>

            <div class="text-muted mt-1">Stok: <?= esc($alat['stok']) ?></div>
            
        </a>
    </div>
<?php endforeach; ?>

</div>

        </form>
    <?php else: ?>
        <hr>
        <div class="alert alert-warning">
            Tidak ada alat berat tersedia untuk tanggal <strong><?= $tanggal ?></strong>.
        </div>
    <?php endif; ?>
<?php endif; ?>

<script>
document.getElementById('searchInput')?.addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const alatItems = document.querySelectorAll('.alat-item');

    alatItems.forEach(function(item) {
        const text = item.innerText.toLowerCase();
        if (text.includes(keyword)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

document.getElementById('searchInput')?.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // cegah submit form
    }
});
</script>

</body>
</html>
