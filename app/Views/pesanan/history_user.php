<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pesanan.css">
</head>
<body>

<div class="container my-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">📜 Riwayat Pesanan Anda</h2>

        <?php if (empty($pesananList)): ?>
            <div class="alert alert-info text-center">Belum ada riwayat pesanan.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-success">
                        <tr class="text-center">
                            <th>Alat</th>
                            <th>Tanggal</th>
                            <th>Durasi</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Status Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesananList as $pesanan): ?>
                        <tr class="text-center">
                            <td><?= esc($pesanan['alat_nama']) ?></td>
                            <td><?= esc($pesanan['tanggal']) ?></td>
                            <td><?= esc($pesanan['durasi']) . ' ' . ucfirst(esc($pesanan['satuan_waktu'])) ?></td>
                            <td><?= esc($pesanan['jumlah']) ?></td>
                            <td>Rp<?= number_format($pesanan['total_harga']) ?></td>
                            <td>
                                <?php if ($pesanan['status_pembayaran'] === 'lunas'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($pesanan['status_sewa'] === 'selesai'): ?>
                                    <span class="badge bg-primary">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= esc($pesanan['status_sewa']) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="/" class="btn btn-success btn-lg">
                <i class="bi bi-house-door"></i> Kembali ke Home
            </a>
        </div>
    </div>
</div>

</body>
</html>
