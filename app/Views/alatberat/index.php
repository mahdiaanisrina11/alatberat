<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Alat Berat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
</head>
<body class="table-page">

<div class="table-container">
    <h2 class="text-center mb-4">🚜 Daftar Alat Berat</h2>

    <div class="btn-group-custom mb-4">
        <a href="/alatberat/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Alat Berat
        </a>
        <a href="<?= base_url('pesanan/daftar') ?>" class="btn btn-info">
            <i class="bi bi-list-ul"></i> Lihat Semua Pesanan
        </a>
        <a href="/logout" class="btn btn-danger ms-auto">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle text-center">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>Stok Default</th>
            <th>Harga Per Jam</th>
            <th>Harga Harian</th>
            <th>Harga Mingguan</th>
            <th>Harga Bulanan</th>
            
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($alatberat as $alat): ?>
        <tr>
        <td class="text-center">
            <div class="d-flex flex-column align-items-center">
                <?php if (!empty($alat['gambar'])): ?>
                    <img src="<?= base_url('public/uploads/' . $alat['gambar']) ?>" alt="Gambar" style="width: 150px; height: 150px; object-fit: cover; margin-bottom: 10px;">
                <?php endif; ?>
            <div><?= esc($alat['nama']) ?></div>
            </div>
        </td>
            <td><?= esc($alat['stok_default']) ?></td>
            <td>Rp<?= number_format($alat['harga_jaman']) ?></td>
            <td>Rp<?= number_format($alat['harga_harian']) ?></td>
            <td>Rp<?= number_format($alat['harga_mingguan']) ?></td>
            <td>Rp<?= number_format($alat['harga_bulanan']) ?></td>
            
            <td>
                <div class="d-flex gap-2">
                    <a href="/alatberat/show/<?= $alat['id'] ?>" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="/alatberat/edit/<?= $alat['id'] ?>" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="/alatberat/delete/<?= $alat['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</div>

</body>
</html>
