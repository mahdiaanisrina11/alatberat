<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>

<div class="register-card">
    <h2 class="text-center mb-4">📝 Daftar Akun Baru</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form method="post" action="/registerdata">
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-person-plus"></i> Daftar
            </button>
        </div>
    </form>

    <p class="mt-3 text-center">
        Sudah punya akun? <a href="/login">Login di sini</a>
    </p>
</div>

</body>
</html>
