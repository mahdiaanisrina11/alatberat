<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pesanan.css">
</head>
<body>

<div class="container my-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">🛒 Keranjang Pesanan Anda</h3>

        <?php if (empty($keranjang)): ?>
            <div class="alert alert-warning text-center">
                Keranjang masih kosong.
            </div>
        <?php else: ?>
            <form method="post" action="/keranjang/selesaikan">
                <?= csrf_field() ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-success">
                            <tr class="text-center">
                                <th>Alat</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($keranjang as $i => $item): ?>
                                <tr class="text-center">
                                    <td><?= esc($item['alat_nama']) ?></td>
                                    <td><?= esc($item['tanggal']) ?></td>
                                    <td><?= esc($item['durasi']) . ' ' . ucfirst(esc($item['satuan_waktu'])) ?></td>
                                    <td><?= esc($item['jumlah']) ?></td>
                                    <td>Rp<?= number_format($item['total_harga']) ?></td>
                                    <td>
                                        <a href="/keranjang/hapus/<?= $i ?>" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
    <div class="col-12 mb-3">
        <h5 class="text-center">Silahkan isi data diri Anda 📋</h5>
    </div>

    <div class="col-md-6 mb-3">
        <input type="text" name="nama" placeholder="Nama" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" name="telepon" placeholder="Telepon" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" name="nik" placeholder="NIK" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
    </div>
</div>


                <div class="text-center">
                    <button class="btn btn-success btn-lg mt-2">
                        <i class="bi bi-cart-check"></i> Selesaikan Semua Pesanan
                    </button>
                </div>
            </form>
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
