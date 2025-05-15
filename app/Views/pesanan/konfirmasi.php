<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pesanan.css"> 
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary mb-0">Konfirmasi Pesanan</h3>
        <a href="javascript:history.back()" class="btn btn-outline-success">
    <i class="bi bi-arrow-left"></i> Kembali
</a>
    </div>

    <div class="card p-4 shadow-sm mb-4">
    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Tanggal:</strong> <?= $data['tanggal'] ?></li>
        <li class="list-group-item"><strong>Alat:</strong> <?= $data['alat_nama'] ?></li>
        <li class="list-group-item"><strong>Jumlah:</strong> <?= $data['jumlah'] ?></li>
        <li class="list-group-item">
    <strong>Durasi:</strong> <?= $data['durasi'] ?> <?= ucfirst($data['satuan_waktu']) ?>
</li>
        <li class="list-group-item"><strong>Harga Satuan:</strong> Rp<?= number_format($data['harga_satuan']) ?></li>
        <li class="list-group-item"><strong>Total Harga:</strong> <span class="text-success">Rp<?= number_format($total_harga) ?></span></li>
    </ul>

    <h5 class="mb-3">Silahkan isi data diri</h5>

    <form method="post" action="/pesanan/final">
        <?= csrf_field() ?>
        <input type="hidden" name="data" value="<?= htmlspecialchars(json_encode($data)) ?>">
        <input type="hidden" name="total_harga" value="<?= $total_harga ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="text" id="telepon" name="telepon" placeholder="Masukkan Telepon" class="form-control" required>
        </div>

        <div class="mb-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="text" id="nik" name="nik" placeholder="Masukkan NIK" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat Lengkap</label>
        <textarea id="alamat" name="alamat" placeholder="Masukkan Alamat" class="form-control" required></textarea>
    </div>


        <button type="submit" class="btn btn-success w-100">Konfirmasi dan Pesan</button>
    </form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
