<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Alat Berat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
    <style>
       .card-img-top {
        height: 180px;
        object-fit: contain;
        background-color: #f8f9fa; 
        padding: 10px; 
    }
        .card-title a {
        color: #212529; 
        text-decoration: none; 
        transition: color 0.3s ease; 
    }

        .card-title a:hover {
        color: #0d6efd; 
        
    }
    </style>
</head>
<body class="form-page">

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Alat Berat</h2>

    <div class="d-flex justify-content-center mb-4">
        <input type="text" id="searchInput" class="form-control w-auto" style="min-width: 300px;" placeholder="Cari nama alat...">
        <a href="<?= base_url('/') ?>" class="btn btn-outline-success">
            <i class="bi bi-house-fill"></i> Home
        </a>
        <a href="/pesanan" class="btn btn-outline-primary d-flex align-items-center ms-2">
    <i class="bi bi-cart-plus-fill me-1"></i> Pesan Alat
</a>
    </div>

    <div class="row" id="alatList">
        <?php foreach ($alatberat as $alat): ?>
            <div class="col-md-3 col-sm-6 mb-4 alat-item-wrapper">
                <div class="card h-100">
                    <?php if (!empty($alat['gambar'])): ?>
                        <img src="<?= base_url('public/uploads/' . $alat['gambar']) ?>" class="card-img-top" alt="<?= esc($alat['nama']) ?>">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/default.jpg') ?>" class="card-img-top" alt="No Image">
                    <?php endif; ?>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="<?= base_url('alatberat/detail/' . $alat['id']) ?>">
                                <?= esc($alat['nama']) ?>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // Script untuk Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const input = this.value.toLowerCase();
        const items = document.querySelectorAll('#alatList .alat-item-wrapper');

        items.forEach(function(item) {
            const title = item.querySelector('.card-title').textContent.toLowerCase();
            if (title.includes(input)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    document.getElementById('searchInput')?.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // cegah submit form
        }
    });
</script>

</body>
</html>
