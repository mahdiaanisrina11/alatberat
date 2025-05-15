<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Aktif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pesanan.css"> 
</head>
<body>

<div class="container my-5">
    <h2 class="mb-4 text-center">📋 Pesanan Aktif Anda</h2>

    <?php if (empty($pesananList)): ?>
        <div class="alert alert-info text-center">Belum ada pesanan aktif.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle shadow-sm text-center">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Alat</th>
                        <th>Tanggal</th>
                        <th>Durasi</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Status Sewa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesananList as $pesanan): ?>
                    <tr>
                        <td><?= esc($pesanan['alat_nama']) ?></td>
                        <td><?= esc($pesanan['tanggal']) ?></td>
                        <td><?= esc($pesanan['durasi']) . ' ' . ucfirst(esc($pesanan['satuan_waktu'])) ?></td>
                        <td class="text-center"><?= esc($pesanan['jumlah']) ?></td>
                        <td>Rp<?= number_format($pesanan['total_harga']) ?></td>
                        <td>
                            <?php if ($pesanan['status_pembayaran'] === 'menunggu pembayaran'): ?>
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            <?php else: ?>
                                <span class="badge bg-success">Lunas</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($pesanan['status_sewa'] === 'berjalan'): ?>
                                <span class="badge bg-primary">Sedang Berjalan</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($pesanan['status_pembayaran'] === 'menunggu pembayaran'): ?>
                                <form action="<?= base_url('pesanan/batal/' . $pesanan['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
    <a href="/" class="btn btn-success">
        <i class="bi bi-house-door"></i> Kembali ke Home
    </a>
</div>

</div>

</body>
</html>
