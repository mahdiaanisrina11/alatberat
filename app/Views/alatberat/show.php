<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stok Alat Berat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
</head>
<body class="form-page">

<div class="form-container">
    <h2 class="text-center mb-4">🛠️ Stok Alat Berat: <?= esc($alat['nama']) ?></h2>

    <div class="mb-4">
        <p><strong>Stok Default:</strong> <?= esc($alat['stok_default']) ?></p>
    </div>

    <h4 class="mb-3">📅 Stok Harian</h4>
    <form method="post" action="/alatberat/<?= $alat['id'] ?>/stok/update-delete">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th>Tanggal</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stok_harian as $stok): ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="delete_ids[]" value="<?= $stok['id'] ?>">
                    </td>
                    <td><?= $stok['tanggal'] ?></td>
                    <td>
                        <input type="number" name="stok[<?= $stok['id'] ?>]" value="<?= $stok['stok'] ?>" class="form-control">
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="d-flex gap-2 mb-4">
            <button type="submit" name="action" value="update" class="btn btn-primary w-100">
                <i class="bi bi-pencil-square me-1"></i> Update Stok
            </button>
            <button type="submit" name="action" value="delete" class="btn btn-danger w-100">
                <i class="bi bi-trash me-1"></i> Hapus Checklist
            </button>
        </div>
    </form>

    <h5 class="mb-3">➕ Tambah / Update Stok Baru</h5>
    <form method="post" action="/alatberat/<?= $alat['id'] ?>/stok">
        <div class="row mb-3">
            <div class="col-md-4 mb-2">
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="col-md-3 mb-2">
                <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
            </div>
            <div class="col-md-3 mb-2">
                <select name="tipe" class="form-select" required>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
    <button class="btn btn-success btn-sm w-100" type="submit">
        <i class="bi bi-plus-circle me-1"></i> Tambah
    </button>
</div>

        </div>
    </form>

    <a href="/alatberat" class="btn btn-success w-100 mt-4">
        <i class="bi bi-house-door me-2"></i> Home
    </a>
</div>

<script>
document.getElementById("checkAll").addEventListener("click", function() {
    const checkboxes = document.querySelectorAll('input[name="delete_ids[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>

</body>
</html>
