<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memesan Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Pilih Tanggal Pemesanan</h2>
        <a href="<?= base_url('/pesanan') ?>" class="btn btn-outline-success">
    <i class="bi bi-arrow-left"></i> Kembali
</a>
    </div>

    <div class="card p-4 shadow-sm">
    <div class="row mb-3">
        <div class="col-md-4 d-flex align-items-start">
            <img src="<?= base_url('public/uploads/' . $alat['gambar']) ?>" alt="<?= $alat['nama'] ?>" class="img-fluid mb-2" style="max-height: 350px; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <h3 class="mb-3 text-success">Nama Alat: <?= $alat['nama'] ?></h3>
            <p><strong>Stok tersedia:</strong> <?= $alat['stok'] ?></p>

            <!-- Dropdown Pilih Tipe Sewa -->
            <div class="mb-3">
                <label for="tipeSewa" class="form-label">Pilih Tipe Sewa:</label>
                <select id="tipeSewa" class="form-select" name="tipe_sewa">
                    <option value="jam" data-harga="<?= $alat['harga_jaman'] ?>">Per Jam (Rp<?= number_format($alat['harga_jaman']) ?>)</option>
                    <option value="hari" data-harga="<?= $alat['harga_harian'] ?>">Per Hari (Rp<?= number_format($alat['harga_harian']) ?>)</option>
                    <option value="minggu" data-harga="<?= $alat['harga_mingguan'] ?>">Per Minggu (Rp<?= number_format($alat['harga_mingguan']) ?>)</option>
                    <option value="bulan" data-harga="<?= $alat['harga_bulanan'] ?>">Per Bulan (Rp<?= number_format($alat['harga_bulanan']) ?>)</option>
                </select>
            </div>

            <!-- Harga dinamis -->
            <p><strong>Harga:</strong> Rp<span id="hargaText"><?= number_format($alat['harga_jaman']) ?></span></p>
        </div>
    </div>

    <form method="post" action="<?= base_url('pesanan/checkout') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="redirect_url" value="<?= current_url(). '?' . $_SERVER['QUERY_STRING'] ?>">
        <input type="hidden" name="alat_id" value="<?= esc($alat['id']) ?>">
        <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
        <input type="hidden" name="harga" id="hargaInput" value="<?= $alat['harga_jaman'] ?>">
        <input type="hidden" name="alat_nama" value="<?= $alat['nama'] ?>">

        <div class="row mb-3">
    <div class="col-md-6">
        <label id="labelDurasi" class="form-label">Durasi (Jam):</label>
        <input type="number" name="durasi" min="1" class="form-control" value="1">
    </div>
    <input type="hidden" id="satuanWaktuInput" name="satuan_waktu" value="jam">
    <div class="col-md-6">
        <label class="form-label">Jumlah Alat:</label>
        <input type="number" name="jumlah" min="1" max="<?= $alat['stok'] ?>" class="form-control" value="1">
    </div>
</div>


        <div class="d-flex gap-2">
            <button class="btn btn-success flex-fill" name="submit" value="langsung">Pesan Langsung</button>
            <button class="btn btn-outline-secondary flex-fill" name="submit" value="keranjang">Masukkan Keranjang</button>
        </div>
    </form>
</div>
</div>

<script>
document.getElementById('tipeSewa').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const hargaBaru = selectedOption.getAttribute('data-harga');
    const tipeSewa = this.value;

    // Update harga
    document.getElementById('hargaText').textContent = Number(hargaBaru).toLocaleString('id-ID');
    document.getElementById('hargaInput').value = hargaBaru;

    // Update label durasi
    let labelText = 'Durasi';
    if (tipeSewa === 'jam') labelText = 'Durasi (Jam):';
    else if (tipeSewa === 'hari') labelText = 'Durasi (Hari):';
    else if (tipeSewa === 'minggu') labelText = 'Durasi (Minggu):';
    else if (tipeSewa === 'bulan') labelText = 'Durasi (Bulan):';
    
    document.getElementById('labelDurasi').textContent = labelText;

    document.getElementById('satuanWaktuInput').value = tipeSewa;
});
</script>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    const durasi = document.querySelector('input[name="durasi"]').value;
    const jumlah = document.querySelector('input[name="jumlah"]').value;

    if (durasi < 1) {
        alert('Durasi harus minimal 1.');
        event.preventDefault();
    }
    if (jumlah < 1) {
        alert('Jumlah alat harus minimal 1.');
        event.preventDefault();
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
