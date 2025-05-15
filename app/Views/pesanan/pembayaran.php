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
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">💵 Instruksi Pembayaran</h2>

        <p class="text-center">Pesanan atas nama:</p>
        <h4 class="text-center text-primary mb-4"><?= esc($pesanan['nama']) ?></h4>

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
                <strong>Total Bayar:</strong> Rp<?= number_format($pesanan['total_harga']) ?>
            </li>
        </ul>

        <p class="text-muted text-center mt-3">Setelah melakukan pembayaran, pesanan Anda akan segera diproses.</p>

        <div class="text-center">
            <a href="/" class="btn btn-success btn-lg mt-4">
                <i class="bi bi-house-door"></i> Kembali ke Home
            </a>
        </div>
    </div>
</div>

</body>
</html>
