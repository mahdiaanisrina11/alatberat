<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="bg-cover">

    <!-- Navbar -->
    <div class="navbar-custom">
    <?php if (!session('user')): ?>
        <a href="/pesanan" class="btn btn-custom">Pesan Alat</a>
        <a href="/login" class="btn btn-custom">Login</a>
        <a href="/register" class="btn btn-custom">Daftar Akun Baru</a>
    <?php else: ?>
        <a href="/pesanan" class="btn btn-custom">Pesan Alat</a>
        <a href="/keranjang" class="btn btn-custom">Keranjang (<?= count(session('keranjang') ?? []) ?>)</a>
        <a href="/pesanan/daftar-user" class="btn btn-custom">Pesanan</a>
        <a href="/pesanan/history-user" class="btn btn-custom">History</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
    <?php endif; ?>
</div>

    <!-- Konten Tengah -->
    <div class="content-center">
        <?php if (!session('user')): ?>
            <h1>SELAMAT DATANG DIPENYEWAAN ALAT BERAT</h1>
            <h1>PT. TRAS RENTAL UTAMA EKAMULYA</h1>
            <div class="mt-4">
            <a href="<?= base_url('alatberat/lihat_alat') ?>" class="btn btn-outline-light d-flex align-items-center justify-content-center px-4 py-2" style="font-size: 1.2rem; border-radius: 8px; transition: all 0.3s;">
    <i class="bi bi-truck me-2"></i> Lihat Alat Berat
</a>
        </div>
            <p class="mt-3">Silakan login untuk melanjutkan.</p>
        <?php else: ?>
            <h1>SELAMAT DATANG DIPENYEWAAN ALAT BERAT</h1>
            <h1>PT. TRAS RENTAL UTAMA EKAMULYA</h1>
            <h1>Halo, <?= esc(session('user')['nama']) ?> 👋</h1>
            <div class="mt-4">
            <a href="<?= base_url('alatberat/lihat_alat') ?>" class="btn btn-outline-light d-flex align-items-center justify-content-center px-4 py-2" style="font-size: 1.2rem; border-radius: 8px; transition: all 0.3s;">
    <i class="bi bi-truck me-2"></i> Lihat Alat Berat
</a>
        </div>
            <?php if (!empty($menungguPembayaran)): ?>
                <div class="alert alert-warning mt-4 w-50">
                    Anda memiliki <?= count($menungguPembayaran) ?> pesanan yang belum dibayar. 🚨
                    <br>
                    <a href="/pesanan/pembayaran-keranjang" class="btn btn-warning mt-2">Selesaikan Pembayaran</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <a href="https://wa.me/628977750564" class="whatsapp-float" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" width="60" height="60">
</a>

</div>

</body>
</html>
