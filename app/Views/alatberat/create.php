<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alat Berat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
</head>
<body class="form-page">

<div class="form-container">
    <h2>Tambah Alat Berat</h2>
    <form method="post" action="/alatberat/store" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Alat Berat</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama alat berat" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok Default</label>
            <input type="number" name="stok_default" class="form-control" placeholder="Masukkan stok" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Harga Per Jam</label>
    <input type="number" name="harga_jaman" class="form-control" placeholder="Masukkan harga per jam" required>
</div>
<div class="mb-3">
    <label class="form-label">Harga Harian</label>
    <input type="number" name="harga_harian" class="form-control" placeholder="Masukkan harga harian" required>
</div>
<div class="mb-3">
    <label class="form-label">Harga Mingguan</label>
    <input type="number" name="harga_mingguan" class="form-control" placeholder="Masukkan harga mingguan" required>
</div>
<div class="mb-3">
    <label class="form-label">Harga Bulanan</label>
    <input type="number" name="harga_bulanan" class="form-control" placeholder="Masukkan harga bulanan" required>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi alat" required></textarea>
</div>
        <div class="mb-3">
            <label class="form-label">Gambar Alat Berat</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-2"></i>Simpan
        </button>
        <a href="<?= base_url('/alatberat') ?>" class="btn btn-success mt-4 w-100">
        <i class="bi bi-house-door me-2"></i> Home
    </a>
    </form>
</div>

</body>
</html>
