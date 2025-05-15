<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pesanan.css">
</head>
<body>

<div class="container my-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center mb-4">💳 Instruksi Pembayaran</h3>

        <p class="text-center mb-1">Pesanan atas nama:</p>
        <h4 class="text-center text-primary"><?= esc($nama) ?></h4>

        <hr>

        <p class="mb-3">Silakan transfer ke Virtual Account berikut:</p>

        <ul class="list-group mb-4">
            <li class="list-group-item">
                <strong>Bank:</strong> Bank Contoh (BCA, BRI, BNI, dll)
            </li>
            <li class="list-group-item">
                <strong>Nomor VA:</strong> <?= esc($vaNumber) ?>
            </li>
            <li class="list-group-item">
                <strong>Total Bayar:</strong> Rp<?= number_format($total) ?>
            </li>
        </ul>

        <p class="text-muted text-center">Silakan transfer sesuai total ke nomor VA di atas melalui ATM atau Mobile Banking.</p>

        <hr class="my-4">

<h5 class="text-center mb-3">Upload Bukti Pembayaran</h5>

<form action="<?= base_url('/pesanan/upload_bukti') ?>" method="post" enctype="multipart/form-data" class="text-center">
    <?= csrf_field() ?>
    <input type="file" name="bukti" accept="image/*" class="form-control mb-3" required>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-upload"></i> Upload Bukti
    </button>
</form>

        <div class="text-center">
            <a href="/" class="btn btn-success btn-lg mt-3">
                <i class="bi bi-house-door"></i> Kembali ke Home
            </a>
        </div>
    </div>
</div>

</body>
</html>
